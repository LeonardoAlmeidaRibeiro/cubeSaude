<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicaoGlicose extends Model
{
    use HasFactory;
    
    protected $table = 'medicoes_glicose';
    protected $fillable = [
        'user_id', 
        'valor', 
        'tipo_medicao', 
        'observacoes', 
        'medido_em'
    ];

    protected $casts = [
        'medido_em' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}