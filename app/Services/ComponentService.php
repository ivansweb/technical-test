<?php

namespace App\Services;

use App\Repositories\ComponentRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ComponentService
 * @package App\Services
 */
class ComponentService extends Service
{
    public function __construct(ComponentRepository $repository)
    {
        parent::__construct($repository);
    }
}
