<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    // Esta é a linha mágica que libera a gravação no banco:
    protected $fillable = ['user_id', 'title', 'status'];

    // Uma Vaga pertence a um Recrutador (Usuário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Uma Vaga possui muitas Entrevistas
    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }
}