<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeirLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weir_locations', function (Blueprint $table) {
            $table->char('weir_location_id',15)->primary();
            $table->point('utm')->nullable();
            $table->point('latlong')->nullable();
            $table->text('weir_village');
            $table->text('weir_tumbol');
            $table->text('weir_district');
            $table->text('weir_province');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weir_locations');
    }
}
