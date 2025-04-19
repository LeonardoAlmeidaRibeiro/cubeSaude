<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'atividade', 'duracao', 'realizado_em'];

    protected $casts = [
        'realizado_em' => 'datetime',
    ];

    // Relação com o usuário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}