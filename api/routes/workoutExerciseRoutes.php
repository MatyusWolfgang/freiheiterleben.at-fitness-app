<?php

$router->post(
    '/api/workouts/{id}/exercises',
    function ($params) use ($workoutExerciseController) {

        $workoutExerciseController->create(
            (int)$params[0]
        );
    }
);