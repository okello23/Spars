<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabInfoSystem25Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spars_info_system_25', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');

            $table->date('sub_indicator_25aa');
            $table->integer('sub_indicator_25ab')->nullable();
            $table->integer('sub_indicator_25ac')->nullable();  

            $table->integer('sub_indicator_25ba1')->nullable();
            $table->integer('sub_indicator_25ba2')->nullable();
            $table->integer('sub_indicator_25ba3')->nullable();  
            $table->integer('sub_indicator_25ba4')->nullable();
            $table->integer('sub_indicator_25ba5')->nullable();
            $table->integer('sub_indicator_25ba6')->nullable();  
            $table->integer('sub_indicator_25ba7')->nullable();
            $table->integer('sub_indicator_25ba8')->nullable();

            $table->integer('sub_indicator_25bb1')->nullable();
            $table->integer('sub_indicator_25bb2')->nullable();
            $table->integer('sub_indicator_25bb3')->nullable();  
            $table->integer('sub_indicator_25bb4')->nullable();
            $table->integer('sub_indicator_25bb5')->nullable();
            $table->integer('sub_indicator_25bb6')->nullable();  
            $table->integer('sub_indicator_25bb7')->nullable();
            $table->integer('sub_indicator_25bb8')->nullable();

            $table->integer('sub_indicator_25bc1')->nullable();
            $table->integer('sub_indicator_25bc2')->nullable();
            $table->integer('sub_indicator_25bc3')->nullable();  
            $table->integer('sub_indicator_25bc4')->nullable();
            $table->integer('sub_indicator_25bc5')->nullable();
            $table->integer('sub_indicator_25bc6')->nullable();  
            $table->integer('sub_indicator_25bc7')->nullable();
            $table->integer('sub_indicator_25bc8')->nullable();


            $table->string('sub_indicator_cd4item')->nullable();
            $table->integer('sub_indicator_25bd1')->nullable();
            $table->integer('sub_indicator_25bd2')->nullable();
            $table->integer('sub_indicator_25bd3')->nullable();  
            $table->integer('sub_indicator_25bd4')->nullable();
            $table->integer('sub_indicator_25bd5')->nullable();
            $table->integer('sub_indicator_25bd6')->nullable();  
            $table->integer('sub_indicator_25bd7')->nullable();
            $table->integer('sub_indicator_25bd8')->nullable();
            
            $table->integer('sub_indicator_25be1')->nullable();
            $table->integer('sub_indicator_25be2')->nullable();
            $table->integer('sub_indicator_25be3')->nullable();  
            $table->integer('sub_indicator_25be4')->nullable();
            $table->integer('sub_indicator_25be5')->nullable();
            $table->integer('sub_indicator_25be6')->nullable();  
            $table->integer('sub_indicator_25be7')->nullable();
            $table->integer('sub_indicator_25be8')->nullable();

            $table->integer('sub_indicator_25bf1')->nullable();
            $table->integer('sub_indicator_25bf2')->nullable();
            $table->integer('sub_indicator_25bf3')->nullable();  
            $table->integer('sub_indicator_25bf4')->nullable();
            $table->integer('sub_indicator_25bf5')->nullable();
            $table->integer('sub_indicator_25bf6')->nullable();  
            $table->integer('sub_indicator_25bf7')->nullable();
            $table->integer('sub_indicator_25bf8')->nullable();

            $table->integer('sub_indicator_25bg1')->nullable();
            $table->integer('sub_indicator_25bg2')->nullable();
            $table->integer('sub_indicator_25bg3')->nullable();  
            $table->integer('sub_indicator_25bg4')->nullable();
            $table->integer('sub_indicator_25bg5')->nullable();
            $table->integer('sub_indicator_25bg6')->nullable();  
            $table->integer('sub_indicator_25bg7')->nullable();
            $table->integer('sub_indicator_25bg8')->nullable();


            $table->integer('sub_indicator_25ca1')->nullable();
            $table->integer('sub_indicator_25ca2')->nullable();
            $table->integer('sub_indicator_25ca3')->nullable();
            $table->integer('sub_indicator_25ca4')->nullable();

            $table->integer('sub_indicator_25cb1')->nullable();
            $table->integer('sub_indicator_25cb2')->nullable();  
            $table->integer('sub_indicator_25cb3')->nullable();
            $table->integer('sub_indicator_25cb4')->nullable();

            $table->integer('sub_indicator_25cc1')->nullable();
            $table->integer('sub_indicator_25cc2')->nullable();  
            $table->integer('sub_indicator_25cc3')->nullable();
            $table->integer('sub_indicator_25cc4')->nullable();

            $table->integer('sub_indicator_25cd1')->nullable();
            $table->integer('sub_indicator_25cd2')->nullable();  
            $table->integer('sub_indicator_25cd3')->nullable();
            $table->integer('sub_indicator_25cd4')->nullable();

            $table->integer('sub_indicator_25ce1')->nullable();
            $table->integer('sub_indicator_25ce2')->nullable();  
            $table->integer('sub_indicator_25ce3')->nullable();
            $table->integer('sub_indicator_25ce4')->nullable();

            $table->integer('sub_indicator_25cf1')->nullable();
            $table->integer('sub_indicator_25cf2')->nullable();  
            $table->integer('sub_indicator_25cf3')->nullable();
            $table->integer('sub_indicator_25cf4')->nullable();


            $table->text('indicator_25_comments')->nullable();
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
        Schema::drop('spars_info_system_25');
    }
}
