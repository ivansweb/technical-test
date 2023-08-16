<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ComponentGrade;
use Exception;

/**
 * Class ComponentGradeRepository
 * @package App\Repositories
 */
class ComponentGradeRepository extends Repository
{
    protected $model;

    /**
     * Dependecy Injector
     *
     * @param ComponentGrade $model
     * @throws Exception
     */
    public function __construct(ComponentGrade $model)
    {
        parent::__construct($model);
    }

    public function getByInspectionId(int $idInspection): mixed
    {
        return $this->model
            ->where('inspection_id', $idInspection)
            ->get();
    }

}
