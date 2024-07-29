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
        /** @TODO Create the validations rules here */

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
