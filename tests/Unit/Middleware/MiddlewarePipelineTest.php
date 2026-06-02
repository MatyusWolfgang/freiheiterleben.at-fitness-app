<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ .
'/../../../src/http/middleware/MiddlewarePipeline.php';

class MiddlewarePipelineTest
extends TestCase
{
    public function testMiddlewareChainExecutes(): void
    {
        $pipeline =
            new MiddlewarePipeline();

        $executed = false;

        $pipeline->handle(
            [],
            function () use (&$executed) {

                $executed = true;
            }
        );

        $this->assertTrue(
            $executed
        );
    }
}