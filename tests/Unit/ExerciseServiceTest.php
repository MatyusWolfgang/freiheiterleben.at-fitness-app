<?php

use PHPUnit\Framework\TestCase;

class ExerciseServiceTest extends TestCase
{
    public function testMissingNameThrowsException()
    {
        $service = new ExerciseService();

        $this->expectException(Exception::class);

        $service->createExercise([
            "type" => "repetition"
        ]);
    }
}