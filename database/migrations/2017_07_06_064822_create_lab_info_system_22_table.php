<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabInfoSystem22Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('spars_info_system_22', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');
            $table->integer('sub_indicator_22a');
            $table->integer('sub_indicator_22b');
            $table->integer('sub_indicator_22c');
            $table->integer('sub_indicator_22d');
            $table->integer('sub_indicator_22e');
            $table->integer('sub_indicator_22f');
            $table->integer('sub_indicator_22g');
            $table->integer('sub_indicator_22h');
            $table->integer('sub_indicator_22i');
            $table->integer('sub_indicator_22j');
            $table->integer('sub_indicator_22k');
            $table->integer('sub_indicator_22l');
            $table->integer('sub_indicator_22m');
            $table->integer('sub_indicator_22n');
            $table->text('indicator_22_comments')->nullable();
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
        Schema::drop('spars_info_system_22');
    }
}
