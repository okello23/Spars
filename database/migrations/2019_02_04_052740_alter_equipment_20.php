<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEquipment20 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       Schema::table('equipment_20', function($table)
        { 

            $table->integer('cd4_machine')->nullable();             
            $table->integer('chemistry_machine')->nullable();             
            $table->integer('heamatology_machine')->nullable();             

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
        Schema::table('equipment_20', function(Blueprint $table)
        {   

            $table->dropColumn('cd4_machine'); 
            $table->dropColumn('chemistry_machine'); 
            $table->dropColumn('heamatology_machine'); 

        });     
    }
}
