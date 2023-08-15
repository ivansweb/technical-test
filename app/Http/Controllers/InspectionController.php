<?php

namespace App\Http\Controllers;

use App\Services\InspectionService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InspectionController extends Controller
{
    /**
     * @var InspectionService
     */
    public InspectionService $service;

    //dependency injection
    public function __construct(InspectionService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $farmId = $request->get('farmId');
        $farms = $this->service->getFarmslist();

        if(!is_null($farmId)){
            $farm = $this->service->getFarm($farmId);
        }


        $inspections = [
            'farmId' => $farmId ?? 0,
            'list' => [],
            'farmName' => $farm['name'] ?? ''
        ];

        if ($inspections['farmId'] !== 0) {
            $inspectionsList = $this->service->getInspectionsByFarm($inspections['farmId']);

            if (!$inspectionsList->isEmpty()) {
                $inspections['list'] = $inspectionsList->toArray();
                $inspections['farmName'] = $inspectionsList[0]['farm_name'];
            }
        }

        return Inertia::render('Inspections/Index', [
            'inspections' => $inspections,
            'farms' => $farms
        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function create(Request $request): Response
    {
        $farmId = $request->get('farmId');
        $farm = $this->service->getFarm($farmId, true);
        $components = $this->service->getComponents();
        $grades = $this->service->getGrades();

        return Inertia::render('Inspections/New', [
            'farm' => $farm,
            'components' => $components,
            'grades' => $grades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $payload = $request->all();
        $this->service->create($payload);
        return to_route('inspections.list', [
            'farmId' => $payload['farmId']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function show(int $id): Response
    {
        $inspections = $this->service->getById($id);
        return Inertia::render('Inspections/New',[
            'inspections' => $inspections
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request): RedirectResponse
    {
        $payload = $request->all();
        $this->service->update($payload);
        return to_route('farms.list');
    }


}
