<?php

namespace App\Services;

use App\Repositories\TurbineRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TurbineService
 * @package App\Services
 */
class TurbineService extends Service
{
    public function __construct(TurbineRepository $repository)
    {
        parent::__construct($repository);
    }

}
