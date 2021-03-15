<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToImprovementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('improvement_plans', function (Blueprint $table) {
            $table->foreign('weir_id')->references('weir_id')->on('weir_surveys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('improvement_plans', function (Blueprint $table) {
            //
        });
    }
}
