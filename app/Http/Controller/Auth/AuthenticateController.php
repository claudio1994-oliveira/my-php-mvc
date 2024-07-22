<?php

namespace App\Http\Controller\Auth;

use App\Core\Http\Controller;
use App\Core\Http\RedirectResponse;
use Router\Http\Response;
use App\Repository\UserRepository;

class AuthenticateController extends Controller
{
    public function create(): Response
    {
        return view('auth.login');
    }

    public function store(): RedirectResponse
    {
        $user = (new UserRepository())->findByEmail($this->request->getParsedBody()['email']);
        if (!$user) {
            return redirect('/login');
        }
        if ($user->verifyPassword($this->request->getParsedBody()['password'])) {
            $this->session->set('user', $user);

            return redirect('/dashboard');
        }
    }

    public function destroy(): RedirectResponse
    {
        $this->session->destroy();

        return redirect('/');
    }
}
