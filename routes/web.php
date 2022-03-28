<?php

use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function() {
    Route::resource('user-management',UserManagementController::class);
    Route::resource('zone',ZoneController::class);
    Route::resource('resident',ResidentController::class);

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
