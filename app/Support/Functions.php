<?php

use App\Core\Container;
use App\Core\Response;
use App\Views\View;

function view(string $path, array $data = [])
{
    $view = Container::getInstance()->get(View::class);
    $response = new Response();

    $response->withHeader('Content-Type', 'text/html');
    $response->writeBody($view->render($path, $data));

    return $response->dispatch();
}
