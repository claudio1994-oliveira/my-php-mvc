<?php


namespace App\Http\Controller;

use App\Core\Controller;
use App\Core\Http\Response;


class WelcomeController extends Controller
{
    public function index(): Response
    {
        return view('welcome.welcome', ['title' => "Bem vindo!"]);
    }
}
