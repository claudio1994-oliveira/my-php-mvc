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

        $this->validate([
            "name" => ['required', 'min' => [3], 'max' => [255]],
            "username" => ['required', 'min' => [3], 'max' => [255]],
            "email" => ['required', 'email', 'min' => [3], 'max' => [255]],
            "password" => ['required', 'min' => [3], 'max' => [255]],
        ]);

        $user = new User(... $this->request->getParsedBody());
        (new UserRepository())->create($user);

        $this->session->set('user', $user);

        return redirect('/dashboard');
    }
}