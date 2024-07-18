<?php

namespace App\Core\Http;

class Session
{
    // Instância única da classe
    private static $instance;
    private $flashKey = 'flash_messages';

    private function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key)
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy()
    {
        session_destroy();
        $_SESSION = [];
    }

    public function setFlash($key, $message)
    {
        $_SESSION[$this->flashKey][$key] = $message;
    }

    public function getFlash($key)
    {
        if (isset($_SESSION[$this->flashKey][$key])) {
            $message = $_SESSION[$this->flashKey][$key];
            unset($_SESSION[$this->flashKey][$key]);
            return $message;
        }
        return null;
    }

    public function hasFlash($key)
    {
        return isset($_SESSION[$this->flashKey][$key]);
    }

    public function removeFlash($key)
    {
        if ($this->hasFlash($key)) {
            unset($_SESSION[$this->flashKey][$key]);
        }
    }
}