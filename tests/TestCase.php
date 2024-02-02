<?php

namespace Tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Set up the test case.
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        require_once __DIR__ . '/../vendor/autoload.php';
    }
}
