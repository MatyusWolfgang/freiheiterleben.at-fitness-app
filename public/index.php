<?php

require_once __DIR__ . '/../src/http/Router.php';
require_once __DIR__ . '/../api/controllers/ExerciseController.php';
require_once __DIR__ . '/../src/http/Response.php';

header('Content-Type: application/json');

$router = new Router();

$exerciseController = new ExerciseController();

$router->get('/api/exercises', function () use ($exerciseController) {
    $exerciseController->getAll();
});

$router->post('/api/exercises', function () use ($exerciseController) {
    $exerciseController->create();
});

$router->get('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->getById((int)$params[0]);
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$router->get('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->getById((int)$params[0]);
});

$router->put('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->update((int)$params[0]);
});

$router->delete('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->delete((int)$params[0]);
});