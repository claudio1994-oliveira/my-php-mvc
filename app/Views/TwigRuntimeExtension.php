<?php

namespace App\Views;

use App\Config\Config;
use App\Core\Http\Session;
use Twig\Extension\AbstractExtension;

class TwigRuntimeExtension extends AbstractExtension
{

    public function config()
    {
        return app(Config::class);
    }

    public function auth()
    {
        return app(Session::class)->has('user');
    }

    public function user()
    {
        return app(Session::class)->has('user') ? app(Session::class)->get('user') : null;
    }

    public function session()
    {
        return app(Session::class);
    }

    public function error($key): null|string
    {
        return app(Session::class)->hasError($key) ? app(Session::class)->getError($key) : null;
    }

    public function errors(): array
    {
        return app(Session::class)->getErrors();
    }

}