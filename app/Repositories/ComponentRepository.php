<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Component;
use Exception;

/**
 * Class ComponentRepository
 * @package App\Repositories
 */
class ComponentRepository extends Repository
{
    protected $model;

    /**
     * Dependecy Injector
     *
     * @param Component $model
     * @throws Exception
     */
    public function __construct(Component $model)
    {
        parent::__construct($model);
    }

}
