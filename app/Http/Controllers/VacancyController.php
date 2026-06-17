<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    // Mostra a tela com a lista de vagas e o formulário
    public function index()
{
    // O 'with' carrega as entrevistas junto com a vaga, otimizando o banco de dados
    $vacancies = Vacancy::where('user_id', Auth::id())
                        ->with('interviews') 
                        ->get();
        
    return view('vacancies.index', compact('vacancies'));
}

    // Salva a nova vaga no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Vacancy::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'status' => 'open',
        ]);

        return redirect()->back()->with('success', 'Vaga criada com sucesso!');
    }
}