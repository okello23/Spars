<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipment21Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       Schema::create('equipment_21', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_facility_id')->unsigned();
            $table->integer('survey_summary_id')->unsigned();
            $table->string('form_id');
            $table->integer('sub_indicator_211ab')->default(60);
            $table->integer('sub_indicator_211ac')->nullable();
            $table->integer('sub_indicator_211ad')->nullable();
            $table->integer('sub_indicator_211ae')->nullable();
            $table->integer('sub_indicator_211af')->nullable();
            $table->integer('sub_indicator_211ag')->nullable();
            $table->integer('sub_indicator_211ah')->nullable();
            $table->integer('sub_indicator_211ai')->nullable();

            $table->integer('sub_indicator_211bb')->default(200);
            $table->integer('sub_indicator_211bc')->nullable();
            $table->integer('sub_indicator_211bd')->nullable();
            $table->integer('sub_indicator_211be')->nullable();
            $table->integer('sub_indicator_211bf')->nullable();
            $table->integer('sub_indicator_211bg')->nullable();
            $table->integer('sub_indicator_211bh')->nullable();
            $table->integer('sub_indicator_211bi')->nullable();

            $table->integer('sub_indicator_211cb')->default(70);
            $table->integer('sub_indicator_211cc')->nullable();
            $table->integer('sub_indicator_211cd')->nullable();
            $table->integer('sub_indicator_211ce')->nullable();
            $table->integer('sub_indicator_211cf')->nullable();
            $table->integer('sub_indicator_211cg')->nullable();
            $table->integer('sub_indicator_211ch')->nullable();
            $table->integer('sub_indicator_211ci')->nullable();

            $table->integer('sub_indicator_211db')->default(60);
            $table->integer('sub_indicator_211dc')->nullable();
            $table->integer('sub_indicator_211dd')->nullable();
            $table->integer('sub_indicator_211de')->nullable();
            $table->integer('sub_indicator_211df')->nullable();
            $table->integer('sub_indicator_211dg')->nullable();
            $table->integer('sub_indicator_211dh')->nullable();
            $table->integer('sub_indicator_211di')->nullable();

            $table->integer('sub_indicator_211eb')->default(20);
            $table->integer('sub_indicator_211ec')->nullable();
            $table->integer('sub_indicator_211ed')->nullable();
            $table->integer('sub_indicator_211ee')->nullable();
            $table->integer('sub_indicator_211ef')->nullable();
            $table->integer('sub_indicator_211eg')->nullable();
            $table->integer('sub_indicator_211eh')->nullable();
            $table->integer('sub_indicator_211ei')->nullable();


            $table->integer('sub_indicator_212ab')->default(520);
            $table->integer('sub_indicator_212ac')->nullable();
            $table->integer('sub_indicator_212ad')->nullable();
            $table->integer('sub_indicator_212ae')->nullable();
            $table->integer('sub_indicator_212af')->nullable();
            $table->integer('sub_indicator_212ag')->nullable();
            $table->integer('sub_indicator_212ah')->nullable();
            $table->integer('sub_indicator_212ai')->nullable();

            $table->integer('sub_indicator_212bb')->default(450);
            $table->integer('sub_indicator_212bc')->nullable();
            $table->integer('sub_indicator_212bd')->nullable();
            $table->integer('sub_indicator_212be')->nullable();
            $table->integer('sub_indicator_212bf')->nullable();
            $table->integer('sub_indicator_212bg')->nullable();
            $table->integer('sub_indicator_212bh')->nullable();
            $table->integer('sub_indicator_212bi')->nullable();


            $table->integer('sub_indicator_213ab')->default(4800);
            $table->integer('sub_indicator_213ac')->nullable();
            $table->integer('sub_indicator_213ad')->nullable();
            $table->integer('sub_indicator_213ae')->nullable();
            $table->integer('sub_indicator_213af')->nullable();
            $table->integer('sub_indicator_213ag')->nullable();
            $table->integer('sub_indicator_213ah')->nullable();
            $table->integer('sub_indicator_213ai')->nullable();

            $table->integer('sub_indicator_213bb')->default(300);
            $table->integer('sub_indicator_213bc')->nullable();
            $table->integer('sub_indicator_213bd')->nullable();
            $table->integer('sub_indicator_213be')->nullable();
            $table->integer('sub_indicator_213bf')->nullable();
            $table->integer('sub_indicator_213bg')->nullable();
            $table->integer('sub_indicator_213bh')->nullable();
            $table->integer('sub_indicator_213bi')->nullable();

            $table->integer('sub_indicator_213cb')->default(600);
            $table->integer('sub_indicator_213cc')->nullable();
            $table->integer('sub_indicator_213cd')->nullable();
            $table->integer('sub_indicator_213ce')->nullable();
            $table->integer('sub_indicator_213cf')->nullable();
            $table->integer('sub_indicator_213cg')->nullable();
            $table->integer('sub_indicator_213ch')->nullable();
            $table->integer('sub_indicator_213ci')->nullable();

            $table->integer('sub_indicator_213db')->default(480);
            $table->integer('sub_indicator_213dc')->nullable();
            $table->integer('sub_indicator_213dd')->nullable();
            $table->integer('sub_indicator_213de')->nullable();
            $table->integer('sub_indicator_213df')->nullable();
            $table->integer('sub_indicator_213dg')->nullable();
            $table->integer('sub_indicator_213dh')->nullable();
            $table->integer('sub_indicator_213di')->nullable();

            $table->integer('sub_indicator_213eb')->default(480);
            $table->integer('sub_indicator_213ec')->nullable();
            $table->integer('sub_indicator_213ed')->nullable();
            $table->integer('sub_indicator_213ee')->nullable();
            $table->integer('sub_indicator_213ef')->nullable();
            $table->integer('sub_indicator_213eg')->nullable();
            $table->integer('sub_indicator_213eh')->nullable();
            $table->integer('sub_indicator_213ei')->nullable();

            $table->integer('sub_indicator_213fb')->default(240);
            $table->integer('sub_indicator_213fc')->nullable();
            $table->integer('sub_indicator_213fd')->nullable();
            $table->integer('sub_indicator_213fe')->nullable();
            $table->integer('sub_indicator_213ff')->nullable();
            $table->integer('sub_indicator_213fg')->nullable();
            $table->integer('sub_indicator_213fh')->nullable();
            $table->integer('sub_indicator_213fi')->nullable();

            $table->integer('sub_indicator_213gb')->default(240);
            $table->integer('sub_indicator_213gc')->nullable();
            $table->integer('sub_indicator_213gd')->nullable();
            $table->integer('sub_indicator_213ge')->nullable();
            $table->integer('sub_indicator_213gf')->nullable();
            $table->integer('sub_indicator_213gg')->nullable();
            $table->integer('sub_indicator_213gh')->nullable();
            $table->integer('sub_indicator_213gi')->nullable();

            $table->integer('sub_indicator_213hb')->default(640);
            $table->integer('sub_indicator_213hc')->nullable();
            $table->integer('sub_indicator_213hd')->nullable();
            $table->integer('sub_indicator_213he')->nullable();
            $table->integer('sub_indicator_213hf')->nullable();
            $table->integer('sub_indicator_213hg')->nullable();
            $table->integer('sub_indicator_213hh')->nullable();
            $table->integer('sub_indicator_213hi')->nullable();

            $table->integer('sub_indicator_213ib')->default(200);
            $table->integer('sub_indicator_213ic')->nullable();
            $table->integer('sub_indicator_213id')->nullable();
            $table->integer('sub_indicator_213ie')->nullable();
            $table->integer('sub_indicator_213if')->nullable();
            $table->integer('sub_indicator_213ig')->nullable();
            $table->integer('sub_indicator_213ih')->nullable();
            $table->integer('sub_indicator_213ii')->nullable();

            $table->integer('sub_indicator_213jb')->default(480);
            $table->integer('sub_indicator_213jc')->nullable();
            $table->integer('sub_indicator_213jd')->nullable();
            $table->integer('sub_indicator_213je')->nullable();
            $table->integer('sub_indicator_213jf')->nullable();
            $table->integer('sub_indicator_213jg')->nullable();
            $table->integer('sub_indicator_213jh')->nullable();
            $table->integer('sub_indicator_213ji')->nullable();


            $table->text('indicator_21_comments')->nullable();

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
        Schema::drop('equipment_21');
    }
}
