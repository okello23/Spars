<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipment20Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       Schema::create('equipment_20', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');
            $table->integer('sub_indicator_20a1');
            $table->integer('sub_indicator_20a2');
            $table->integer('sub_indicator_20a3');
            $table->integer('sub_indicator_20a4');
            $table->integer('sub_indicator_20a5');
            $table->integer('sub_indicator_20a6');
            $table->integer('sub_indicator_20b1');
            $table->integer('sub_indicator_20b2');
            $table->integer('sub_indicator_20b3');
            $table->integer('sub_indicator_20b4');
            $table->integer('sub_indicator_20b5');
            $table->integer('sub_indicator_20b6');
            $table->integer('sub_indicator_20c1');
            $table->integer('sub_indicator_20c2');
            $table->integer('sub_indicator_20c3');
            $table->integer('sub_indicator_20c4');
            $table->integer('sub_indicator_20c5');
            $table->integer('sub_indicator_20c6');
            $table->integer('sub_indicator_20d1');
            $table->integer('sub_indicator_20d2');
            $table->integer('sub_indicator_20d3');
            $table->integer('sub_indicator_20d4');
            $table->integer('sub_indicator_20d5');
            $table->integer('sub_indicator_20d6');
            $table->integer('sub_indicator_20e1');
            $table->integer('sub_indicator_20e2');
            $table->integer('sub_indicator_20e3');
            $table->integer('sub_indicator_20e4');
            $table->integer('sub_indicator_20e5');
            $table->integer('sub_indicator_20e6');
            $table->integer('sub_indicator_20f1');
            $table->integer('sub_indicator_20f2');
            $table->integer('sub_indicator_20f3');
            $table->integer('sub_indicator_20f4');
            $table->integer('sub_indicator_20f5');
            $table->integer('sub_indicator_20f6');
            $table->text('indicator_20_comments')->nullable();
            $table->double('score', 3, 2);
            $table->date('visit_date');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->foreign('health_facility_id')->references('id')->on('health_facilities');
            $table->foreign('survey_summary_id')->references('id')->on('survey_summary');
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
        Schema::drop('equipment_20');
    }
}
