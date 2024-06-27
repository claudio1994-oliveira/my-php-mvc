<?php

namespace App\Core;

use League\Container\Container as ContainerContainer;

class Container
{
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new ContainerContainer();
        }

        return static::$instance;
    }
}
