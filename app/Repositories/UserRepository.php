<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends Repository
{

    protected $model;

    /**
     * Dependecy Injector
     *
     * @param User $model
     * @throws Exception
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Create new user
     *
     * @param array $params
     * @return mixed
     */
    public function create(array $params = []): mixed
    {
        $this->model->fill($params);
        return $this->model->create($params);
    }

    /**
     * verify auth credentials
     *
     * @param array $params
     * @return mixed
     */
    public function signin(array $params = []): mixed
    {

        $user = $this->model->where('email', $params['email'])->first();

        if (
            $user &&
            Auth::attempt(['email' => $params['email'], 'password' => $params['password']])
        ) {
             return $user;
        }

        return false;
    }

    /**
     * sign out the user
     *
     * @return bool
     */
    public function signout(): bool
    {
        Auth::logout();
        return true;
    }
}
