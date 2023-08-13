<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Farm;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
}
