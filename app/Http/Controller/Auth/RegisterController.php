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
        return view('auth.register', ['title' => "Register"]);
    }

    public function store(): RedirectResponse
    {

        $this->validate([
            "name" => ['required', 'min' => [3], 'max' => [255]],
            "username" => ['required', 'min' => [3], 'max' => [255]],
            "email" => ['required', 'email', 'min' => [3], 'max' => [255]],
            "password" => ['required', 'min' => [3], 'max' => [255]],
        ]);

        $data = $this->request->getParsedBody();
        unset($data['csrf_token']);
        $user = new User(...$data);
        (new UserRepository())->create($user);

        $this->session->set('user', $user);

        return redirect('/dashboard');
    }
}
