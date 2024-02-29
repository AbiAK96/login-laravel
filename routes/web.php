<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;

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

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'root'])->name('root')->middleware('auth');

//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

Route::prefix('/menu')->middleware('auth')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/sync/{id}', [MenuController::class, 'sync'])->name('menu.sync');
    Route::post('/sync', [MenuController::class, 'syncAll'])->name('menu-all.sync');
    Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
});

