<?php

interface MiddlewareInterface
{
    public function handle(array $request, callable $next);
}