<?php


namespace App\Http\Controller;

use App\Core\Controller;


class WelcomeController extends Controller
{


    public function index()
    {
        return view('welcome.welcome', ['title' => "Bem vindo!"]);
    }
}
