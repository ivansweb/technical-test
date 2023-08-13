<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    public UserService $service;

    //dependency injection
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for user login.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Login');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $payload = $request->validated();

        if(!$this->service->store($payload)){
            return to_route('users.create');
        }

        return to_route('dashboard');
    }

    /**
     * @param SigninRequest $request
     * @return RedirectResponse|Response
     */
    public function signin(SigninRequest $request): RedirectResponse|Response
    {
       $payload = $request->validated();
       if(!$this->service->signin($payload)){
           return Inertia::render('Login', array('error' => 'Invalid Credentials'));
       }

        return to_route('dashboard');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function signout(Request $request): RedirectResponse
    {
        $this->service->signout();

        return to_route('dashboard');
    }


}
