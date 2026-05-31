<?php

use PHPUnit\Framework\TestCase;

class ExerciseApiTest extends TestCase
{
    public function testGetExercisesEndpointExists()
    {
        $result = file_get_contents(
            "http://nginx/api/exercises"
        );

        $this->assertNotFalse($result);
    }
}