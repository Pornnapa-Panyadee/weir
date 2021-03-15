<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToWeirSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weir_surveys', function (Blueprint $table) {
            $table->foreign('river_id')->references('river_id')->on('rivers')->onDelete('cascade');
            $table->foreign('weir_spec_id')->references('weir_spec_id')->on('weir_spaceifications')->onDelete('cascade');
            $table->foreign('weir_location_id')->references('weir_location_id')->on('weir_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weir_surveys', function (Blueprint $table) {
            //
        });
    }
}
