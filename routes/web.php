<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('example')->controller(ExampleController::class)->group(function () {
    Route::get('/profile', 'profile');
    Route::get('/album', 'album');
    Route::get('/album/{uuid}', 'albumShow');
    Route::get('/employee', 'employee');
    Route::get('/banner', 'banner');
    Route::get('/alumni', 'alumni');
});
