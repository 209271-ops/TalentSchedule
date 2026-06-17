<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    // Liberando os campos para o formulário do candidato salvar no banco
    protected $fillable = [
        'vacancy_id', 
        'candidate_name', 
        'candidate_email', 
        'interview_date', 
        'interview_time', 
        'status', 
        'feedback'
    ];

    // Uma Entrevista pertence a uma Vaga
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}