<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
    use HasFactory;
    
    protected $table = 'refeicoes';
    
    protected $fillable = [
        'user_id',
        'nome',
        'tipo_refeicao',
        'carboidratos',
        'consumido_em',
    ];

    protected $casts = [
        'consumido_em' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}