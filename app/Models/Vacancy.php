<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    // Liberando os campos para inserção em massa
    protected $fillable = [
        'user_id', 
        'title',
        'description',
        'salary',
        'status',
    ];

    // Uma Vaga pertence a um Usuário (Recrutador)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Uma Vaga possui muitas Entrevistas (Candidaturas)
    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }
}