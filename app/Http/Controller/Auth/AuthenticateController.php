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
        
        $messages = [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'password.required' => 'O campo senha é obrigatório'
        ];

        $this->validate(
            [
                'email' => [
                    'required',
                    'min' => [3],
                    'email'
                ],
                'password' => ['required']
            ],
            $messages
        );

        $user = (new UserRepository())->findByEmail($this->request->getParsedBody()['email']);
        if ($user) {
            if ($user->verifyPassword($this->request->getParsedBody()['password'])) {
                $this->session->set('user', $user);

                return redirect('/dashboard');
            }
        }


        $this->session->setFlash('error', "We couldn't find you with those credentials.");
        return redirect('/login');
    }

    public function destroy(): RedirectResponse
    {
        $this->session->destroy();

        return redirect('/');
    }
}
