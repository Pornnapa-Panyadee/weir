<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeirSpaceificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weir_spaceifications', function (Blueprint $table) {
            $table->char('weir_spec_id',15)->primary();
            // 1.3
            $table->json('ridge_type')->nullable();
            $table->text('ridge_height')->nullable();
            $table->text('ridge_width')->nullable();
            // 1.4
            $table->boolean('gate_has')->nullable();
            $table->text('gate_type')->nullable();
            $table->json('gate_dimension')->nullable();
            $table->boolean('gate_machanic_has')->nullable();
            $table->text('gate_machanic_type')->nullable();
            // 1.5
            $table->boolean('control_building_has')->nullable();
            $table->json('control_building_type')->nullable();
            $table->boolean('control_building_gate_has')->nullable();
            $table->text('control_building_gate_type')->nullable();
            $table->json('control_building_gate_dimension')->nullable();
            $table->text('control_building_machanic_type')->nullable();

            // 2
            $table->boolean('canal_has')->nullable();
            $table->text('canal_type')->nullable();
            $table->json('canel_dimension')->nullable();
           

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
        Schema::dropIfExists('weir_spaceifications');
    }
}
