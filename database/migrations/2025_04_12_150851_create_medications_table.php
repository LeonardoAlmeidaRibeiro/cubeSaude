<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name'); // nome do medicamento
            $table->string('dosage'); // dose (ex: "500mg", "10 unidades")
            $table->time('time'); // horário de tomar
            $table->boolean('taken')->default(false); // se já foi tomado hoje
            $table->timestamps();
        });
    }
    // Esta estrutura permite:

    // Rastrear todos os medicamentos do usuário

    // Gerenciar estoque e reabastecimento

    // Configurar lembretes

    // Manter histórico de uso

    // Armazenar informações importantes sobre cada medicamento

    // Você pode ajustar os campos conforme as necessidades específicas do seu projeto.
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
