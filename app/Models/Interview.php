<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    // Liberando os campos para o formulário do candidato salvar no banco
    protected $fillable = [
        'vacancy_id', 
        'candidate_name', 
        'candidate_email', 
        'phone',
        'linkedin',
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