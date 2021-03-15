<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpprotectionInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upprotection_invs', function (Blueprint $table) {
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
        Schema::dropIfExists('upprotection_invs');
    }
}
