<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageManagement12Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('spars_storage_management_12', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');            
            $table->integer('sub_indicator_12a_main_store');
            $table->integer('sub_indicator_12b_main_store');
            $table->integer('sub_indicator_12c_main_store');
            $table->integer('sub_indicator_12d_main_store');
            $table->integer('sub_indicator_12e_main_store');
            $table->integer('sub_indicator_12a_lab_store');
            $table->integer('sub_indicator_12b_lab_store');
            $table->integer('sub_indicator_12c_lab_store');
            $table->integer('sub_indicator_12d_lab_store');
            $table->integer('sub_indicator_12e_lab_store');            
            $table->double('score', 3, 2);
            $table->text('indicator_12_comments')->nullable();
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
        Schema::drop('spars_storage_management_12');
    }
}
