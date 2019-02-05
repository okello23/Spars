<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparsSummaryScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   //
        Schema::create('spars_summary_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');
            $table->double('indicator1_score',3,2);
            $table->double('indicator2_score',3,2);
            $table->double('indicator3_score',3,2);
            $table->double('indicator4_score',3,2);
            $table->double('indicator5_score',3,2);
            $table->double('indicator6_score',3,2);
            $table->double('indicator7_score',3,2);
            $table->double('indicator8_score',3,2);
            $table->double('indicator9_score',3,2);
            $table->double('indicator10_score',3,2);
            $table->double('indicator11_score',3,2);
            $table->double('indicator12_score',3,2);
            $table->double('indicator13_score',3,2);
            $table->double('indicator14_score',3,2);
            $table->double('indicator15_score',3,2);
            $table->double('indicator16_score',3,2);
            $table->double('indicator17_score',3,2);
            $table->double('indicator18_score',3,2);
            $table->double('indicator19_score',3,2);
            $table->double('indicator20_score',3,2);
            $table->double('indicator21_score',3,2);
            $table->double('indicator22_score',3,2);
            $table->double('indicator23_score',3,2);
            $table->double('indicator24_score',3,2);
            $table->double('indicator25_score',3,2);
            $table->double('indicator26_score',3,2);
            $table->double('indicator27_score',3,2);
            
            $table->integer('visit_number');
            $table->date('visit_date');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->foreign('health_facility_id')->references('id')->on('health_facilities');    
            $table->foreign('survey_summary_id')->references('id')->on('survey_summary');
        
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
        Schema::drop('spars_summary_scores');
    }
}
