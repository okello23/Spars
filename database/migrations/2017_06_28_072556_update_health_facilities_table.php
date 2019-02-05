<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHealthFacilitiesTable extends Migration
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
            $table->string('in_charge_fname');
            $table->string('in_charge_lname');
            $table->string('in_charge_contact');

            $table->string('lss_fname');
            $table->string('lss_lname');
            $table->string('lss_contact');      
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

            $table->dropColumn('in_charge_fname');  
            $table->dropColumn('in_charge_lname');  
            $table->dropColumn('in_charge_contact');
            $table->dropColumn('lss_fname');  
            $table->dropColumn('lss_lname');  
            $table->dropColumn('lss_contact');   

        });     
    }

}