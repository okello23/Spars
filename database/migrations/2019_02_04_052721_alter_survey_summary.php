<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSurveySummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    Schema::table('survey_summary', function($table)
        { 

            $table->integer('form_version')->default(1);             

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
        Schema::table('survey_summary', function(Blueprint $table)
        {   

            $table->dropColumn('form_version'); 

        });     
    }
}
