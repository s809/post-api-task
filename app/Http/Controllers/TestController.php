<?php

namespace App\Http\Controllers;

use App\Services\Test;
use Illuminate\Routing\Controller;

class TestController extends Controller
{
    public function __construct(
        private Test $test
    ) {}

    public function run()
    {
        $this->test->runTest();
    }
}
