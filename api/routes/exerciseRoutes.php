<?php

$router->get(
    '/api/exercises',
    fn() => $exerciseController->getAll()
);

$router->post(
    '/api/exercises',
    fn() => $exerciseController->create()
);

$router->get(
    '/api/exercises/{id}',
    function ($params) use ($exerciseController) {
        $exerciseController->getById(
            (int)$params[0]
        );
    }
);

$router->put(
    '/api/exercises/{id}',
    function ($params) use ($exerciseController) {
        $exerciseController->update(
            (int)$params[0]
        );
    }
);

$router->delete(
    '/api/exercises/{id}',
    function ($params) use ($exerciseController) {
        $exerciseController->delete(
            (int)$params[0]
        );
    }
);