<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVisitSummaryTable extends Migration
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

            $table->string('form_id');
            $table->integer('visit_number');
            $table->string('created_by')->nullable();            
            $table->string('updated_by')->nullable();             

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

            $table->dropColumn('form_id'); 
            $table->dropColumn('visit_number'); 
            $table->dropColumn('created_by'); 
            $table->dropColumn('updated_by');   

        });     
    }

}
