<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('user.dashboard');
    Route::get('/file-lists',[ImportController::class,'index'])->name('filelist.index');
    Route::get('import/file', [ImportController::class, 'import'])->name('import.file');
    Route::post('import', [ImportController::class, 'storeImport'])->name('import.store');
    Route::post('import', [ImportController::class, 'storeImport'])->name('import.store');
    Route::get('/group-list/{id}', [ImportController::class, 'show'])->name('import.groupList');
    Route::get('/contact-list/{id}', [ImportController::class, 'getContactList'])->name('import.contactList');
});
