<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Relação com a tabela users
            $table->string('atividade'); // tipo de exercício (ex: corrida, natação)
            $table->integer('duracao'); // duração em minutos
            $table->timestamp('realizado_em'); // data/hora em que foi realizado
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercicios');
    }
}
