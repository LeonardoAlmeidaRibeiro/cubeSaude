<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento'

    ];
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
