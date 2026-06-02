<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ .
'/../../../src/repositories/ExerciseRepository.php';

class ExerciseRepositoryTest
extends TestCase
{
    public function testFindAllReturnsArray(): void
    {
        $repo = new ExerciseRepository();

        $result = $repo->findAll();

        $this->assertIsArray($result);
    }
}