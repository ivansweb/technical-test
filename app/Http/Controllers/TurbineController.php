<?php

namespace App\Http\Controllers;

use App\Services\TurbineService;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TurbineController extends Controller
{
    /**
     * @var TurbineService
     */
    public TurbineService $service;

    //dependency injection
    public function __construct(TurbineService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $turbines = $this->service->getAll();
        return Inertia::render('Registers/Turbines/Index', [
            'turbines' => $turbines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  $id
     * @return Response
     * @throws Exception
     */
    public function create($id = null): Response
    {
        $turbine = $id ? $this->service->getById($id) : [];
        return Inertia::render('Registers/Turbines/New',[
            'turbine' => $turbine
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Exception
     */
    public function store(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $payload = $request->all();
        $turbine = $this->service->create($payload);

        return Inertia::location(route('farms.show', ['id' => $turbine->farm_id]));
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
        $turbine = $this->service->getById($id);
        return Inertia::render('Registers/Turbines/Edit',[
            'turbine' => $turbine
            ],
        );
    }

    /**
     * Updates the specified resource in storage and redirects to the page of the farm it belongs to
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws Exception
     */
    public function update(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $payload = $request->all();
        $turbine = $this->service->update($payload);

        return Inertia::location(route('farms.show', ['id' => $turbine->farm_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
