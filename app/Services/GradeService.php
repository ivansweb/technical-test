<?php

namespace App\Services;

use App\Repositories\GradeRepository;

/**
 * Class GradeService
 * @package App\Services
 */
class GradeService extends Service
{
    public function __construct(GradeRepository $repository)
    {
        parent::__construct($repository);
    }
}
