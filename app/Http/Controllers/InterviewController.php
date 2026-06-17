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

    // Salva os dados do candidato no banco de dados
    public function store(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $request->validate([
            'candidate_name' => 'required|string|max:255',
            'candidate_email' => 'required|email|max:255',
            'interview_date' => 'required|date|after_or_equal:today',
            'interview_time' => 'required',
        ]);

        Interview::create([
            'vacancy_id' => $vacancy->id,
            'candidate_name' => $request->candidate_name,
            'candidate_email' => $request->candidate_email,
            'interview_date' => $request->interview_date,
            'interview_time' => $request->interview_time,
            'status' => 'Pendente',
        ]);

        return redirect()->back()->with('success', 'Entrevista agendada com sucesso! O nosso RH entrará em contato.');
    }
}