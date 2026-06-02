<?php

class RequestIdMiddleware implements MiddlewareInterface
{
    public function handle(array $request, callable $next)
    {
        $request['request_id'] = uniqid("req_", true);

        error_log("[REQUEST ID] " . $request['request_id']);

        return $next($request);
    }
}