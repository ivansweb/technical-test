<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Grade;
use Exception;

/**
 * Class GradeRepository
 * @package App\Repositories
 */
class GradeRepository extends Repository
{
    protected $model;

    /**
     * Dependecy Injector
     *
     * @param Grade $model
     * @throws Exception
     */
    public function __construct(Grade $model)
    {
        parent::__construct($model);
    }

}
