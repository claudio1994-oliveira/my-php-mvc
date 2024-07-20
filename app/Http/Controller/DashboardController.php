<?php

namespace App\Http\Controller;

use App\Core\Http\Controller;
use App\Core\Http\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return view('dashboard');
    }
}