<?php

namespace App\Core\Http;

class Session
{
    private static $instance;
    private string $flashKey = 'flash_messages';
    private string $errorsKey = 'errors_messages';
    private string $oldsKey = 'old_messages';
    private array $flashData = [];
    private array $errors = [];
    private array $olds = [];

    private function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION[$this->flashKey])) {
            $this->flashData = $_SESSION[$this->flashKey];
            unset($_SESSION[$this->flashKey]);
        }

        if (isset($_SESSION[$this->errorsKey])) {
            $this->errors = $_SESSION[$this->errorsKey];
            unset($_SESSION[$this->errorsKey]);
        }

        if (isset($_SESSION[$this->oldsKey])) {
            $this->olds = $_SESSION[$this->oldsKey];
            unset($_SESSION[$this->oldsKey]);
        }
    }

    public function getError($key)
    {
        return $this->errors[$key] ?? null;
    }

    private function __clone()
    {
    }


    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function has($key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy(): void
    {
        session_destroy();
        $_SESSION = [];
    }

    public function setFlash($key, $message): void
    {
        $_SESSION[$this->flashKey][$key] = $message;
    }

    public function getFlash($key)
    {
        if (isset($this->flashData[$key])) {
            $message = $this->flashData[$key];
            unset($this->flashData[$key]);
            return $message;
        }
        return null;
    }

    public function hasFlash($key): bool
    {
        return isset($this->flashData[$key]);
    }

    public function removeFlash($key): void
    {
        if ($this->hasFlash($key)) {
            unset($this->flashData[$key]);
        }
    }

    public function setError($error, $message): void
    {
        $_SESSION[$this->errorsKey][$error] = $message;
    }

    public function hasError($key): bool
    {
        return isset($this->errors[$key]);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setOld($field, $value): void
    {
        $_SESSION[$this->oldsKey][$field] = $value;
    }

    public function hasOld($field): bool
    {
        return isset($this->olds[$field]);
    }

    public function getOlds(): array
    {
        return $this->olds;
    }

    public function getOld($field): string
    {
        return $this->olds[$field] ?? '';
    }
}
