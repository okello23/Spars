<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderingReceiptingRecording16Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   
        Schema::create('spars_ordering_16', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');

            $table->date('sub_indicator_16a');
            $table->date('sub_indicator_16b');            
            $table->integer('sub_indicator_16c');
            $table->date('sub_indicator_16d');
            $table->date('sub_indicator_16e');
            $table->integer('sub_indicator_16f');
            $table->text('indicator_16_comments')->nullable();
            $table->double('score', 3, 2);
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
        Schema::drop('spars_ordering_16');
    }
}
