<?php

namespace App\Services;

use App\Repositories\FarmRepository;

/**
 * Class FarmService
 * @package App\Services
 */
class FarmService extends Service
{
    public function __construct(FarmRepository $repository)
    {
        parent::__construct($repository);
    }

}
