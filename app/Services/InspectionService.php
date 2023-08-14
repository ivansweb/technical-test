<?php

namespace App\Services;

use App\Repositories\InspectionRepository;
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


    public function __construct(
        InspectionRepository $repository,
        FarmService $farmService,
        ComponentService $componentService,
        GradeService $gradeService
    )
    {
        $this->farmService = $farmService;
        $this->componentService = $componentService;
        $this->gradeService = $gradeService;

        parent::__construct($repository);
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
    public function getFarm(int $farmId): array
    {
        $farm = $this->farmService->getById($farmId);

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

    /**
     * @throws Exception
     */
    public function getInspectionsByFarm(int $id)
    {
        return $this->repository->getInspectionsByFarm($id);
    }
}
