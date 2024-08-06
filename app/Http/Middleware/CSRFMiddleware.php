<?php

namespace App\Http\Middleware;

use App\Core\Container;
use App\Core\Http\CSRF;
use Router\Http\Request;
use Router\Contracts\MiddlewareInterface;

class CSRFMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next)
    {
        if ($request->getMethod() === 'POST') {

            $csrf = Container::getInstance()->get(CSRF::class);
            $token = $request->getParsedBody()['csrf_token'] ?? '';
            $formName = $request->getParsedBody()['form_name'] ?? '';


            if (!$csrf->validateToken($formName, $token)) {
                echo 'Invalid CSRF Token';
                die();
            }
        }
        return $next($request);
    }
}
