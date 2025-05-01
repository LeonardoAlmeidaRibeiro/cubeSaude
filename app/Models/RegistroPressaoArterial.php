<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPressaoArterial extends Model
{
    use HasFactory;

    protected $table = 'registros_pressao_arterial';

    protected $fillable = ['user_id', 'data', 'pressao_sistolica', 'pressao_diastolica', 'pulso', 'observacoes'];


    public function getCategoriaAttribute()
    {
        $sistolica = $this->pressao_sistolica;
        $diastolica = $this->pressao_diastolica;

        if ($sistolica >= 180 || $diastolica >= 120) {
            return 'Crise hipertensiva';
        } elseif ($sistolica >= 140 || $diastolica >= 90) {
            return 'Hipertensão Estágio 2';
        } elseif ($sistolica >= 130 || $diastolica >= 80) {
            return 'Hipertensão Estágio 1';
        } elseif ($sistolica >= 120 && $diastolica < 80) {
            return 'Pressão elevada';
        } elseif ($sistolica < 90 || $diastolica < 60) {
            return 'Hipotensão';
        } else {
            return 'Normal';
        }
    }
}
