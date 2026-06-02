<?php

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(array $request, callable $next)
    {
        // später JWT / Token Check
        $headers = getallheaders();

        $request['user'] = $headers['X-User'] ?? null;

        return $next($request);
    }
}