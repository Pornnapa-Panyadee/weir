<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeirSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weir_surveys', function (Blueprint $table) {
            $table->char('weir_id',15)->primary();
            $table->char('weir_code',20);
            $table->text('weir_name')->nullable();

            $table->char('river_id')->nullable();
            $table->char('weir_spec_id')->nullable();
            $table->char('weir_location_id')->nullable();

            $table->text('weir_build')->nullable();
            $table->text('weir_age')->nullable();
            $table->json('weir_model')->nullable();
            $table->text('resp_name')->nullable();
            $table->text('transfer')->nullable();
            
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
        Schema::dropIfExists('weir_surveys');
    }
}
