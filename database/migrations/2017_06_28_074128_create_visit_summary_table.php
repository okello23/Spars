<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        Schema::create('survey_summary', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visit_date');
            $table->date('next_visit_date');
            $table->integer('health_facility_id')->unsigned();
            $table->foreign('health_facility_id')->references('id')->on('health_facilities');
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
        Schema::drop('survey_summary');
    }
}
