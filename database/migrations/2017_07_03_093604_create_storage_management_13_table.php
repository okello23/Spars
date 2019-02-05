<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageManagement13Table extends Migration
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
        Schema::create('spars_storage_management_13', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');
            $table->integer('sub_indicator_13a_main_store');
            $table->integer('sub_indicator_13b_main_store');
            $table->integer('sub_indicator_13c_main_store');
            $table->integer('sub_indicator_13d_main_store');
            $table->integer('sub_indicator_13e_main_store');
            $table->integer('sub_indicator_13f_main_store');
            $table->integer('sub_indicator_13g_main_store');
            $table->integer('sub_indicator_13h_main_store');
            $table->integer('sub_indicator_13i_main_store');
            $table->integer('sub_indicator_13j_main_store');
            $table->integer('sub_indicator_13k_main_store');
            $table->integer('sub_indicator_13l_main_store');
            $table->integer('sub_indicator_13a_lab_store');
            $table->integer('sub_indicator_13b_lab_store');
            $table->integer('sub_indicator_13c_lab_store');
            $table->integer('sub_indicator_13d_lab_store');
            $table->integer('sub_indicator_13e_lab_store');
            $table->integer('sub_indicator_13f_lab_store');
            $table->integer('sub_indicator_13g_lab_store');
            $table->integer('sub_indicator_13h_lab_store');
            $table->integer('sub_indicator_13i_lab_store');
            $table->integer('sub_indicator_13j_lab_store');
            $table->integer('sub_indicator_13k_lab_store');
            $table->integer('sub_indicator_13l_lab_store');        
            $table->double('score', 3, 2);
            $table->text('indicator_13_comments')->nullable();
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
        Schema::drop('spars_storage_management_13');
    }
}
