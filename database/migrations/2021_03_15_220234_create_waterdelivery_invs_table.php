<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterdeliveryInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waterdelivery_invs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('weir_id',15);

            $table->smallInteger('floor_erosion')->nullable();
            $table->smallInteger('floor_subsidence')->nullable();
            $table->smallInteger('floor_cracking')->nullable();
            $table->smallInteger('floor_obstruction')->nullable();
            $table->smallInteger('floor_hole')->nullable();
            $table->smallInteger('floor_leak')->nullable();
            $table->smallInteger('floor_movement')->nullable();
            $table->smallInteger('floor_drainage')->nullable();
            $table->smallInteger('floor_weed')->nullable();
            $table->text('floor_damage')->nullable();
            $table->text('floor_remake')->nullable();
            $table->smallInteger('check_floor')->nullable();

            $table->smallInteger('side_erosion')->nullable();
            $table->smallInteger('side_subsidence')->nullable();
            $table->smallInteger('side_cracking')->nullable();
            $table->smallInteger('side_obstruction')->nullable();
            $table->smallInteger('side_hole')->nullable();
            $table->smallInteger('side_leak')->nullable();
            $table->smallInteger('side_movement')->nullable();
            $table->smallInteger('side_drainage')->nullable();
            $table->smallInteger('side_weed')->nullable();
            $table->text('side_damage')->nullable();
            $table->text('side_remake')->nullable();

            $table->smallInteger('gate_erosion')->nullable();
            $table->smallInteger('gate_subsidence')->nullable();
            $table->smallInteger('gate_cracking')->nullable();
            $table->smallInteger('gate_obstruction')->nullable();
            $table->smallInteger('gate_hole')->nullable();
            $table->smallInteger('gate_leak')->nullable();
            $table->smallInteger('gate_movement')->nullable();
            $table->smallInteger('gate_drainage')->nullable();
            $table->smallInteger('gate_weed')->nullable();
            $table->text('gate_damage')->nullable();
            $table->text('gate_remake')->nullable();

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
        Schema::dropIfExists('waterdelivery_invs');
    }
}
