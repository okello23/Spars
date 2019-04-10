<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Collection;

use App\Http\Requests;

use App\Models\District;

use App\Models\Cadre;

use App\Models\HealthFacility;

use App\Models\Personnel;

use App\Models\SurveySummary;

use App\Models\ScoreSummary;

use App\VuSummaryScore;

use Session;

use DateTime;

use DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $summary_list =[];
        $visit1 =[];
        $visit3 =[];
        $visit5 =[];


        $visit1_indicator1 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator2 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator2_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator3 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator3_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator4 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator4_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator5 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator5_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator6 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator6_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator7 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator7_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator8 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator8_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator9 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator10 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator10_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator11 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator11_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator12 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator12_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator13 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator13_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator14 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator14_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator15 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator15_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator16 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator17 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator17_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator18 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator18_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator19 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator19_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator20 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator21 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator21_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator22 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator22_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator23 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator23_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator24 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator24_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator25 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator26 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator26_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit1_indicator27 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator27_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $stock_management_1 = ($visit1_indicator1->avg('indicator1_score')+$visit1_indicator2->avg('indicator2_score')+$visit1_indicator3->avg('indicator3_score')+$visit1_indicator4->avg('indicator4_score')+$visit1_indicator5->avg('indicator5_score')+$visit1_indicator6->avg('indicator6_score')+$visit1_indicator7->avg('indicator7_score')+$visit1_indicator8->avg('indicator8_score')+$visit1_indicator9->avg('indicator9_score'))/9*5;

        $storage_management_1 = ($visit1_indicator10->avg('indicator10_score')+$visit1_indicator11->avg('indicator11_score')+$visit1_indicator12->avg('indicator12_score')+$visit1_indicator13->avg('indicator13_score')+$visit1_indicator14->avg('indicator14_score'))/5*5;

        $ordering_1 = ($visit1_indicator15->avg('indicator15_score')+$visit1_indicator16->avg('indicator16_score')+$visit1_indicator17->avg('indicator17_score'))/3*5;

        $equipment_1 = ($visit1_indicator18->avg('indicator18_score')+$visit1_indicator19->avg('indicator19_score')+$visit1_indicator20->avg('indicator20_score')+$visit1_indicator21->avg('indicator21_score'))/4*5;

        $info_system_1 = ($visit1_indicator22->avg('indicator22_score')+$visit1_indicator23->avg('indicator23_score')+$visit1_indicator24->avg('indicator24_score')+$visit1_indicator25->avg('indicator25_score')+$visit1_indicator26->avg('indicator26_score')+$visit1_indicator27->avg('indicator27_score'))/6*5;


        $visit1 = [ $stock_management_1, $storage_management_1, $ordering_1, $equipment_1, $info_system_1 ];


        $visit3_indicator1 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator2 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator2_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator3 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator3_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator4 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator4_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator5 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator5_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator6 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator6_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator7 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator7_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator8 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator8_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator9 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator10 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator10_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator11 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator11_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator12 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator12_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator13 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator13_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator14 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator14_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator15 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator15_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator16 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator17 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator17_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator18 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator18_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator19 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator19_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator20 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator21 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator21_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator22 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator22_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator23 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator23_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator24 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator24_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator25 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator26 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator26_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit3_indicator27 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator27_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
                ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $stock_management_3 = ($visit3_indicator1->avg('indicator1_score')+$visit3_indicator2->avg('indicator2_score')+$visit3_indicator3->avg('indicator3_score')+$visit3_indicator4->avg('indicator4_score')+$visit3_indicator5->avg('indicator5_score')+$visit3_indicator6->avg('indicator6_score')+$visit3_indicator7->avg('indicator7_score')+$visit3_indicator8->avg('indicator8_score')+$visit3_indicator9->avg('indicator9_score'))/9*5;

        $storage_management_3 = ($visit3_indicator10->avg('indicator10_score')+$visit3_indicator11->avg('indicator11_score')+$visit3_indicator12->avg('indicator12_score')+$visit3_indicator13->avg('indicator13_score')+$visit3_indicator14->avg('indicator14_score'))/5*5;

        $ordering_3 = ($visit3_indicator15->avg('indicator15_score')+$visit3_indicator16->avg('indicator16_score')+$visit3_indicator17->avg('indicator17_score'))/3*5;

        $equipment_3 = ($visit3_indicator18->avg('indicator18_score')+$visit3_indicator19->avg('indicator19_score')+$visit3_indicator20->avg('indicator20_score')+$visit3_indicator21->avg('indicator21_score'))/4*5;

        $info_system_3 = ($visit3_indicator22->avg('indicator22_score')+$visit3_indicator23->avg('indicator23_score')+$visit3_indicator24->avg('indicator24_score')+$visit3_indicator25->avg('indicator25_score')+$visit3_indicator26->avg('indicator26_score')+$visit3_indicator27->avg('indicator27_score'))/6*5;


        $visit3 = [ $stock_management_3, $storage_management_3, $ordering_3, $equipment_3, $info_system_3 ];


        $visit5_indicator1 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator2 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator2_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator3 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator3_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator4 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator4_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator5 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator5_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator6 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator6_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator7 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator7_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator8 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator8_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator9 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator10 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator10_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator11 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator11_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator12 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator12_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator13 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator13_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator14 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator14_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator15 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator15_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator16 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator17 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator17_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator18 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator18_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator19 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator19_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator20 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator21 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator21_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator22 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator22_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator23 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator23_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator24 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator24_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator25 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator26 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator26_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        $visit5_indicator27 = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator27_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
                ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $stock_management_5 = ($visit5_indicator1->avg('indicator1_score')+$visit5_indicator2->avg('indicator2_score')+$visit5_indicator3->avg('indicator3_score')+$visit5_indicator4->avg('indicator4_score')+$visit5_indicator5->avg('indicator5_score')+$visit5_indicator6->avg('indicator6_score')+$visit5_indicator7->avg('indicator7_score')+$visit5_indicator8->avg('indicator8_score')+$visit5_indicator9->avg('indicator9_score'))/9*5;

        $storage_management_5 = ($visit5_indicator10->avg('indicator10_score')+$visit5_indicator11->avg('indicator11_score')+$visit5_indicator12->avg('indicator12_score')+$visit5_indicator13->avg('indicator13_score')+$visit5_indicator14->avg('indicator14_score'))/5*5;

        $ordering_5 = ($visit5_indicator15->avg('indicator15_score')+$visit5_indicator16->avg('indicator16_score')+$visit5_indicator17->avg('indicator17_score'))/3*5;

        $equipment_5 = ($visit5_indicator18->avg('indicator18_score')+$visit5_indicator19->avg('indicator19_score')+$visit5_indicator20->avg('indicator20_score')+$visit5_indicator21->avg('indicator21_score'))/4*5;

        $info_system_5 = ($visit5_indicator22->avg('indicator22_score')+$visit5_indicator23->avg('indicator23_score')+$visit5_indicator24->avg('indicator24_score')+$visit5_indicator25->avg('indicator25_score')+$visit5_indicator26->avg('indicator26_score')+$visit5_indicator27->avg('indicator27_score'))/6*5;


        $visit5 = [ $stock_management_5, $storage_management_5, $ordering_5, $equipment_5, $info_system_5 ];



        $chartjs = app()->chartjs
                ->name('SPARS')
                ->type('radar')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Stock Management', 'Storage Management', 'Laboratory Equipment', 'Ordering, Receipt and Recording', 'Laboratory Information Systems'])
                ->datasets([
                    [
                        "label" => "Visit 1",
                        'backgroundColor' => "rgba(255, 170, 0, 0.31)",
                        'borderColor' => "rgba(255, 170, 0, 0.7)",
                        "pointBorderColor" => "rgba(255, 170, 0, 0.7)",
                        "pointBackgroundColor" => "rgba(255, 170, 0, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $visit1,
                    ],
                    [
                        "label" => "Visit 3",
                        'backgroundColor' => "rgba(14, 140, 58, 0.31)",
                        'borderColor' => "rgba(14, 140, 58, 0.7)",
                        "pointBorderColor" => "rgba(14, 140, 58, 0.7)",
                        "pointBackgroundColor" => "rgba(14, 140, 58, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $visit3,
                    ],
                    [
                        "label" => "Visit 5",
                        'backgroundColor' => "rgba(184, 19, 36, 0.31)",
                        'borderColor' => "rgba(184, 19, 36, 0.7)",
                        "pointBorderColor" => "rgba(184, 19, 36, 0.7)",
                        "pointBackgroundColor" => "rgba(184, 19, 36, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $visit5,
                    ]
                ])
                ->options([

                        "scale" => [

                                        "ticks" => [        
                                                        "max" => 5,
                                                        "min" => 0,
                                                        "stepSize" => 1                                    
                                                    ]
                                    ]

                ]);

        return view('home', compact('chartjs'));

    }

    public function facilityPerformance()
    {


        $summary_list =[];

        $baselines = DB::table('spars_summary_scores')
            ->select('spars_summary_scores.*', 'health_facilities.facility', 'health_facilities.level', DB::raw('MIN(spars_summary_scores.visit_date) as min_visit_date'))
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')        
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->where('survey_summary.step','=', 6)          
            ->where('health_facilities.is_control_facility','=', 0)                                      
            ->groupBy('spars_summary_scores.health_facility_id')
            ->get();


        foreach ($baselines as $row ) {

                $current = DB::table('spars_summary_scores')
                    ->select('spars_summary_scores.*', 'health_facilities.facility', 'health_facilities.level')
                    ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id') 
                    ->where('spars_summary_scores.health_facility_id','=',$row->health_facility_id)
                    ->orderBy('spars_summary_scores.visit_date','desc')
                    ->first();


                //stock management score
                    $stock_na_baseline = 0;
                    $stock_baseline = 0;
                    $stock_na_current = 0;
                    $stock_current = 0;

                    $row->indicator1_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator1_score);
                    $row->indicator2_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator2_score);
                    $row->indicator3_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator3_score);
                    $row->indicator4_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator4_score);
                    $row->indicator5_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator5_score);
                    $row->indicator6_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator6_score);
                    $row->indicator7_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator7_score);
                    $row->indicator8_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator8_score);
                    $row->indicator9_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator9_score);

                    $current->indicator1_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator1_score);
                    $current->indicator2_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator2_score);
                    $current->indicator3_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator3_score);
                    $current->indicator4_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator4_score);
                    $current->indicator5_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator5_score);
                    $current->indicator6_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator6_score);
                    $current->indicator7_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator7_score);
                    $current->indicator8_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator8_score);
                    $current->indicator9_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator9_score);

                    $stock_baseline_total = ($stock_baseline/ (9-$stock_na_baseline))*5;
                    $stock_current_total = ($stock_current/ (9-$stock_na_current))*5;
                

                //storage management score
                    $storage_na_baseline = 0;
                    $storage_baseline = 0;
                    $storage_na_current = 0;
                    $storage_current = 0;

                    $row->indicator10_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator10_score);
                    $row->indicator11_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator11_score);
                    $row->indicator12_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator12_score);
                    $row->indicator13_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator13_score);
                    $row->indicator14_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator14_score);

                    $current->indicator10_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator10_score);
                    $current->indicator11_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator11_score);
                    $current->indicator12_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator12_score);
                    $current->indicator13_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator13_score);
                    $current->indicator14_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator14_score);


                    $storage_baseline_total = ($storage_baseline/(5-$storage_na_baseline))*5;
                    $storage_current_total = ($storage_current/(5-$storage_na_current))*5;

                //ordering score
                    $ordering_na_baseline = 0;
                    $ordering_baseline = 0;
                    $ordering_na_current = 0;
                    $ordering_current = 0;

                    $row->indicator15_score == -1?($ordering_na_baseline=$ordering_na_baseline+1) : ($ordering_baseline=$ordering_baseline+$row->indicator15_score);
                    $row->indicator16_score == -1?($ordering_na_baseline=$ordering_na_baseline+1) : ($ordering_baseline=$ordering_baseline+$row->indicator16_score);
                    $row->indicator17_score == -1?($ordering_na_baseline=$ordering_na_baseline+1) : ($ordering_baseline=$ordering_baseline+$row->indicator17_score);

                    $current->indicator15_score == -1?($ordering_na_current=$ordering_na_current+1) : ($ordering_current=$ordering_current+$current->indicator15_score);
                    $current->indicator16_score == -1?($ordering_na_current=$ordering_na_current+1) : ($ordering_current=$ordering_current+$current->indicator16_score);
                    $current->indicator17_score == -1?($ordering_na_current=$ordering_na_current+1) : ($ordering_current=$ordering_current+$current->indicator17_score);

                    $ordering_baseline_total = ($ordering_baseline/(3-$ordering_na_baseline))*5;
                    $ordering_current_total = ($ordering_current/(3-$ordering_na_current))*5;
                

                //equipment score
                    $equipment_na_baseline = 0;
                    $equipment_baseline = 0;
                    $equipment_na_current = 0;
                    $equipment_current = 0;

                    $row->indicator18_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator18_score);
                    $row->indicator19_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator19_score);
                    $row->indicator20_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator20_score);
                    $row->indicator21_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator21_score);

                    $current->indicator18_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator18_score);
                    $current->indicator19_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator19_score);
                    $current->indicator20_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator20_score);
                    $current->indicator21_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator21_score);


                    $equipment_baseline_total = ($equipment_baseline/(4-$equipment_na_baseline))*5;
                    $equipment_current_total = ($equipment_current/(4-$equipment_na_current))*5;
                

                //info management score
                    $info_na_baseline = 0;
                    $info_baseline = 0;
                    $info_na_current = 0;
                    $info_current = 0;

                    $row->indicator22_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator22_score);
                    $row->indicator23_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator23_score);
                    $row->indicator24_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator24_score);
                    $row->indicator25_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator25_score);
                    $row->indicator26_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator26_score);
                    $row->indicator27_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator27_score);

                    $current->indicator22_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator22_score);
                    $current->indicator23_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator23_score);
                    $current->indicator24_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator24_score);
                    $current->indicator25_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator25_score);
                    $current->indicator26_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator26_score);
                    $current->indicator27_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator27_score);

                    $info_baseline_total = ($info_baseline/(6-$info_na_baseline))*5;
                    $info_current_total = ($info_current/(6-$info_na_current))*5;
                

                $item = [$row->facility. ' '.$row->level, 
                    
                            ($stock_baseline_total+$storage_baseline_total+$ordering_baseline_total+$equipment_baseline_total+$info_baseline_total), 
                            ($stock_current_total+$storage_current_total+$ordering_current_total+$equipment_current_total+$info_current_total)

                    ];

                array_push($summary_list,$item);

        
        }

        
        return view('home.facility_performance')->with('summary_list',$summary_list);
    }

    public function leagueTable()
    {

        $summary_list = new COllection();


        $facility_summary_scores = new COllection();

        $baselines = DB::table('spars_summary_scores')
            ->select('spars_summary_scores.*', 'health_facilities.facility', 'health_facilities.level', 'health_facilities.district', DB::raw('MIN(spars_summary_scores.visit_date) as min_visit_date'))
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')        
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->where('survey_summary.step','=', 6)                               
            ->where('health_facilities.is_control_facility','=', 0)               
            ->groupBy('spars_summary_scores.health_facility_id')
            ->get();


        foreach ($baselines as $row ) {

                $current = DB::table('spars_summary_scores')
                    ->select('spars_summary_scores.*', 'health_facilities.facility', 'health_facilities.level')
                    ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id') 
                    ->where('spars_summary_scores.health_facility_id','=',$row->health_facility_id)
                    ->orderBy('spars_summary_scores.visit_date','desc')
                    ->first();


                //stock management score
                    $stock_na_baseline = 0;
                    $stock_baseline = 0;
                    $stock_na_current = 0;
                    $stock_current = 0;

                                    $row->indicator1_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator1_score);
                    $row->indicator2_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator2_score);
                    $row->indicator3_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator3_score);
                    $row->indicator4_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator4_score);
                    $row->indicator5_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator5_score);
                    $row->indicator6_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator6_score);
                    $row->indicator7_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator7_score);
                    $row->indicator8_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator8_score);
                    $row->indicator9_score == -1?($stock_na_baseline = $stock_na_baseline+1) : ($stock_baseline=$stock_baseline+$row->indicator9_score);

                    $current->indicator1_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator1_score);
                    $current->indicator2_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator2_score);
                    $current->indicator3_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator3_score);
                    $current->indicator4_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator4_score);
                    $current->indicator5_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator5_score);
                    $current->indicator6_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator6_score);
                    $current->indicator7_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator7_score);
                    $current->indicator8_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator8_score);
                    $current->indicator9_score == -1?($stock_na_current = $stock_na_current+1) : ($stock_current=$stock_current+$current->indicator9_score);

                    $stock_baseline_total = ($stock_baseline/ (9-$stock_na_baseline))*5;
                    $stock_current_total = ($stock_current/ (9-$stock_na_current))*5;
                

                //storage management score
                    $storage_na_baseline = 0;
                    $storage_baseline = 0;
                    $storage_na_current = 0;
                    $storage_current = 0;

                    $row->indicator10_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator10_score);
                    $row->indicator11_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator11_score);
                    $row->indicator12_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator12_score);
                    $row->indicator13_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator13_score);
                    $row->indicator14_score == -1?($storage_na_baseline = $storage_na_baseline+1) : ($storage_baseline=$storage_baseline+$row->indicator14_score);

                    $current->indicator10_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator10_score);
                    $current->indicator11_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator11_score);
                    $current->indicator12_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator12_score);
                    $current->indicator13_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator13_score);
                    $current->indicator14_score == -1?($storage_na_current = $storage_na_current+1) : ($storage_current=$storage_current+$current->indicator14_score);


                    $storage_baseline_total = ($storage_baseline/(5-$storage_na_baseline))*5;
                    $storage_current_total = ($storage_current/(5-$storage_na_current))*5;

                //ordering score
                    $ordering_na_baseline = 0;
                    $ordering_baseline = 0;
                    $ordering_na_current = 0;
                    $ordering_current = 0;

                    $row->indicator15_score == -1?($ordering_na_baseline=$ordering_na_baseline+1) : ($ordering_baseline=$ordering_baseline+$row->indicator15_score);
                    $row->indicator16_score == -1?($ordering_na_baseline=$ordering_na_baseline+1) : ($ordering_baseline=$ordering_baseline+$row->indicator16_score);
                    $row->indicator17_score == -1?($ordering_na_baseline=$ordering_na_baseline+1) : ($ordering_baseline=$ordering_baseline+$row->indicator17_score);

                    $current->indicator15_score == -1?($ordering_na_current=$ordering_na_current+1) : ($ordering_current=$ordering_current+$current->indicator15_score);
                    $current->indicator16_score == -1?($ordering_na_current=$ordering_na_current+1) : ($ordering_current=$ordering_current+$current->indicator16_score);
                    $current->indicator17_score == -1?($ordering_na_current=$ordering_na_current+1) : ($ordering_current=$ordering_current+$current->indicator17_score);

                    $ordering_baseline_total = ($ordering_baseline/(3-$ordering_na_baseline))*5;
                    $ordering_current_total = ($ordering_current/(3-$ordering_na_current))*5;
                

                //equipment score
                    $equipment_na_baseline = 0;
                    $equipment_baseline = 0;
                    $equipment_na_current = 0;
                    $equipment_current = 0;

                    $row->indicator18_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator18_score);
                    $row->indicator19_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator19_score);
                    $row->indicator20_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator20_score);
                    $row->indicator21_score == -1?($equipment_na_baseline = $equipment_na_baseline+1) : ($equipment_baseline=$equipment_baseline+$row->indicator21_score);

                    $current->indicator18_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator18_score);
                    $current->indicator19_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator19_score);
                    $current->indicator20_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator20_score);
                    $current->indicator21_score == -1?($equipment_na_current=$equipment_na_current+1) : ($equipment_current=$equipment_current+$current->indicator21_score);


                    $equipment_baseline_total = ($equipment_baseline/(4-$equipment_na_baseline))*5;
                    $equipment_current_total = ($equipment_current/(4-$equipment_na_current))*5;
                

                //info management score
                    $info_na_baseline = 0;
                    $info_baseline = 0;
                    $info_na_current = 0;
                    $info_current = 0;

                    $row->indicator22_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator22_score);
                    $row->indicator23_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator23_score);
                    $row->indicator24_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator24_score);
                    $row->indicator25_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator25_score);
                    $row->indicator26_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator26_score);
                    $row->indicator27_score == -1?($info_na_baseline=$info_na_baseline+1) : ($info_baseline=$info_baseline+$row->indicator27_score);

                    $current->indicator22_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator22_score);
                    $current->indicator23_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator23_score);
                    $current->indicator24_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator24_score);
                    $current->indicator25_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator25_score);
                    $current->indicator26_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator26_score);
                    $current->indicator27_score == -1?($info_na_current = $info_na_current+1) : ($info_current=$info_current+$current->indicator27_score);

                    $info_baseline_total = ($info_baseline/(6-$info_na_baseline))*5;
                    $info_current_total = ($info_current/(6-$info_na_current))*5;



                $item = collect([
                        
                            'district'=>$row->district, 
                            'baseline'=>($stock_baseline_total+$storage_baseline_total+$ordering_baseline_total+$equipment_baseline_total+$info_baseline_total), 
                            'current'=>($stock_current_total+$storage_current_total+$ordering_current_total+$equipment_current_total+$info_current_total)
                        
                        ]);

                $facility_summary_scores->push($item);


        }

        
        $list = $facility_summary_scores->groupBy('district');

        foreach ($list as $key => $item) {

            $collection = collect([ 
                                        'district'=>$key, 
                                        'baseline'=>$item->avg('baseline'), 
                                        'current'=>$item->avg('current'), 

                                    ]);


            $summary_list->push($collection);

        }

        $list = $summary_list->sortByDesc('baseline')->values();

        $a=0;
        for($i=0; $i < $list->count(); $i++ )
        {

            if( $i==0 )
            {
                $list[$i]->put('baseline_rank',1);
                $a=1;
            }
            else
            {

                if($list[$i]->get('baseline') == $list[$i-1]['baseline'])
                {

                    $list[$i]->put('baseline_rank',$a);

                }
                else
                {

                    $list[$i]->put('baseline_rank',$a+=1);

                }
            }

        }


        $list = $summary_list->sortByDesc('current')->values();

        $a=0;
        for($i=0; $i < $list->count(); $i++ )
        {

            if( $i==0 )
            {
                $list[$i]->put('current_rank',1);
                $a=1;
            }
            else
            {

                if($list[$i]->get('current') == $list[$i-1]['current'])
                {

                    $list[$i]->put('current_rank',$a);

                }
                else
                {

                    $list[$i]->put('current_rank',$a+=1);

                }
            }

        }
        

        return view('home.league_table')->with('list',$list->sortBy('district'));
    }



    public function itemAvailabilityChart()
    {

        //visit 1
        $visit_ones = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 2

        $visit_twos = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 2)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 3
        $visit_threes = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 4
        $visit_fours = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 4)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 5
        $visit_fives = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator1_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $chartjs = app()->chartjs
        ->name('lineChart')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Visit 1', 'Visit 2', 'Visit 3', 'Visit 4', 'Visit 5'])
        ->datasets([
            [
                "label" => "Item Availability",
                'backgroundColor' => "rgba(255, 255, 255, 0)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [round($visit_ones->avg('indicator1_score'),2), round($visit_twos->avg('indicator1_score'),2),round($visit_threes->avg('indicator1_score'),2),round($visit_fours->avg('indicator1_score'),2),round($visit_fives->avg('indicator1_score'),2)],
            ]
        ])
        ->options([]);

        $chartjs->optionsRaw("{
            legend: {
                display:false
                    },
            scales:{
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 0.2,
                        beginAtZero: true
                    }
                }]
            }
            }");

        return view('reports.charts.item_availability', compact('chartjs'));


    }



    public function orderRefillRateChart()
    {


        //visit 1
        $visit_ones = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 2

        $visit_twos = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 2)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 3
        $visit_threes = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 4
        $visit_fours = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 4)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 5
        $visit_fives = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator9_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $chartjs = app()->chartjs
        ->name('lineChart')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Visit 1', 'Visit 2', 'Visit 3', 'Visit 4', 'Visit 5'])
        ->datasets([
            [
                "label" => "Order refill rate",
                'backgroundColor' => "rgba(255, 255, 255, 0)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [round($visit_ones->avg('indicator9_score'),2), round($visit_twos->avg('indicator9_score'),2),round($visit_threes->avg('indicator9_score'),2),round($visit_fours->avg('indicator9_score'),2),round($visit_fives->avg('indicator9_score'),2)],
            ]
        ])
        ->options([]);

        $chartjs->optionsRaw("{
            legend: {
                display:false
                    },
            scales:{
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 0.2,
                        beginAtZero: true
                    }
                }]
            }
            }");
        
        return view('reports.charts.refill_rate', compact('chartjs'));


    }



    public function orderingChart()
    {


        //visit 1
        $visit_ones = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 2

        $visit_twos = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 2)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 3
        $visit_threes = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 4
        $visit_fours = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 4)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 5
        $visit_fives = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator16_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $chartjs = app()->chartjs
        ->name('lineChart')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Visit 1', 'Visit 2', 'Visit 3', 'Visit 4', 'Visit 5'])
        ->datasets([
            [
                "label" => "Adherence to Ordering",
                'backgroundColor' => "rgba(255, 255, 255, 0)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [round($visit_ones->avg('indicator16_score'),2), round($visit_twos->avg('indicator16_score'),2),round($visit_threes->avg('indicator16_score'),2),round($visit_fours->avg('indicator16_score'),2),round($visit_fives->avg('indicator16_score'),2)],
            ]
        ])
        ->options([]);

        $chartjs->optionsRaw("{
            legend: {
                display:false
                    },
            scales:{
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 0.2,
                        beginAtZero: true
                    }
                }]
            }
            }");
        
        
        return view('reports.charts.ordering', compact('chartjs'));


    }


    public function equipmentFunctionalityChart()
    {

        //visit 1
        $visit_ones = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 2

        $visit_twos = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 2)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 3
        $visit_threes = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 4
        $visit_fours = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 4)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 5
        $visit_fives = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator20_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Visit 1', 'Visit 2', 'Visit 3', 'Visit 4', 'Visit 5'])
        ->datasets([
            [
                "label" => "Equipment functionality",
                'backgroundColor' => "rgba(255, 255, 255, 0)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [round($visit_ones->avg('indicator1_score'),2), round($visit_twos->avg('indicator1_score'),2),round($visit_threes->avg('indicator1_score'),2),round($visit_fours->avg('indicator20_score'),2),round($visit_fives->avg('indicator1_score'),2)],
            ]
        ])
        ->options([]);

        $chartjs->optionsRaw("{
            legend: {
                display:false
                    },
            scales:{
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 0.2,
                        beginAtZero: true
                    }
                }]
            }
            }");
        
        
        return view('reports.charts.equipment_functionality', compact('chartjs'));


    }


    public function accuracyReportingChart()
    {


        //visit 1
        $visit_ones = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 1)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 2

        $visit_twos = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 2)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 3
        $visit_threes = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 3)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 4
        $visit_fours = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 4)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );

        //visit 5
        $visit_fives = Collection::make (DB::table('spars_summary_scores')
            ->select('spars_summary_scores.indicator25_score')      
            ->join('survey_summary', 'spars_summary_scores.survey_summary_id', '=', 'survey_summary.id')
            ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
            ->where('survey_summary.visit_number', 5)                     
            ->where('survey_summary.step', 6)               
            ->where('health_facilities.is_control_facility', 0)
            ->where('spars_summary_scores.indicator1_score','!=', -1)               
            ->get() );


        $chartjs = app()->chartjs
        ->name('lineChart')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Visit 1', 'Visit 2', 'Visit 3', 'Visit 4', 'Visit 5'])
        ->datasets([
            [
                "label" => "Accuracy of Reporting",
                'backgroundColor' => "rgba(255, 255, 255, 0)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [round($visit_ones->avg('indicator25_score'),2), round($visit_twos->avg('indicator25_score'),2),round($visit_threes->avg('indicator25_score'),2),round($visit_fours->avg('indicator25_score'),2),round($visit_fives->avg('indicator25_score'),2)],
            ]
        ])
        ->options([]);

        $chartjs->optionsRaw("{
            legend: {
                display:false
                    },
            scales:{
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 1,
                        stepSize: 0.2,
                        beginAtZero: true
                    }
                }]
            }
            }");
        
        
        return view('reports.charts.accuracy_reporting', compact('chartjs'));


    }

}
