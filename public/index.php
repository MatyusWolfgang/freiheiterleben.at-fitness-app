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
require_once __DIR__ . '/../api/controllers/WorkoutExerciseController.php';

header('Content-Type: application/json');

$router = new Router();

$exerciseController = new ExerciseController();
$workoutController = new WorkoutController();
$workoutExerciseController = new WorkoutExerciseController();

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

require_once __DIR__ . '/../api/routes/exerciseRoutes.php';
require_once __DIR__ . '/../api/routes/workoutRoutes.php';
require_once __DIR__ . '/../api/routes/workoutExerciseRoutes.php';

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/

$pipeline = new MiddlewarePipeline();

$pipeline->add(new RequestIdMiddleware());
$pipeline->add(new LoggingMiddleware());
$pipeline->add(new AuthMiddleware());

$request = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI']
];

$pipeline->handle(
    $request,
    fn($request) =>
        $router->dispatch(
            $request['method'],
            $request['uri']
        )
);