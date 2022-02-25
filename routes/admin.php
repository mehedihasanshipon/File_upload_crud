<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('/dashboard', UserController::class);
    Route::post('/users/status/{id}', [UserController::class, 'disableUsers'])->name('users.ban');
});
