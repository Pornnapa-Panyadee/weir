<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImprovementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('improvement_plans', function (Blueprint $table) {
            $table->char('plan_id',15)->primary();
            $table->char('weir_id',15)->nullable();
      

            $table->boolean('plan_year_check')->nullable();
            $table->integer('plan_year')->nullable();
            $table->text('plan_type')->nullable();
            $table->text('plan_budget')->nullable();

            $table->boolean('proj_budget_check')->nullable();
            $table->integer('proj_budget')->nullable();
            $table->text('proj_type')->nullable();

            $table->boolean('plan_improve')->nullable();
            
            $table->boolean('plan_no')->nullable();


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
        Schema::dropIfExists('improvement_plans');
    }
}
