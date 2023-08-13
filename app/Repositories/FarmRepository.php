<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Farm;
use Exception;
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

}
