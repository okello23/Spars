<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHealthFacilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    Schema::table('health_facilities', function($table)
        { 

            $table->integer('is_control_facility')->default(0);             

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
        Schema::table('health_facilities', function(Blueprint $table)
        {   

            $table->dropColumn('is_control_facility'); 

        });     
    }
}
