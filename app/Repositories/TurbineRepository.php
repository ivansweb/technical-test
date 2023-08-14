<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Turbine;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TurbineRepository
 * @package App\Repositories
 */
class TurbineRepository extends Repository
{
    protected $model;

    /**
     * Dependecy Injector
     *
     * @param Turbine $model
     * @throws Exception
     */
    public function __construct(Turbine $model)
    {
        parent::__construct($model);
    }

}
