<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparsSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('spars_supervisors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->string('form_id');
            $table->date('visit_date');
            $table->integer('person_id')->unsigned();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->foreign('health_facility_id')->references('id')->on('health_facilities');
            $table->foreign('person_id')->references('id')->on('persons');
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
        Schema::drop('spars_supervisors');
    }
}
