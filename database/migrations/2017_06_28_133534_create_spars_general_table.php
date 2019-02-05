<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparsGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('spars_general', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->string('form_id');
            $table->boolean('d1');
            $table->boolean('d2a');
            $table->boolean('d2b');
            $table->boolean('d2c');
            $table->boolean('d2d');
            $table->boolean('d2e');
            $table->boolean('d2f');
            $table->text('d2comment')->nullable();
            $table->boolean('d3');  
            $table->text('d3comment')->nullable();          
            $table->boolean('d4a');
            $table->boolean('d4b');
            $table->boolean('d4c');
            $table->boolean('d4d');
            $table->boolean('d4e');
            $table->boolean('d4f');
            $table->text('d4comment')->nullable();
            $table->text('d5')->nullable();
            $table->date('visit_date');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::drop('spars_general');
    }
}
