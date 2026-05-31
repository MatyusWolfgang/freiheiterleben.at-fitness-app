<?php

require_once __DIR__ . '/../api/controllers/ExerciseController.php';

header('Content-Type: application/json');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

/**
 * Minimal Router
 */
if ($uri === '/api/exercises') {

    $controller = new ExerciseController();

    if ($method === 'GET') {
        $controller->getAll();
        exit;
    }

    if ($method === 'POST') {
        $controller->create();
        exit;
    }

    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
    exit;
}

http_response_code(404);
echo json_encode(["error" => "Not found"]);