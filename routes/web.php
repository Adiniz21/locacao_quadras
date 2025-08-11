<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Rotas públicas (sem login) e rotas autenticadas (com login).
| Mantemos nomes de rotas estáveis para usar nos blades.
*/

/* ==========================  PÚBLICAS  ========================== */

// Landing/Home (página inicial do site)
Route::view('/', 'welcome')->name('home');
   // se preferir "welcome", troque o nome da view

// Páginas institucionais
Route::view('/sobre', 'about')->name('about');
Route::view('/contato', 'contact')->name('contact');

// Disponibilidade (busca) – pública por enquanto
Route::get('/disponibilidade', [AvailabilityController::class, 'index'])
    ->name('availability.index');


/* ========================  AUTENTICADAS  ======================== */

Route::middleware(['auth:sanctum', 'verified'])
->get('/home', function () {
    return view('home');
})
->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Usuários (CRUD)
    Route::resource('users', UserController::class);

    // Funcionários (CRUD) – usa nomes padrão: all-employees.index|create|store|show|edit|update|destroy
    Route::resource('all-employees', EmployeesController::class);

    // Placeholders para links do dashboard (remova quando implementar de verdade)
    Route::get('/reservas', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservas/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::post('/reservar', [ReservationController::class, 'store'])->name('reservations.store');
    Route::view('/favoritos', 'favorites.index')->name('favorites.index');
    Route::view('/minhas-quadras', 'venues.index')->name('venues.index');
});
