<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Inspection;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class InspectionRepository
 * @package App\Repositories
 */
class InspectionRepository extends Repository
{
    protected $model;

    /**
     * Dependecy Injector
     *
     * @param Inspection $model
     * @throws Exception
     */
    public function __construct(Inspection $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all inspections by farm
     *
     */
    public function getInspectionsByFarm(int $id)
    {
        return $this->model
            ->select(
                'inspections.id as inspection_id',
                'inspections.*',
                'turbines.*',
                DB::raw('CONCAT(turbines.model, "-", turbines.id) as turbine'),
                'farms.name as farm_name',
                'farms.id as farm_id',
                'farms.*'
            )
            ->join('turbines', 'turbines.id', '=', 'inspections.turbine_id')
            ->join('farms', 'farms.id', '=', 'turbines.farm_id')
            ->where('farms.id', $id)
            ->get();
    }

    public function getById(int $id): Model
    {
        return $this->model
            ->query()
            ->with('turbine')
            ->where('id', $id)
            ->first();
    }

}
