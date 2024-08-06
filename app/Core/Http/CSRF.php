<?php

namespace App\Core\Http;

class CSRF
{

    private $tokenName;

    public function __construct($tokenName = 'csrf_token')
    {
        $this->tokenName = $tokenName;
        if (!isset($_SESSION)) {
            session_start();
        }
    }


    public function generateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION[$this->tokenName] = $token;
        return $token;
    }

    public function getToken(): ?string
    {
        if (isset($_SESSION[$this->tokenName])) {
            return $_SESSION[$this->tokenName];
        }
        return null;
    }


    public function validateToken($token): bool
    {
        if (isset($_SESSION[$this->tokenName]) && hash_equals($_SESSION[$this->tokenName], $token)) {
            unset($_SESSION[$this->tokenName]);
            return true;
        }
        return false;
    }


    public function insertTokenInForm(): string
    {
        $token = $this->generateToken();
        return '<input type="hidden" name="' . $this->tokenName . '" value="' . $token . '">';
    }
}
