<?php

class LoggingMiddleware implements MiddlewareInterface
{
    public function handle(array $request, callable $next)
    {
        error_log("[REQUEST] " . $request['method'] . " " . $request['uri']);

        $start = microtime(true);

        $response = $next($request);

        $duration = microtime(true) - $start;

        error_log("[RESPONSE TIME] " . round($duration * 1000, 2) . "ms");

        return $response;
    }
}