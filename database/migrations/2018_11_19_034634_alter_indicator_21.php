<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIndicator21 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('equipment_21', function($table)
        { 

            $table->integer('sub_indicator_212cb')->default(8000);
            $table->integer('sub_indicator_212cc')->nullable();
            $table->integer('sub_indicator_212cd')->nullable();
            $table->integer('sub_indicator_212ce')->nullable();
            $table->integer('sub_indicator_212cf')->nullable();
            $table->integer('sub_indicator_212cg')->nullable();
            $table->integer('sub_indicator_212ch')->nullable();
            $table->integer('sub_indicator_212ci')->nullable();

            $table->integer('sub_indicator_212db')->default(640);
            $table->integer('sub_indicator_212dc')->nullable();
            $table->integer('sub_indicator_212dd')->nullable();
            $table->integer('sub_indicator_212de')->nullable();
            $table->integer('sub_indicator_212df')->nullable();
            $table->integer('sub_indicator_212dg')->nullable();
            $table->integer('sub_indicator_212dh')->nullable();
            $table->integer('sub_indicator_212di')->nullable();
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
        Schema::table('equipment_21', function(Blueprint $table)
        {   

            $table->dropColumn('sub_indicator_212cb');   
            $table->dropColumn('sub_indicator_212cc');   
            $table->dropColumn('sub_indicator_212cd');   
            $table->dropColumn('sub_indicator_212ce');   
            $table->dropColumn('sub_indicator_212cf');   
            $table->dropColumn('sub_indicator_212cg');   
            $table->dropColumn('sub_indicator_212ch');   
            $table->dropColumn('sub_indicator_212ci'); 

            $table->dropColumn('sub_indicator_212db');   
            $table->dropColumn('sub_indicator_212dc');   
            $table->dropColumn('sub_indicator_212dd');   
            $table->dropColumn('sub_indicator_212de');   
            $table->dropColumn('sub_indicator_212df');   
            $table->dropColumn('sub_indicator_212dg');   
            $table->dropColumn('sub_indicator_212dh');   
            $table->dropColumn('sub_indicator_212di');   

        });     
    }

}