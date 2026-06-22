<?php

namespace App\Http\Controllers;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    // Mostra a tela com a lista de vagas e o formulário
public function index()
{
    // 1. Pega o ID do usuário (RH) logado
    $userId = auth()->id();

    // 2. Busca todas as vagas DESSE usuário com os respectivos candidatos
    $vacancies = Vacancy::where('user_id', $userId)
                        ->with('interviews')
                        ->get();

    // 3. Calcula os dados do Painel de Controle dinamicamente
    $totalVacancies = $vacancies->count();
    $openVacancies = $vacancies->where('status', 'open')->count();
    
    // Soma todos os candidatos de todas as vagas deste usuário
    $totalCandidates = $vacancies->sum(function($vacancy) {
        return $vacancy->interviews->count();
    });

    // 4. Retorna a view enviando as vagas e as variáveis dos contadores
    return view('vacancies.index', compact(
        'vacancies', 
        'totalVacancies', 
        'openVacancies', 
        'totalCandidates'
    ));
}

    // Salva a nova vaga no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary' => 'nullable|string|max:255',
        ]);

        Vacancy::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'status' => 'open',
        ]);

        return redirect()->back()->with('success', 'Vaga criada com sucesso!');
    }

    // 1. Mostra a tela de edição da vaga
    public function edit($id)
    {
        $vacancy = Vacancy::where('user_id', Auth::id())->findOrFail($id);
        return view('vacancies.edit', compact('vacancy'));
    }
    
    // 2. Salva as alterações da vaga no banco
    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:open,closed',
            'description' => 'nullable|string',
            'salary' => 'nullable|string|max:255',
        ]);

        $vacancy->update([
            'title' => $request->title,
            'status' => $request->status,
            'description' => $request->description,
            'salary' => $request->salary,
        ]);

        return redirect()->route('vacancies.index')->with('success', 'Vaga atualizada com sucesso!');
    }

    // 3. Exclui a vaga do banco
    public function destroy($id)
    {
        $vacancy = Vacancy::where('user_id', Auth::id())->findOrFail($id);
        
        // Deleta também as entrevistas vinculadas a essa vaga para não quebrar o banco
        $vacancy->interviews()->delete();
        $vacancy->delete();

        return redirect()->route('vacancies.index')->with('success', 'Vaga excluída com sucesso!');
    }

    // 4. Atualiza o status do candidato (Entrevista)
    public function updateInterviewStatus(Request $request, $id)
    {
        // Encontra a entrevista pelo ID
        $interview = \App\Models\Interview::findOrFail($id);

        // Valida se o status enviado é um dos três permitidos
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Atualiza o status
        $interview->update([
            'status' => $request->status
        ]);

        return redirect()->route('vacancies.index')->with('success', 'Status do candidato atualizado!');
    }
}