<?php

namespace App\Http\Controller\Auth;

use App\Core\Http\Controller;
use App\Core\Http\RedirectResponse;
use Router\Http\Response;
use App\Http\Entity\User;
use App\Repository\UserRepository;

class RegisterController extends Controller
{
    public function create(): Response
    {
        return view('auth.register');
    }

    public function store(): RedirectResponse
    {
        $user = new User(... $this->request->getParsedBody());
        (new UserRepository())->create($user);

        $this->session->set('user', $user);

        return redirect('/dashboard');
    }
}