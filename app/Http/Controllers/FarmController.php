<?php

namespace App\Http\Controllers;

use App\Services\FarmService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FarmController extends Controller
{
    /**
     * @var FarmService
     */
    public FarmService $service;

    //dependency injection
    public function __construct(FarmService $service)
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
        $farms = $this->service->getAll();
        return Inertia::render('Registers/Farms/Index', [
            'farms' => $farms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Registers/Farms/New');
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
        return to_route('farms.list');
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
        $farm = $this->service->getById($id);
        return Inertia::render('Registers/Farms/Edit',[
            'farm' => $farm
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
