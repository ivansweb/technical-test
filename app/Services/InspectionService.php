<?php

namespace App\Services;

use App\Repositories\ComponentGradeRepository;
use App\Repositories\InspectionRepository;
use DB;
use Exception;

/**
 * Class InspectionService
 * @package App\Services
 */
class InspectionService extends Service
{
    public FarmService $farmService;
    public ComponentService $componentService;
    public GradeService $gradeService;

    public ComponentGradeRepository $componentGradeRepository;

    public function __construct(
        InspectionRepository $repository,
        FarmService $farmService,
        ComponentService $componentService,
        GradeService $gradeService,
        ComponentGradeRepository $componentGradeRepository
    )
    {
        $this->farmService = $farmService;
        $this->componentService = $componentService;
        $this->gradeService = $gradeService;
        $this->componentGradeRepository = $componentGradeRepository;

        parent::__construct($repository);
    }

    /**
     * @throws Exception
     */
    public function getFarmsAndInspections(int $farmId): array
    {
        $farms = $this->getFarmslist();

        $farm = $this->getFarm($farmId);

        $inspections = [
            'farmId' => $farmId,
            'list' => [],
            'farmName' => $farm['name'] ?? ''
        ];

        if ($inspections['farmId'] !== 0) {
            $inspectionsList = $this->getInspectionsByFarm($inspections['farmId']);

            if (!$inspectionsList->isEmpty()) {
                $inspections['list'] = $inspectionsList->toArray();
                $inspections['farmName'] = $inspectionsList[0]['farm_name'];
            }
        }

        return [
            'inspections' => $inspections,
            'farms' => $farms
        ];
    }

    public function create(array $params = []): mixed
    {
        $turbineId = $params['turbineId'];
        $components = $params['components'];


        return DB::transaction(function () use ($turbineId, $components) {
            // Crie a inspeção
            $inspection = $this->repository->create([
                'turbine_id' => $turbineId,
                'inspection_date' => now(),
            ]);

            // Crie as notas dos componentes associadas à inspeção
            $grades = [];
            foreach ($components as $component) {
                $grades[] = $this->componentGradeRepository->create([
                    'inspection_id' => $inspection->id,
                    'component_id' => $component['id'],
                    'grade_id' => $component['selectedGrade']['id']
                ]);
            }

            return $inspection;
        });
    }

    public function getFarmslist()
    {
        $farms = $this->farmService->getAll();

        return $farms->map(function ($farm) {
            return [
                'id' => $farm->id,
                'name' => $farm->name
            ];
        });
    }

    public function getComponents()
    {
        $components = $this->componentService->getAll();

        return $components->map(function ($component) {
            return [
                'id' => $component->id,
                'name' => $component->name
            ];
        });
    }

    public function getGrades()
    {
        $grades = $this->gradeService->getAll();

        return $grades->map(function ($grade) {
            return [
                'id' => $grade->id,
                'name' => $grade->name
            ];
        });
    }

    /**
     * @throws Exception
     */
    public function getFarm(int $farmId, bool $fullData = false): array
    {
        $farm = $this->farmService->getById($farmId);

        if (!$fullData){
            return [
                'id' => $farm->id,
                'name' => $farm->name,
            ];
        }else{
            return [
                'id' => $farm->id,
                'name' => $farm->name,
                'turbines' => $farm->turbines->map(function ($turbine) {
                    return [
                        'id' => $turbine->id,
                        'name' => $turbine->id . " - " . $turbine->model,
                        'serial_number' => $turbine->serial_number,
                    ];
                })
            ];
        }


    }

    /**
     * @throws Exception
     */
    public function getInspectionsByFarm(int $id)
    {
        return $this->repository->getInspectionsByFarm($id);
    }

    public function getById(int $id = null): array
    {
        $inspection = $this->repository->getById($id);
        $turbine = $inspection->turbine;
        $componentGrades = $this->componentGradeRepository->getByInspectionId($id);
        $componentGrades = $componentGrades->map(function ($componentGrade) {
            return [
                'componentName' => $componentGrade->component->name,
                'grade' => $componentGrade->grade->name,
                'value' => $componentGrade->grade->value,
            ];
        });

        return [
            'inspectionId' => $inspection->id,
            'farmId' => $turbine->farm_id,
            'turbine' => $turbine->model . " - " . $turbine->serial_number,
            'inspectionDate' => $inspection->inspection_date,
            'componentGrades' => $componentGrades,
        ];
    }

}
