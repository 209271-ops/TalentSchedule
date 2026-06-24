<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\InterviewController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS (Não precisa de login)
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/login');

// Rotas do Candidato (Públicas)
Route::get('/agendar/{id}', [InterviewController::class, 'create'])->name('interviews.create');
Route::post('/agendar/{id}', [InterviewController::class, 'store'])->name('interviews.store');


/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (Apenas o RH logado pode acessar)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // Redireciona direto para a tela de listagem de vagas
    return redirect()->route('vacancies.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rotas do Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grupo de Rotas de Gestão (Protegidas)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rotas de Vagas
    Route::get('/vagas', [VacancyController::class, 'index'])->name('vacancies.index');
    Route::post('/vagas', [VacancyController::class, 'store'])->name('vacancies.store');
    Route::get('/vagas/{id}/editar', [VacancyController::class, 'edit'])->name('vacancies.edit');
    Route::put('/vagas/{id}', [VacancyController::class, 'update'])->name('vacancies.update');
    Route::delete('/vagas/{id}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');
    // Rotas de Vagas
    Route::get('/vagas', [VacancyController::class, 'index'])->name('vacancies.index');
    Route::post('/vagas', [VacancyController::class, 'store'])->name('vacancies.store');
    Route::get('/vagas/{id}/editar', [VacancyController::class, 'edit'])->name('vacancies.edit');
    Route::put('/vagas/{id}', [VacancyController::class, 'update'])->name('vacancies.update');
    Route::delete('/vagas/{id}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');
    
    // NOVA ROTA: Ligar/Desligar Vaga
    Route::patch('/vagas/{id}/status', [VacancyController::class, 'toggleStatus'])->name('vacancies.toggleStatus');

    // Rotas de Candidatos (Entrevistas)
    Route::delete('/interviews/{id}', [InterviewController::class, 'destroy'])->name('interviews.destroy');
    
    // ROTA CORRIGIDA: Apontando para o InterviewController e o método updateStatus
    Route::put('/entrevistas/{id}/status', [InterviewController::class, 'updateStatus'])->name('interviews.updateStatus');
});

require __DIR__.'/auth.php';