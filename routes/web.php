<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\InterviewController;


Route::get('/agendar/{id}', [InterviewController::class, 'create'])->name('interviews.create');
Route::post('/agendar/{id}', [InterviewController::class, 'store'])->name('interviews.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Protegemos essas rotas para que apenas usuários logados (RH) possam acessar
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/vagas', [VacancyController::class, 'index'])->name('vacancies.index');
    Route::post('/vagas', [VacancyController::class, 'store'])->name('vacancies.store');
});