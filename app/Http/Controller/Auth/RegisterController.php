<?php

namespace App\Http\Controller\Auth;

use App\Core\Http\Controller;
use App\Core\Http\Response;

class RegisterController extends Controller
{
    public function create(): Response
    {
        return view('auth.register');
    }
}