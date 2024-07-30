<?php


namespace App\Http\Controller;

use App\Core\Http\Controller;
use Router\Http\Response;


class WelcomeController extends Controller
{
    public function index(): Response
    {
        return view('welcome.welcome', ['title' => "Welcome!"]);
    }
}
