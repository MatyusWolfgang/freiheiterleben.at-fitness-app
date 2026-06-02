<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../src/http/Validator.php';

class ValidatorTest extends TestCase
{
    public function testRequiredFails(): void
    {
        $validator = new Validator();

        $validator->required([], 'name');

        $this->assertTrue(
            $validator->fails()
        );
    }

    public function testNumericPasses(): void
    {
        $validator = new Validator();

        $validator->numeric(
            ['factor' => 1.5],
            'factor'
        );

        $this->assertFalse(
            $validator->fails()
        );
    }
}