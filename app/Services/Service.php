<?php

namespace App\Services;

use App\Repositories\Repository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 *
 * @package App\Services
 */
abstract class Service
{
    const ERROR = 'ERROR';

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Constuctor
     *
     * @param Repository|null $repository
     * @throws Exception
     */
    public function __construct(Repository $repository = null)
    {
       $this->repository = $repository;
    }

    /**
     * Create an entity
     *
     * @param array $params
     * @return mixed
     */
    public function create(array $params = []): mixed
    {
        return $this->repository->create($params);
    }

    /**
     * Update an entity
     *
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function update(array $params = []): mixed
    {
        return $this->repository->update($params);
    }

    /**
     * Delete an entity by id
     *
     * @param string|null $id
     * @return mixed
     * @throws Exception
     */
    public function delete(string $id = null): mixed
    {
        return $this->repository->delete($id);
    }

    /**
     * Get all data
     *
     * @param array $params
     * @return array|LengthAwarePaginator
     */
    public function getAll(array $params = []): LengthAwarePaginator|array
    {
        return $this->repository->getAll($params);
    }

    /**
     * Get entity by id
     *
     * @param int|null $id
     * @return mixed
     * @throws Exception
     */
    public function getById(int $id = null): mixed
    {
        return $this->repository->getById($id);
    }
}
