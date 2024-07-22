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

    public function session()
    {
        return app(Session::class);
    }

}