<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlucoseMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glucose_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('value', 5, 2); // valor da medição (ex: 120.50)
            $table->string('measurement_type'); // 'jejum', 'pre-refeicao', 'pos-refeicao'
            $table->timestamp('measured_at'); // data/hora da medição
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
        Schema::dropIfExists('glucose_measurements');
    }
}
