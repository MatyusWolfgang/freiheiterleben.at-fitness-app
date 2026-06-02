<?php

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    private function add(string $method, string $path, callable $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $route) {

            if ($route['method'] !== $method) {
                continue;
            }

            $pattern = $this->convertPathToRegex($route['path']);

            if (preg_match($pattern, $path, $matches)) {

                array_shift($matches);

                call_user_func($route['handler'], $matches);
                return;
            }
        }

        http_response_code(404);

        echo json_encode([
            'success' => false,
            'error' => 'Route not found'
        ]);
    }

    public function put(string $path, callable $handler): void
    {
        $this->add('PUT', $path, $handler);
    }

    public function delete(string $path, callable $handler): void
    {
        $this->add('DELETE', $path, $handler);
    }
    
    private function convertPathToRegex(string $path): string
    {
        // /api/exercises/{id} → regex
        $pattern = preg_replace(
            '#\{[a-zA-Z]+\}#',
            '([a-zA-Z0-9_-]+)',
            $path
        );

        return '#^' . $pattern . '$#';
    }
}