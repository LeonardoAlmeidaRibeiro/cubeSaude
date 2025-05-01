<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentoPressao extends Model
{
    use HasFactory;

    protected $table = 'pressao_arterial_medicacoes';

    protected $fillable = [
        'user_id',
        'nome',
        'dosagem',
        'horario',
        'tomado',
        'observacoes'
    ];

    protected $casts = [
        'horario' => 'datetime:H:i',
        'tomado' => 'boolean'
    ];

    /**
     * Relacionamento com o usuário
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}