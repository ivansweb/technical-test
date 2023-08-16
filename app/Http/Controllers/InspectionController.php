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

        $data = [];
        if(!is_null($farmId)){
            $data = $this->service->getFarmsAndInspections($farmId);
        }else{
            $data['farms'] = $this->service->getFarmslist();
            $data['inspections'] = [
                'farmId' => 0,
                'list' => [],
                'farmName' => ''
            ];
        }

        return Inertia::render('Inspections/Index', [
            'inspections' => $data['inspections'],
            'farms' => $data['farms'],
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
     * @return array
     * @throws Exception
     */
    public function show(int $id): array
    {
        return $this->service->getById($id);
    }
}
