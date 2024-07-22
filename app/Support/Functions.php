<?php

use App\Core\Container;
use App\Core\Http\RedirectResponse;
use Router\Http\Response;
use App\Views\View;

function view(string $path, array $data = []): Response
{
    $view = Container::getInstance()->get(View::class);
    $response = new Response();

    $response->withHeader('Content-Type', 'text/html');
    $response->writeBody($view->render($path, $data));

    return $response->dispatch();
}

function redirect(string $url): RedirectResponse
{
    $response = new RedirectResponse($url);


    $response->dispatch();
}
