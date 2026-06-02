<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../src/http/Router.php';

class RouterTest extends TestCase
{
    public function testRouteWithParameterMatches(): void
    {
        $router = new Router();

        $called = false;

        $router->get('/api/exercises/{id}', function ($params) use (&$called) {

            $called = true;

            $this->assertEquals(
                '5',
                $params[0]
            );
        });

        ob_start();

        $router->dispatch(
            'GET',
            '/api/exercises/5'
        );

        ob_end_clean();

        $this->assertTrue($called);
    }
}