<?php

namespace App\Http\Middleware;

use App\Core\Container;
use App\Core\Http\Session;
use Router\Contracts\MiddlewareInterface;
use Router\Http\Request;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, callable $next)
    {
        $session = Container::getInstance()->get(Session::class);

        if (!$session->has('user')) {
            return redirect('/login');
        }
        return $next($request);
    }
}