<?php

namespace App\Core\Http;

class CSRF
{

    private string $tokenName;

    public function __construct($tokenName = 'csrf_token')
    {
        $this->tokenName = $tokenName;
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION[$this->tokenName])) {
            $_SESSION[$this->tokenName] = [];
        }
    }


    public function generateToken($formName): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION[$this->tokenName][$formName] = $token;
        return $token;
    }

    public function getToken($formName): ?string
    {
        if (isset($_SESSION[$this->tokenName][$formName])) {
            return $_SESSION[$this->tokenName][$formName];
        }
        return null;
    }


    public function validateToken($formName, $token): bool
    {
        if (isset($_SESSION[$this->tokenName][$formName]) && hash_equals($_SESSION[$this->tokenName][$formName], $token)) {
            unset($_SESSION[$this->tokenName][$formName]); // Invalida o token após uso
            return true;
        }
        return false;
    }


    public function insertTokenInForm($formName): string
    {
        $token = $this->generateToken($formName);
        return '<input type="hidden" name="' . $this->tokenName . '" value="' . $token . '">';
    }

    public function insertNameInform($formName)
    {
        return '<input type="hidden" name="form_name" value="' . $formName . '">';
    }
}
