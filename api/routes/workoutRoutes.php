<?php

global $router;

$router->get(
    '/api/workouts',
    fn() => $workoutController->getAll()
);

$router->post(
    '/api/workouts',
    fn() => $workoutController->create()
);

$router->get(
    '/api/workouts/{id}',
    function ($params) use ($workoutController) {
        $workoutController->getById(
            (int)$params[0]
        );
    }
);

$router->put(
    '/api/workouts/{id}',
    function ($params) use ($workoutController) {
        $workoutController->update(
            (int)$params[0]
        );
    }
);

$router->delete(
    '/api/workouts/{id}',
    function ($params) use ($workoutController) {
        $workoutController->delete(
            (int)$params[0]
        );
    }
);