<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeesController;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

    Route::middleware(['auth:sanctum', 'verified'])
    ->get('/home', function () {
        return view('home');
    })
    ->name('home');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::get('all-employees', [
            EmployeesController::class,
            'index',
        ])->name('all-employees.index');
        Route::post('all-employees', [
            EmployeesController::class,
            'store',
        ])->name('all-employees.store');
        Route::get('all-employees/create', [
            EmployeesController::class,
            'create',
        ])->name('all-employees.create');
        Route::get('all-employees/{employees}', [
            EmployeesController::class,
            'show',
        ])->name('all-employees.show');
        Route::get('all-employees/{employees}/edit', [
            EmployeesController::class,
            'edit',
        ])->name('all-employees.edit');
        Route::put('all-employees/{employees}', [
            EmployeesController::class,
            'update',
        ])->name('all-employees.update');
        Route::delete('all-employees/{employees}', [
            EmployeesController::class,
            'destroy',
        ])->name('all-employees.destroy');
    });
