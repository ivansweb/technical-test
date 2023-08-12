<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends Service
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a new user
     *
     * @param array $params
     * @return LengthAwarePaginator|User
     */
    public function store(array $params = []): LengthAwarePaginator|User
    {
        $params = [
            "name" =>  $params['name'],
            "email" =>  $params['email'],
            "password" => Hash::make($params['password']),
            "remember_token" => Str::random(10),
            "expires_at" => Carbon::now()->addDays(365)->toDateTimeString()
        ];
        return $this->repository->create($params);
    }

    /**
     * Get all users
     *
     * @param array $params
     * @return LengthAwarePaginator|array
     */
    public function getAll(array $params = []): LengthAwarePaginator|array
    {
        return $this->repository->getAll($params);
    }


    /**
     * verify auth credentials
     *
     * @param array $params
     * @return
     */
    public function signin(array $params = [])
    {
        return $this->repository->signin($params);
    }



}
