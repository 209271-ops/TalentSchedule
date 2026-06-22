<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Interview;

class InterviewController extends Controller
{
    // Mostra o formulário público para o candidato
    public function create($id)
    {
        // Busca a vaga no banco pelo ID. Se não achar, dá erro 404.
        $vacancy = Vacancy::findOrFail($id);
        
        return view('interviews.create', compact('vacancy'));
    }

    public function store(Request $request, $id) 
    {
        // 1. Busca a vaga primeiro
        $vacancy = Vacancy::findOrFail($id);

        // 2. Valida os dados do formulário
        $request->validate([
            'candidate_name'  => 'required|string|max:255',
            'candidate_email' => 'required|email|max:255',
            'phone'           => 'required|string|max:20', 
            'linkedin'        => 'nullable|string|max:255', 
            'interview_date'  => 'required|date',
            'interview_time'  => 'required',
        ]);

        // 3. Salva instanciando o modelo diretamente (Evita qualquer bloqueio de $fillable)
        $interview = new Interview();
        $interview->vacancy_id = $vacancy->id; // Associa a vaga de forma direta e segura
        $interview->candidate_name = $request->candidate_name;
        $interview->candidate_email = $request->candidate_email;
        $interview->phone = $request->phone;          
        $interview->linkedin = $request->linkedin;       
        $interview->interview_date = $request->interview_date;
        $interview->interview_time = $request->interview_time;
        $interview->status = 'pending'; // Força para 'Pendente' em português, combinando com seu painel
        $interview->save();

        return redirect()->back()->with('success', 'Candidatura enviada com sucesso! Em breve entraremos em contato.');
    }
   
    // Exclui um candidato do banco de dados
    public function destroy($id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();

        return redirect()->back()->with('success', 'Candidato removido com sucesso!');
    }
}