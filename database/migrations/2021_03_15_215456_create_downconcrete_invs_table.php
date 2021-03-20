<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownconcreteInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downconcrete_invs', function (Blueprint $table) {
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
            $table->json('floor_remake')->nullable();
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
            $table->json('side_remake')->nullable();

            $table->smallInteger('flrblock_erosion')->nullable();
            $table->smallInteger('flrblock_subsidence')->nullable();
            $table->smallInteger('flrblock_cracking')->nullable();
            $table->smallInteger('flrblock_obstruction')->nullable();
            $table->smallInteger('flrblock_hole')->nullable();
            $table->smallInteger('flrblock_leak')->nullable();
            $table->smallInteger('flrblock_movement')->nullable();
            $table->smallInteger('flrblock_drainage')->nullable();
            $table->smallInteger('flrblock_weed')->nullable();
            $table->text('flrblock_damage')->nullable();
            $table->json('flrblock_remake')->nullable();

            $table->smallInteger('endsill_erosion')->nullable();
            $table->smallInteger('endsill_subsidence')->nullable();
            $table->smallInteger('endsill_cracking')->nullable();
            $table->smallInteger('endsill_obstruction')->nullable();
            $table->smallInteger('endsill_hole')->nullable();
            $table->smallInteger('endsill_leak')->nullable();
            $table->smallInteger('endsill_movement')->nullable();
            $table->smallInteger('endsill_drainage')->nullable();
            $table->smallInteger('endsill_weed')->nullable();
            $table->text('endsill_damage')->nullable();
            $table->json('endsill_remake')->nullable();

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
        Schema::dropIfExists('downconcrete_invs');
    }
}
