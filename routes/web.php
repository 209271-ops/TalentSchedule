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
Route::get('/', function () {
    return view('welcome');
});

// Rotas do Candidato (Públicas)
Route::get('/agendar/{id}', [InterviewController::class, 'create'])->name('interviews.create');
Route::post('/agendar/{id}', [InterviewController::class, 'store'])->name('interviews.store');


/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (Apenas o RH logado pode acessar)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rotas do Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/interviews/{id}', [App\Http\Controllers\InterviewController::class, 'destroy'])->name('interviews.destroy');
});

// Grupo de Rotas de Gestão (Protegidas)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rotas de Vagas
    Route::get('/vagas', [VacancyController::class, 'index'])->name('vacancies.index');
    Route::post('/vagas', [VacancyController::class, 'store'])->name('vacancies.store');
    Route::get('/vagas/{id}/editar', [VacancyController::class, 'edit'])->name('vacancies.edit');
    Route::put('/vagas/{id}', [VacancyController::class, 'update'])->name('vacancies.update');
    Route::delete('/vagas/{id}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');

    // NOVA ROTA: Atualizar status do candidato
    Route::put('/entrevistas/{id}/status', [VacancyController::class, 'updateInterviewStatus'])->name('interviews.updateStatus');
});

require __DIR__.'/auth.php';