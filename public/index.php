<?php

require_once __DIR__ . '/../src/http/Router.php';
require_once __DIR__ . '/../src/http/Response.php';
require_once __DIR__ . '/../api/controllers/ExerciseController.php';
require_once __DIR__ . '/../api/controllers/WorkoutController.php';

header('Content-Type: application/json');

$workoutController = new WorkoutController();

$router = new Router();

$pipeline = new MiddlewarePipeline();

$pipeline->add(new RequestIdMiddleware());
$pipeline->add(new LoggingMiddleware());
$pipeline->add(new AuthMiddleware());

$request = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI'],
];

$pipeline->handle($request, function ($request) use ($router) {
    $router->dispatch($request['method'], $request['uri']);
});

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

$router->get('/api/workouts', function () use ($workoutController) {
    $workoutController->getAll();
});

$router->get('/api/workouts/{id}', function ($params) use ($workoutController) {
    $workoutController->getById((int)$params[0]);
});

$router->post('/api/workouts', function () use ($workoutController) {
    $workoutController->create();
});

$router->put('/api/workouts/{id}', function ($params) use ($workoutController) {
    $workoutController->update((int)$params[0]);
});

$router->delete('/api/workouts/{id}', function ($params) use ($workoutController) {
    $workoutController->delete((int)$params[0]);
});