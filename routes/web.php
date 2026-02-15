<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::resource('appointments', AppointmentController::class);

    /*
    |--------------------------------------------------------------------------
    | SOLO ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('doctors', DoctorController::class);
        // Aquí luego irán:
        Route::resource('patients', PatientController::class);
        // Route::resource('users', UserController::class);

    });

    Route::middleware(['auth','role:doctor'])->group(function () {
    
    Route::get('/doctor', function () {
            return view('doctor.dashboard');
        });
    });

    Route::middleware(['auth','role:patient'])->group(function () {
        Route::get('/patient', function () {
            return view('patient.dashboard');
        });
    });


});
