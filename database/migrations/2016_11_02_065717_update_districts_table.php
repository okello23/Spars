<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Schema::table('districts', function($table)
        {       
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions');       
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('districts', function(Blueprint $table)
        {   
            $table->dropForeign('regions_id_foreign');                           
            $table->dropColumn('region_id');          
        });     
    }

}
