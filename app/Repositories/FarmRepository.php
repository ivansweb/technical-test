<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Farm;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarmRepository
 * @package App\Repositories
 */
class FarmRepository extends Repository
{
    protected $model;

    /**
     * Dependecy Injector
     *
     * @param Farm $model
     * @throws Exception
     */
    public function __construct(Farm $model)
    {
        parent::__construct($model);
    }

    /**
     * Get entity by id
     *
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model
    {
        return $this->model
            ->with('turbines')
            ->find($id);
    }

    public function getFarmWithRelations(int $id): Model
    {
        return $this->model->with('turbines')->find($id);
    }
}
