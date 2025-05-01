<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaPressaoArterialMedicacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pressao_arterial_medicacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('nome'); // nome do medicamento
            $table->string('dosagem'); // dose (ex: "500mg", "10 unidades")
            $table->time('horario'); // horário de tomar
            $table->boolean('tomado')->default(false); // se já foi tomado hoje
            $table->text('observacoes')->nullable(); // observações adicionais
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pressao_arterial_medicacoes');
    }
}
