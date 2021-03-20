<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlInvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_invs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('weir_id',15);
            
            $table->smallInteger('waterctrl_erosion')->nullable();
            $table->smallInteger('waterctrl_subsidence')->nullable();
            $table->smallInteger('waterctrl_cracking')->nullable();
            $table->smallInteger('waterctrl_obstruction')->nullable();
            $table->smallInteger('waterctrl_hole')->nullable();
            $table->smallInteger('waterctrl_leak')->nullable();
            $table->smallInteger('waterctrl_movement')->nullable();
            $table->smallInteger('waterctrl_drainage')->nullable();
            $table->smallInteger('waterctrl_weed')->nullable();
            $table->text('waterctrl_damage')->nullable();
            $table->text('waterctrl_remake')->nullable();

            $table->smallInteger('sidewall_erosion')->nullable();
            $table->smallInteger('sidewall_subsidence')->nullable();
            $table->smallInteger('sidewall_cracking')->nullable();
            $table->smallInteger('sidewall_obstruction')->nullable();
            $table->smallInteger('sidewall_hole')->nullable();
            $table->smallInteger('sidewall_leak')->nullable();
            $table->smallInteger('sidewall_movement')->nullable();
            $table->smallInteger('sidewall_drainage')->nullable();
            $table->smallInteger('sidewall_weed')->nullable();
            $table->text('sidewall_damage')->nullable();
            $table->text('sidewall_remake')->nullable();

            $table->smallInteger('dgfloor_erosion')->nullable();
            $table->smallInteger('dgfloor_subsidence')->nullable();
            $table->smallInteger('dgfloor_cracking')->nullable();
            $table->smallInteger('dgfloor_obstruction')->nullable();
            $table->smallInteger('dgfloor_hole')->nullable();
            $table->smallInteger('dgfloor_leak')->nullable();
            $table->smallInteger('dgfloor_movement')->nullable();
            $table->smallInteger('dgfloor_drainage')->nullable();
            $table->smallInteger('dgfloor_weed')->nullable();
            $table->text('dgfloor_damage')->nullable();
            $table->text('dgfloor_remake')->nullable();

            $table->smallInteger('dgwall_erosion')->nullable();
            $table->smallInteger('dgwall_subsidence')->nullable();
            $table->smallInteger('dgwall_cracking')->nullable();
            $table->smallInteger('dgwall_obstruction')->nullable();
            $table->smallInteger('dgwall_hole')->nullable();
            $table->smallInteger('dgwall_leak')->nullable();
            $table->smallInteger('dgwall_movement')->nullable();
            $table->smallInteger('dgwall_drainage')->nullable();
            $table->smallInteger('dgwall_weed')->nullable();
            $table->text('dgwall_damage')->nullable();
            $table->text('dgwall_remake')->nullable();

            $table->smallInteger('dggate_erosion')->nullable();
            $table->smallInteger('dggate_subsidence')->nullable();
            $table->smallInteger('dggate_cracking')->nullable();
            $table->smallInteger('dggate_obstruction')->nullable();
            $table->smallInteger('dggate_hole')->nullable();
            $table->smallInteger('dggate_leak')->nullable();
            $table->smallInteger('dggate_movement')->nullable();
            $table->smallInteger('dggate_drainage')->nullable();
            $table->smallInteger('dggate_weed')->nullable();
            $table->text('dggate_damage')->nullable();
            $table->text('dggate_remake')->nullable();

            $table->smallInteger('dgmachanic_erosion')->nullable();
            $table->smallInteger('dgmachanic_subsidence')->nullable();
            $table->smallInteger('dgmachanic_cracking')->nullable();
            $table->smallInteger('dgmachanic_obstruction')->nullable();
            $table->smallInteger('dgmachanic_hole')->nullable();
            $table->smallInteger('dgmachanic_leak')->nullable();
            $table->smallInteger('dgmachanic_movement')->nullable();
            $table->smallInteger('dgmachanic_drainage')->nullable();
            $table->smallInteger('dgmachanic_weed')->nullable();
            $table->text('dgmachanic_damage')->nullable();
            $table->text('dgmachanic_remake')->nullable();

            $table->smallInteger('dgblock_erosion')->nullable();
            $table->smallInteger('dgblock_subsidence')->nullable();
            $table->smallInteger('dgblock_cracking')->nullable();
            $table->smallInteger('dgblock_obstruction')->nullable();
            $table->smallInteger('dgblock_hole')->nullable();
            $table->smallInteger('dgblock_leak')->nullable();
            $table->smallInteger('dgblock_movement')->nullable();
            $table->smallInteger('dgblock_drainage')->nullable();
            $table->smallInteger('dgblock_weed')->nullable();
            $table->text('dgblock_damage')->nullable();
            $table->text('dgblock_remake')->nullable();

            $table->smallInteger('waterbreak_erosion')->nullable();
            $table->smallInteger('waterbreak_subsidence')->nullable();
            $table->smallInteger('waterbreak_cracking')->nullable();
            $table->smallInteger('waterbreak_obstruction')->nullable();
            $table->smallInteger('waterbreak_hole')->nullable();
            $table->smallInteger('waterbreak_leak')->nullable();
            $table->smallInteger('waterbreak_movement')->nullable();
            $table->smallInteger('waterbreak_drainage')->nullable();
            $table->smallInteger('waterbreak_weed')->nullable();
            $table->text('waterbreak_damage')->nullable();
            $table->text('waterbreak_remake')->nullable();

            $table->smallInteger('bridge_erosion')->nullable();
            $table->smallInteger('bridge_subsidence')->nullable();
            $table->smallInteger('bridge_cracking')->nullable();
            $table->smallInteger('bridge_obstruction')->nullable();
            $table->smallInteger('bridge_hole')->nullable();
            $table->smallInteger('bridge_leak')->nullable();
            $table->smallInteger('bridge_movement')->nullable();
            $table->smallInteger('bridge_drainage')->nullable();
            $table->smallInteger('bridge_weed')->nullable();
            $table->text('bridge_damage')->nullable();
            $table->text('bridge_remake')->nullable();

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
        Schema::dropIfExists('control_invs');
    }
}
