<?php

require_once __DIR__ . '/../src/http/Router.php';
require_once __DIR__ . '/../src/http/Response.php';

require_once __DIR__ . '/../src/http/middleware/MiddlewareInterface.php';
require_once __DIR__ . '/../src/http/middleware/MiddlewarePipeline.php';
require_once __DIR__ . '/../src/http/middleware/RequestIdMiddleware.php';
require_once __DIR__ . '/../src/http/middleware/LoggingMiddleware.php';
require_once __DIR__ . '/../src/http/middleware/AuthMiddleware.php';

require_once __DIR__ . '/../api/controllers/ExerciseController.php';
require_once __DIR__ . '/../api/controllers/WorkoutController.php';

header('Content-Type: application/json');

/**
 * Controllers
 */
$exerciseController = new ExerciseController();
$workoutController = new WorkoutController();

/**
 * Router
 */
$router = new Router();

/**
 * Routes - Exercise
 */
$router->get('/api/exercises', fn() => $exerciseController->getAll());
$router->post('/api/exercises', fn() => $exerciseController->create());

$router->get('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->getById((int)$params[0]);
});

$router->put('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->update((int)$params[0]);
});

$router->delete('/api/exercises/{id}', function ($params) use ($exerciseController) {
    $exerciseController->delete((int)$params[0]);
});

/**
 * Routes - Workout
 */
$router->get('/api/workouts', fn() => $workoutController->getAll());

$router->get('/api/workouts/{id}', function ($params) use ($workoutController) {
    $workoutController->getById((int)$params[0]);
});

$router->post('/api/workouts', fn() => $workoutController->create());

$router->put('/api/workouts/{id}', function ($params) use ($workoutController) {
    $workoutController->update((int)$params[0]);
});

$router->delete('/api/workouts/{id}', function ($params) use ($workoutController) {
    $workoutController->delete((int)$params[0]);
});

/**
 * Middleware
 */
$pipeline = new MiddlewarePipeline();

$pipeline->add(new RequestIdMiddleware());
$pipeline->add(new LoggingMiddleware());
$pipeline->add(new AuthMiddleware());

$request = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI'],
];

/**
 * SINGLE ENTRY POINT
 */
$pipeline->handle($request, function ($request) use ($router) {
    $router->dispatch($request['method'], $request['uri']);
});