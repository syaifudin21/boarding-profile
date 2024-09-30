<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\LandingPage\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/album', [HomeController::class, 'album'])->name('album');
Route::get('/album/{uuid}', [HomeController::class, 'albumShow'])->name('album.show');

Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}/{uuid}', [HomeController::class, 'blogShow'])->name('blog.show');

Route::get('/employee', [HomeController::class, 'employee'])->name('employee');

Route::get('/facility', [HomeController::class, 'facility'])->name('facility');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/message', [HomeController::class, 'messageStore'])->name('message.store');

Route::get('/alumni', [HomeController::class, 'alumni'])->name('alumni');
Route::post('/alumni', [HomeController::class, 'alumniStore'])->name('alumni.store');

Route::get('clear', [HomeController::class, 'clear']);

Route::prefix('example')->controller(ExampleController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/profile', 'profile');
    Route::get('/album', 'album');
    Route::get('/album/{uuid}', 'albumShow');
    Route::get('/employee', 'employee');
    Route::get('/banner', 'banner');
    Route::get('/alumni', 'alumni');
});
