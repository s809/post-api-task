<?php

namespace App\Http\Controllers;

use App\Services\Test;

abstract class TestController
{
    public function __construct(
        private Test $test
    ) {}

    public function run()
    {
        $this->test->runTest();
    }
}
