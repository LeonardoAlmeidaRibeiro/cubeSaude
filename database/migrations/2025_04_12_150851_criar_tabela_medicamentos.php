<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaMedicamentos extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nome'); // nome do medicamento
            $table->string('dosagem'); // dose (ex: "500mg", "10 unidades")
            $table->time('horario'); // horário de tomar
            $table->boolean('tomado')->default(false); // se já foi tomado hoje
            $table->text('observacoes')->nullable(); // observações adicionais
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}