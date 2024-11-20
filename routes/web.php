<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/api/run-tests', [TestController::class, 'run']);
