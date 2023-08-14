<?php

namespace App\Services;

use App\Repositories\FarmRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Get entity by id
     *
     * @param int|null $id
     * @return Model
     * @throws Exception
     */
    public function getById(int $id = null): Model
    {
        return $this->repository->getById($id);
    }
}
