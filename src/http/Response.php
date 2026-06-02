<?php

class Response
{
    public static function json(mixed $data = null, int $statusCode = 200): void
    {
        http_response_code($statusCode);

        header('Content-Type: application/json');

        echo json_encode([
            'success' => $statusCode < 400,
            'data' => $data,
            'error' => null
        ]);

        exit;
    }

    public static function success(mixed $data = null, int $statusCode = 200): void
    {
        self::json($data, $statusCode);
    }

    public static function error(string $message, int $statusCode = 400, mixed $details = null): void
    {
        http_response_code($statusCode);

        header('Content-Type: application/json');

        echo json_encode([
            'success' => false,
            'data' => $details,
            'error' => $message
        ]);

        exit;
    }
}