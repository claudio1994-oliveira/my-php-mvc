<?php

namespace App\Http\Controller\Auth;

use App\Core\Http\Controller;
use Router\Http\Response;
use App\Http\Entity\User;
use App\Repository\UserRepository;

class RegisterController extends Controller
{
    public function create(): Response
    {
        return view('auth.register');
    }

    public function store()
    {
        $user = new User(... $this->request->getParsedBody());
        (new UserRepository())->create($user);

        $this->session->set('user', $user);

    }
}