<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     *
     * @return Response
     */
    public function index(): Response
    {

        return Inertia::render('Dashboard', [
            'page' => [
                'title' => 'Dashboard',
            ]
        ]);
    }

    /**
     * Display the Login page.
     *
     * @return Response
     */
    public function login(): Response
    {
        return Inertia::render('Login');
    }

}
