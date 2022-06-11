<?php

use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AppointmentController::class, 'welcome'])->name('welcome');
Route::get('/congrats', function () {
    return view('congrats');
});

Route::get('/datepicker',[AppointmentController::class, 'datepicker'])->name('datepicker');
Route::get('/resident-check',[AppointmentController::class, 'residentCheck'])->name('resident-check');
Route::post('/set-appointment',[AppointmentController::class, 'setAppointment'])->name('set-appointment');

Route::middleware(['auth'])->group(function() {
    Route::resource('user-management',UserManagementController::class);
    Route::resource('zone',ZoneController::class);
    Route::resource('resident',ResidentController::class);
    Route::resource('appointment',AppointmentController::class);
    Route::resource('holiday',HolidayController::class);

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('import-data',[DashboardController::class, 'import'])->name('import');
    Route::post('import-data',[DashboardController::class, 'importSave'])->name('import-save');
});

require __DIR__.'/auth.php';
