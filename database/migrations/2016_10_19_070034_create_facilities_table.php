<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');

            $table->integer('ownership_id')->unsigned();            
            $table->foreign('ownership_id')->references('id')->on('ownership');     

            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->integer('subdistrict_id')->unsigned();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');

            $table->integer('responsible_lss_id')->unsigned();
            $table->foreign('responsible_lss_id')->references('id')->on('persons'); 

            $table->integer('in_charge_id')->unsigned();
            $table->foreign('in_charge_id')->references('id')->on('persons');        
                            
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
        //
        Schema::drop('facilities');
    }
}
