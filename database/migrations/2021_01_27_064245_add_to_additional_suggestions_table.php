<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToAdditionalSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additinal_suggestions', function (Blueprint $table) {
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
        Schema::table('additinal_suggestions', function (Blueprint $table) {
            //
        });
    }
}
