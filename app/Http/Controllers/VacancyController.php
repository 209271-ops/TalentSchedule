<?php

namespace App\Http\Controllers;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    // Mostra a tela com a lista de vagas e o formulário
    public function index(Request $request)
    {
        // 1. Pega o ID do usuário (RH) logado
        $userId = auth()->id();

        // 2. Calcula os dados do Painel de Controle globais (Ignora o filtro para manter o placar correto)
        $allVacancies = Vacancy::where('user_id', $userId)->with('interviews')->get();
        $totalVacancies = $allVacancies->count();
        $openVacancies = $allVacancies->where('status', 'open')->count();
        
        // Soma todos os candidatos de todas as vagas deste usuário
        $totalCandidates = $allVacancies->sum(function($vacancy) {
            return $vacancy->interviews->count();
        });

        // 3. Lógica do Filtro da lista
        $filter = $request->query('filter', 'all');
        $query = Vacancy::where('user_id', $userId)->with('interviews');

        // Aplica o filtro se não for "all" (todas)
        if ($filter === 'open') {
            $query->where('status', 'open');
        } elseif ($filter === 'closed') {
            $query->where('status', 'closed');
        }

        // Busca as vagas filtradas, ordenando das mais recentes para as mais antigas
        $vacancies = $query->latest()->get();

        // 4. Retorna a view enviando as vagas e as variáveis dos contadores e do filtro
        return view('vacancies.index', compact(
            'vacancies', 
            'totalVacancies', 
            'openVacancies', 
            'totalCandidates',
            'filter'
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
    // Atualiza o status do candidato (Aprovado / Reprovado)
    public function updateInterviewStatus(Request $request, $id)
    {
        // 1. Busca a entrevista/candidatura pelo ID
        $interview = \App\Models\Interview::findOrFail($id);

        // 2. Valida para garantir que o status enviado seja apenas um dos permitidos
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        // 3. Atualiza e salva
        $interview->status = $request->status;
        $interview->save();

        // 4. Retorna para o painel com mensagem de sucesso
        return redirect()->back()->with('success', 'Status do candidato atualizado com sucesso!');
    }

    // 5. NOVA FUNÇÃO: ATIVAR / DESATIVAR VAGA DIRETAMENTE NO PAINEL
    public function toggleStatus($id)
    {
        // Busca a vaga garantindo que pertence ao usuário logado
        $vacancy = Vacancy::where('user_id', Auth::id())->findOrFail($id);
        
        // Se estiver aberta, muda para fechada. Se estiver fechada, muda para aberta.
        $vacancy->status = $vacancy->status === 'open' ? 'closed' : 'open';
        $vacancy->save();

        return redirect()->back()->with('success', 'Status da vaga alterado com sucesso!');
    }
}