<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',     // ID do usuário
        'name',        // Nome do medicamento
        'dosage',      // Dosagem (ex: "500mg", "10 unidades")
        'time',        // Horário de tomar
        'taken'        // Se já foi tomado hoje
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'time' => 'datetime:H:i', // Formata o campo time como hora
        'taken' => 'boolean'      // Garante que taken seja booleano
    ];

    /**
     * Relacionamento com o usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
