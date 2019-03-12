<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\District;

use App\Models\Cadre;

use App\Models\HealthFacility;

use App\Models\Personnel;

use App\Models\SurveySummary;

use App\Models\SupervisedPerson;

use App\Models\Supervisor;

use App\Models\General;

use App\Models\StockManagement;

use App\Models\StorageManagement10;

use App\Models\StorageManagement11;

use App\Models\StorageManagement12;

use App\Models\StorageManagement13;

use App\Models\StorageManagement14;

use App\Models\Ordering15;

use App\Models\Ordering16;

use App\Models\Ordering17;

use App\Models\Equipment18;

use App\Models\Equipment19;

use App\Models\Equipment20;

use App\Models\Equipment21;

use App\Models\InformationSystem22;

use App\Models\InformationSystem23;

use App\Models\InformationSystem24;

use App\Models\InformationSystem25;

use App\Models\InformationSystem26;

use App\Models\InformationSystem27;

use App\Models\IndicatorScoreSummary;

use App\Models\VuSummaryScore;

use DB;

use DateTime;

use Auth;

use Session;

use Illuminate\Support\Facades\Redirect;



class ApiController extends Controller
{
  //
  public function getCadreList()
  {
    //
    $cadre_list = Cadre::orderBy('name', 'asc')
    ->lists('name','id');
    $cadre_list->prepend("","");

    return $cadre_list;
  }

  //
  public function getPersonnelList()
  {
    $person = Personnel::get();
    $personnel_list = $person->lists('PersonFullName', 'id');

    return $personnel_list;
  }


  public function getDistrictList(Request $request)
  {
    //

    $district_list = HealthFacility::where('region','=',$request->region_id)->orderBy('district', 'asc')
    ->lists('district','district');
    $district_list->prepend("","");


    return $district_list;
  }

  public function getSubDistrict(Request $request)
  {
    //
    $sub_district_list = HealthFacility::where('district','=',$request->district)->distinct('hsd')->orderBy('hsd', 'asc')
    ->lists('hsd','hsd');
    $sub_district_list->prepend("","");


    return $sub_district_list;
  }

  public function getFacilityList(Request $request)
  {
    //

    $facility_list = HealthFacility::where('district','=',$request->district)
    ->where('hsd','=',$request->sub_district)
    ->distinct('facility')
    ->orderBy('facility', 'asc')
    ->lists('facility','id');

    $facility_list->prepend("","");


    return $facility_list;
  }


  public function getFacilityInfo(Request $request)
  {
    //
    $facility_info = HealthFacility::find($request->facility_id);

    $summary = SurveySummary::where('health_facility_id','=',$request->facility_id)->max('visit_number');


    return json_encode( [ 'facility' => $facility_info, 'visit_number' => $summary==null?0:$summary ] );
  }


  public function getDistrictsByRegion(Request $request)
  {
    //
    $district_list = HealthFacility::where('region','=',$request->region)->orderBy('district', 'asc')
    ->lists('district','district');
    $district_list->prepend("","");

    return $district_list;
  }


  public function getSubDistrictsByRegion(Request $request)
  {
    //
    $sub_district_list = HealthFacility::where('region','=',$request->region)
    ->where('district','=',$request->district)
    ->orderBy('hsd', 'asc')
    ->lists('hsd','hsd');

    $sub_district_list->prepend("","");

    return $sub_district_list;
  }


  public function getOwnershipByRegion(Request $request)
  {
    //
    $ownership_list = HealthFacility::where('region','=',$request->region)
    ->where('district','=',$request->district)
    ->where('hsd','=',$request->sub_district)
    ->distinct('ownership')
    ->orderBy('ownership', 'asc')
    ->lists('ownership','ownership');

    $ownership_list->prepend("","");

    return $ownership_list;
  }


  public function getLevelByRegion(Request $request)
  {
    //
    $level_list = HealthFacility::where('region','=',$request->region)
    ->where('district','=',$request->district)
    ->where('hsd','=',$request->sub_district)
    ->where('ownership','=',$request->ownership)
    ->distinct('level')
    ->orderBy('level', 'asc')
    ->lists('level','level');

    $level_list->prepend("","");

    return $level_list;
  }


  public function getFacilityByRegion(Request $request)
  {
    //
    $facility_list = HealthFacility::where('region','=',$request->region)
    ->where('district','=',$request->district)
    ->where('hsd','=',$request->sub_district)
    ->where('ownership','=',$request->ownership)
    ->where('level','=',$request->level)
    ->orderBy('facility', 'asc')
    ->lists('facility','facility');

    $facility_list->prepend("","");

    return $facility_list;
  }


  public function dashboardIndicatorScores(Request $request)
  {

    //
    $scores = [];


    $scores = DB::table('spars_summary_scores')
    ->join('health_facilities', 'spars_summary_scores.health_facility_id', '=', 'health_facilities.id')
    ->select(DB::raw('avg(indicator1_score) indicator1_score, avg(indicator2_score) indicator2_score,avg(indicator3_score) indicator3_score, avg(indicator4_score) indicator4_score,avg(indicator5_score) indicator5_score, avg(indicator6_score) indicator6_score,avg(indicator7_score) indicator7_score, avg(indicator8_score) indicator8_score,avg(indicator9_score) indicator9_score, avg(indicator10_score) indicator10_score, avg(indicator11_score) indicator11_score,avg(indicator12_score) indicator12_score, avg(indicator13_score) indicator13_score,avg(indicator14_score) indicator14_score, avg(indicator15_score) indicator15_score,avg(indicator16_score) indicator16_score, avg(indicator17_score) indicator17_score,avg(indicator18_score) indicator18_score, avg(indicator19_score) indicator19_score,avg(indicator20_score) indicator20_score, avg(indicator21_score) indicator21_score,avg(indicator22_score) indicator22_score, avg(indicator23_score) indicator23_score,avg(indicator24_score) indicator24_score, avg(indicator25_score) indicator25_score,avg(indicator26_score) indicator26_score,avg(indicator27_score) indicator27_score'))
    ->wherein('health_facilities.region',$request->region==null?HealthFacility::distinct()->select('region')->get():[$request->region=>$request->region])
    ->wherein('health_facilities.hsd',$request->hsd==null?HealthFacility::distinct()->select('hsd')->get():[$request->hsd=>$request->hsd])
    ->wherein('health_facilities.ownership',$request->ownership==null?HealthFacility::distinct()->select('ownership')->get():[$request->ownership=>$request->ownership])
    ->wherein('health_facilities.level',$request->level==null?HealthFacility::distinct()->select('level')->get():[$request->level=>$request->level])
    ->wherein('health_facilities.facility',$request->facility==null?HealthFacility::distinct()->select('facility')->get():[$request->facility=>$request->facility])
    ->where('spars_summary_scores.health_facility_id','=',2957)
    ->first();



    //STORAGE ADJUSTMENT
    $storage_management_score_na = 0;
    $storage_management_score_adj = 0;
    $storage_management_score=0;

    ( $scores->indicator10_score<0?$storage_management_score_na++:( $scores->indicator11_score<0?$storage_management_score_na++:( $scores->indicator12_score<0?$storage_management_score_na++:( $scores->indicator13_score<0?$storage_management_score_na++:( $scores->indicator14_score<0?$storage_management_score_na++:'' ) ) ) ) );

    ( $scores->indicator10_score<0?$storage_management_score_adj++:( $scores->indicator11_score<0?$storage_management_score_adj++:( $scores->indicator12_score<0?$storage_management_score_adj++:( $scores->indicator13_score<0?$storage_management_score_adj++:( $scores->indicator14_score<0?$storage_management_score_adj++:''  )   ) ) ) );

    //ORDERING ADJUSTMENT
    $ordering_score_na = 0;
    $ordering_score_adj = 0;
    $ordering_score=0;

    ( $scores->indicator15_score<0?$ordering_score_na++:( $scores->indicator16_score<0?$ordering_score_na++:( $scores->indicator17_score<0?$ordering_score_na++:'' ) ) );

    ( $scores->indicator15_score<0?$ordering_score_adj++:( $scores->indicator16_score<0?$ordering_score_adj++:( $scores->indicator17_score<0?$ordering_score_adj++:'' ) ) );


    //EQUIPMENT ADJUSTMENT
    $equipment_score_na = 0;
    $equipment_score_adj = 0;
    $equipment_score=0;

    ( $scores->indicator18_score<0?$equipment_score_na++:( $scores->indicator19_score<0?$equipment_score_na++:( $scores->indicator20_score<0?$equipment_score_na++:( $scores->indicator21_score<0?$equipment_score_na++:'' ) ) ) );

    ( $scores->indicator18_score<0?$equipment_score_adj++:( $scores->indicator19_score<0?$equipment_score_adj++:( $scores->indicator20_score<0?$equipment_score_adj++:( $scores->indicator21_score<0?$equipment_score_adj++:'' ) ) ) );


    //LIS ADJUSTMENT
    $lis_score_na = 0;
    $lis_score_adj = 0;
    $information_system_score=0;

    ( $scores->indicator22_score<0?$lis_score_na++:( $scores->indicator23_score<0?$lis_score_na++:( $scores->indicator24_score<0?$lis_score_na++:( $scores->indicator25_score<0?$lis_score_na++:( $scores->indicator26_score<0?$lis_score_na++:( $scores->indicator27_score<0?$lis_score_na++:'' ) ) ) ) ) );

    ( $scores->indicator22_score<0?$lis_score_adj++:( $scores->indicator23_score<0?$lis_score_adj++:( $scores->indicator24_score<0?$lis_score_adj++:( $scores->indicator25_score<0?$lis_score_adj++:( $scores->indicator26_score<0?$lis_score_adj++:( $scores->indicator27_score<0?$lis_score_adj++:'' )  )   ) ) ) );



    //STOCK MANAGEMENT ADJUSTMENT
    $stock_management_score_na = 0;
    $stock_management_score_adj = 0;
    $stock_management_score=0;

    ( $scores->indicator1_score<0?$stock_management_score_na++:( $scores->indicator2_score<0?$stock_management_score_na++:( $scores->indicator3_score<0?$stock_management_score_na++:( $scores->indicator4_score<0?$stock_management_score_na++:( $scores->indicator5_score<0?$stock_management_score_na++:( $scores->indicator6_score<0?$stock_management_score_na++:( $scores->indicator7_score<0?$stock_management_score_na++:( $scores->indicator8_score<0?$stock_management_score_na++:( $scores->indicator9_score<0?$stock_management_score_na++:'' )  )  )  ) ) ) ) ) );

    ( $scores->indicator1_score<0?$stock_management_score_adj++:( $scores->indicator2_score<0?$stock_management_score_adj++:( $scores->indicator3_score<0?$stock_management_score_adj++:( $scores->indicator4_score<0?$stock_management_score_adj++:( $scores->indicator5_score<0?$stock_management_score_adj++:( $scores->indicator6_score<0?$stock_management_score_adj++:( $scores->indicator7_score<0?$stock_management_score_adj++:( $scores->indicator8_score<0?$stock_management_score_adj++:( $scores->indicator9_score<0?$stock_management_score_adj++:'' ) ) )  )  )   ) ) ) );



    if($stock_management_score_na!=9)
    {

      $stock_management_score = ($scores->indicator1_score+$scores->indicator2_score+$scores->indicator3_score+$scores->indicator4_score+$scores->indicator5_score+$scores->indicator6_score+$scores->indicator7_score+$scores->indicator8_score+$scores->indicator9_score+$stock_management_score_adj)/(9-$stock_management_score_na)*5;
    }


    if($storage_management_score_na!=5)
    {

      $storage_management_score = ($scores->indicator10_score+$scores->indicator11_score+$scores->indicator12_score+$scores->indicator13_score+$scores->indicator14_score+$storage_management_score_adj)/(5-$storage_management_score_na)*5;
    }


    if($ordering_score_na!=3)
    {

      $ordering_score = ($scores->indicator15_score+$scores->indicator16_score+$scores->indicator17_score+$ordering_score_adj)/(3-$ordering_score_na)*5;
    }

    if($equipment_score_na!=4)
    {

      $equipment_score = ($scores->indicator18_score+$scores->indicator19_score+$scores->indicator20_score+$scores->indicator21_score+$equipment_score_adj)/(4-$equipment_score_na)*5;
    }


    if($lis_score_na!=6)
    {

      $information_system_score = ($scores->indicator22_score+$scores->indicator23_score+$scores->indicator24_score+$scores->indicator25_score+$scores->indicator26_score+$scores->indicator27_score+$lis_score_adj)/(6-$lis_score_na)*5;

    }

    return response()->json(['scores'=>$scores,'stock_management_score'=>$stock_management_score,'storage_management_score'=>$storage_management_score,'ordering_score'=>$ordering_score,'equipment_score'=>$equipment_score,'information_system_score'=>$information_system_score,'dataFound'=>$scores->indicator1_score===null?false:true]);
  }


  public function saveSurveySummary(Request $request)
  {


    $exists = SurveySummary::where('form_id','=',$request->form_id)->first();


    $general_response = $summary_response = $facility_response = $form_id = null;

    if($exists==null)
    {

      $form_id = uniqid();

      //save visit summary information
      $summary = new SurveySummary;
      $summary->health_facility_id = $request->facility_id;
      $summary->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);

      $summary->next_visit_date = DateTime::createFromFormat('d F Y', $request->next_visit_date);
      $summary->form_id = $form_id;
      $summary->visit_number = $request->visit_number;
      $summary->form_version = 2;
      $summary->step = 0;
      $summary->upload_status = 0;
      $summary->created_by = Auth::user()->id;

      $summary_response = $summary->save();


      // supervised persons
      foreach ($request->supervisedList as $person) {


        $supervised_person = new SupervisedPerson;

        $supervised_person->name = $person['name'];
        $supervised_person->gender = $person['gender'];
        $supervised_person->cadre_id = $person['cadre'];
        $supervised_person->phone_number = $person['telephone'];

        $supervised_person->health_facility_id = $request->facility_id;
        $supervised_person->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $supervised_person->form_id = $form_id;
        $supervised_person->created_by = Auth::user()->id;
        $supervised_person->upload_status =0;

        $supervised_person->save();

      }


      //save supervisors
      foreach ($request->supervisorList as $person) {

        $supervisor = new Supervisor;

        $supervisor->person_id = $person['supervisor_id'];
        $supervisor->health_facility_id = $request->facility_id;
        $supervisor->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $supervisor->form_id = $form_id;
        $supervisor->created_by = Auth::user()->id;
        $supervisor->upload_status = 0;

        $supervisor->save();

      }

      //update visit_number for facility
      $facility = HealthFacility::find($request->facility_id);
      $facility->visit_number = $request->visit_number;
      $facility->in_charge_fname = $request->in_charge_name;
      $facility->in_charge_contact = $request->in_charge_telephone;
      $facility->lss_fname = $request->responsible_lss;
      $facility->upload_status = 0;
      $facility->timestamps = false;

      $facility_response = $facility->save();


      //save general information for visit
      $general = new General;

      $general->d1 = $request->d1;
      $general->d3 = $request->d3=='true'?true:false;
      $general->d2comment = $request->d2comment;
      $general->d3comment = $request->d3comment;
      $general->d4comment = $request->d4comment;

      $general->d5 = $request->d5;

      $general->health_facility_id = $request->facility_id;
      $general->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $general->form_id = $form_id;
      $general->created_by = Auth::user()->id;
      $general->upload_status = 0;

      $general_response = $general->save();

      //save d2
      if($request->d2 !="")
      {
        $d2g =  General::find($general->id);

        foreach($request->d2 as $d)
        {
          if($d==1)
          {
            $d2g->d2a = true;
            $d2g->save();
            continue;
          }
          if($d==2)
          {
            $d2g->d2b = true;
            $d2g->save();
            continue;
          }
          if($d==3)
          {
            $d2g->d2c = true;
            $d2g->save();
            continue;
          }
          if($d==4)
          {
            $d2g->d2d = true;
            $d2g->save();
            continue;
          }
          if($d==5)
          {
            $d2g->d2e = true;
            $d2g->save();
            continue;
          }
          if($d==6)
          {
            $d2g->d2f = true;
            $d2g->save();
            continue;
          }
        }

      }

      //save d4
      if($request->d4 !="")
      {
        $d4g =  General::findorFail($general->id);

        foreach($request->d4 as $d)
        {
          if($d==1)
          {
            $d4g->d4a = true;
            $d4g->save();
            continue;
          }
          if($d==2)
          {
            $d4g->d4b = true;
            $d4g->save();
            continue;
          }
          if($d==3)
          {
            $d4g->d4c = true;
            $d4g->save();
            continue;
          }
          if($d==4)
          {
            $d4g->d4d = true;
            $d4g->save();
            continue;
          }
          if($d==5)
          {
            $d4g->d4e = true;
            $d4g->save();
            continue;
          }
          if($d==6)
          {
            $d4g->d4f = true;
            $d4g->save();
            continue;
          }
        }


      }

    }

    else
    {

      $summary = SurveySummary::where('form_id',$request->form_id)->first();
      $summary->health_facility_id = $request->facility_id;
      $summary->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      //$summary->step = 0;
      $summary->next_visit_date = DateTime::createFromFormat('d F Y', $request->next_visit_date);
      $summary->updated_by = Auth::user()->id;

      $summary_response = $summary->save();


      //update visit_number for facility
      $facility = HealthFacility::find($request->facility_id);
      $facility->visit_number = $request->visit_number;
      $facility->in_charge_fname = $request->in_charge_name;
      $facility->in_charge_contact = $request->in_charge_telephone;
      $facility->lss_fname = $request->responsible_lss;
      $facility->timestamps = false;

      $facility_response = $facility->save();


      //save general information for visit
      $general = General::where('form_id',$request->form_id)->first();

      $general->d1 = $request->d1;
      $general->d3 = $request->d3=='true'?true:false;
      $general->d2comment = $request->d2comment;
      $general->d3comment = $request->d3comment;
      $general->d4comment = $request->d4comment;

      $general->d5 = $request->d5;

      $general->health_facility_id = $request->facility_id;
      $general->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $general->updated_by = Auth::user()->id;

      $general_response = $general->save();

      //save d2
      if($request->d2 !="")
      {
        $d2g = General::where('form_id',$request->form_id)->first();

        $d2g->d2a = false;
        $d2g->d2b = false;
        $d2g->d2c = false;
        $d2g->d2d = false;
        $d2g->d2e = false;
        $d2g->d2f = false;
        $d2g->save();

        foreach($request->d2 as $d)
        {
          if($d==1)
          {
            $d2g->d2a = true;
            $d2g->save();
            continue;
          }
          if($d==2)
          {
            $d2g->d2b = true;
            $d2g->save();
            continue;
          }
          if($d==3)
          {
            $d2g->d2c = true;
            $d2g->save();
            continue;
          }
          if($d==4)
          {
            $d2g->d2d = true;
            $d2g->save();
            continue;
          }
          if($d==5)
          {
            $d2g->d2e = true;
            $d2g->save();
            continue;
          }
          if($d==6)
          {
            $d2g->d2f = true;
            $d2g->save();
            continue;
          }
        }

      }

      //save d4
      if($request->d4 !="")
      {
        $d4g = General::where('form_id',$request->form_id)->first();


        $d4g->d4a = false;
        $d4g->d4b = false;
        $d4g->d4c = false;
        $d4g->d4d = false;
        $d4g->d4e = false;
        $d4g->d4f = false;
        $d4g->save();

        foreach($request->d4 as $d)
        {
          if($d==1)
          {
            $d4g->d4a = true;
            $d4g->save();
            continue;
          }
          if($d==2)
          {
            $d4g->d4b = true;
            $d4g->save();
            continue;
          }
          if($d==3)
          {
            $d4g->d4c = true;
            $d4g->save();
            continue;
          }
          if($d==4)
          {
            $d4g->d4d = true;
            $d4g->save();
            continue;
          }
          if($d==5)
          {
            $d4g->d4e = true;
            $d4g->save();
            continue;
          }
          if($d==6)
          {
            $d4g->d4f = true;
            $d4g->save();
            continue;
          }
        }


      }

    }

    return response()->json(['general' => $general_response,'summary' => $summary_response,'facility' => $facility_response,'form_id' => $form_id ] );

  }

  public function saveStockManagement(Request $request)
  {

    $summary = SurveySummary::where('form_id','=',$request->form_id)->first();

    if($summary != null)
    {

      $summary->step = 1;
      $summary->save();

    }

    $exists = StockManagement::where('form_id','=',$request->form_id)->first();


    $stock_management_response = null;

    if($exists==null)
    {

      //save stock management
      $stock_management = new StockManagement;

      $stock_management->r1c1 = $request->r1_c1=='NA'?-1:($request->r1_c1==null?-9:$request->r1_c1);
      $stock_management->r1c2 = $request->r1_c2=='NA'?-1:($request->r1_c2=='E'?-3:($request->r1_c2==null?-9:$request->r1_c2));
      $stock_management->r1c3 = $request->r1_c3=='NA'?-1:($request->r1_c3==null?-9:$request->r1_c3);
      $stock_management->r1c4 = $request->r1_c4=='NA'?-1:($request->r1_c4==null?-9:$request->r1_c4);
      $stock_management->r1c5 = $request->r1_c5=='NA'?-1:($request->r1_c5==null?-9:$request->r1_c5);
      $stock_management->r1c6 = $request->r1_c6=='NA'?-1:($request->r1_c6==null?-9:$request->r1_c6);
      $stock_management->r1c7 = ($request->r1_c7=='NA'?-1:($request->r1_c7==null?-9:$request->r1_c7));
      $stock_management->r1c8 = $request->r1_c8=='NA'?-1:($request->r1_c8==null?-9:$request->r1_c8);
      $stock_management->r1c9 = $request->r1_c9=='NA'?-1:($request->r1_c9==null?-9:$request->r1_c9);
      $stock_management->r1c10 = $request->r1_c10=='NA'?-1:($request->r1_c10==null?-9:$request->r1_c10);
      $stock_management->r1c11 = $request->r1_c11=='NA'?-1:($request->r1_c11=='NR'?-2:($request->r1_c11==null?-9:$request->r1_c11));
      $stock_management->r1c12 = $request->r1_c12=='NA'?-1:($request->r1_c12=='NR'?-2:($request->r1_c12==null?-9:$request->r1_c12));
      $stock_management->r1c13 = $request->r1_c13=='NA'?-1:($request->r1_c13=='NR'?-2:($request->r1_c13==null?-9:$request->r1_c13));
      $stock_management->r1c14 = $request->r1_c14=='NA'?-1:($request->r1_c14==null?-9:$request->r1_c14);
      $stock_management->r1c15 = $request->r1_c15=='NA'?-1:($request->r1_c15==null?-9:$request->r1_c15);
      $stock_management->r1c16 = $request->r1_c16=='NA'?-1:($request->r1_c16=='NR'?-2:($request->r1_c16==null?-9:$request->r1_c16));
      $stock_management->r1c17 = $request->r1_c17=='NA'?-1:($request->r1_c17=='NR'?-2:($request->r1_c17==null?-9:$request->r1_c17));
      $stock_management->r1c18 = $request->r1_c18=='NA'?-1:($request->r1_c18==null?-9:$request->r1_c18);
      $stock_management->r1c19 = $request->r1_c19=='NA'?-1:($request->r1_c19==null?-9:$request->r1_c19);
      $stock_management->r1c20 = $request->r1_c20=='NA'?-1:($request->r1_c20==null?-9:$request->r1_c20);
      $stock_management->r1c21 = $request->r1_c21=='NA'?-1:($request->r1_c21=='NR'?-2:($request->r1_c21==null?-9:$request->r1_c21));
      $stock_management->r1c22 = $request->r1_c22=='NA'?-1:($request->r1_c22=='PS'?-4:($request->r1_c22=='NR'?-2:($request->r1_c22==null?-9:$request->r1_c22)));


      $stock_management->r2c2_cd4item = $request->cd4_testing;
      $stock_management->r2c1 = $request->r2_c1=='NA'?-1:($request->r2_c1==null?-9:$request->r2_c1);
      $stock_management->r2c2 = $request->r2_c2=='NA'?-1:($request->r2_c2=='E'?-3:($request->r2_c2==null?-9:$request->r2_c2));
      $stock_management->r2c3 = $request->r2_c3=='NA'?-1:($request->r2_c3==null?-9:$request->r2_c3);
      $stock_management->r2c4 = $request->r2_c4=='NA'?-1:($request->r2_c4==null?-9:$request->r2_c4);
      $stock_management->r2c5 = $request->r2_c5=='NA'?-1:($request->r2_c5==null?-9:$request->r2_c5);
      $stock_management->r2c6 = $request->r2_c6=='NA'?-1:($request->r2_c6==null?-9:$request->r2_c6);
      $stock_management->r2c7 = ($request->r2_c7=='NA'?-1:($request->r2_c7==null?-9:$request->r2_c7));
      $stock_management->r2c8 = $request->r2_c8=='NA'?-1:($request->r2_c8==null?-9:$request->r2_c8);
      $stock_management->r2c9 = $request->r2_c9=='NA'?-1:($request->r2_c9==null?-9:$request->r2_c9);
      $stock_management->r2c10 = $request->r2_c10=='NA'?-1:($request->r2_c10==null?-9:$request->r2_c10);
      $stock_management->r2c11 = $request->r2_c11=='NA'?-1:($request->r2_c11=='NR'?-2:($request->r2_c11==null?-9:$request->r2_c11));
      $stock_management->r2c12 = $request->r2_c12=='NA'?-1:($request->r2_c12=='NR'?-2:($request->r2_c12==null?-9:$request->r2_c12));
      $stock_management->r2c13 = $request->r2_c13=='NA'?-1:($request->r2_c13=='NR'?-2:($request->r2_c13==null?-9:$request->r2_c13));
      $stock_management->r2c14 = $request->r2_c14=='NA'?-1:($request->r2_c14==null?-9:$request->r2_c14);
      $stock_management->r2c15 = $request->r2_c15=='NA'?-1:($request->r2_c15==null?-9:$request->r2_c15);
      $stock_management->r2c16 = $request->r2_c16=='NA'?-1:($request->r2_c16=='NR'?-2:($request->r2_c16==null?-9:$request->r2_c16));
      $stock_management->r2c17 = $request->r2_c17=='NA'?-1:($request->r2_c17=='NR'?-2:($request->r2_c17==null?-9:$request->r2_c17));
      $stock_management->r2c18 = $request->r2_c18=='NA'?-1:($request->r2_c18==null?-9:$request->r2_c18);
      $stock_management->r2c19 = $request->r2_c19=='NA'?-1:($request->r2_c19==null?-9:$request->r2_c19);
      $stock_management->r2c20 = $request->r2_c20=='NA'?-1:($request->r2_c20==null?-9:$request->r2_c20);
      $stock_management->r2c21 = $request->r2_c21=='NA'?-1:($request->r2_c21=='NR'?-2:($request->r2_c21==null?-9:$request->r2_c21));
      $stock_management->r2c22 = $request->r2_c22=='NA'?-1:($request->r2_c22=='PS'?-4:($request->r2_c22=='NR'?-2:($request->r2_c22==null?-9:$request->r2_c22)));

      $stock_management->r3c1 = $request->r3_c1=='NA'?-1:($request->r3_c1==null?-9:$request->r3_c1);
      $stock_management->r3c2 = $request->r3_c2=='NA'?-1:($request->r3_c2=='E'?-3:($request->r3_c2==null?-9:$request->r3_c2));
      $stock_management->r3c3 = $request->r3_c3=='NA'?-1:($request->r3_c3==null?-9:$request->r3_c3);
      $stock_management->r3c4 = $request->r3_c4=='NA'?-1:($request->r3_c4==null?-9:$request->r3_c4);
      $stock_management->r3c5 = $request->r3_c5=='NA'?-1:($request->r3_c5==null?-9:$request->r3_c5);
      $stock_management->r3c6 = $request->r3_c6=='NA'?-1:($request->r3_c6==null?-9:$request->r3_c6);
      $stock_management->r3c7 = ($request->r3_c7=='NA'?-1:($request->r3_c7==null?-9:$request->r3_c7));
      $stock_management->r3c8 = $request->r3_c8=='NA'?-1:($request->r3_c8==null?-9:$request->r3_c8);
      $stock_management->r3c9 = $request->r3_c9=='NA'?-1:($request->r3_c9==null?-9:$request->r3_c9);
      $stock_management->r3c10 = $request->r3_c10=='NA'?-1:($request->r3_c10==null?-9:$request->r3_c10);
      $stock_management->r3c11 = $request->r3_c11=='NA'?-1:($request->r3_c11=='NR'?-2:($request->r3_c11==null?-9:$request->r3_c11));
      $stock_management->r3c12 = $request->r3_c12=='NA'?-1:($request->r3_c12=='NR'?-2:($request->r3_c12==null?-9:$request->r3_c12));
      $stock_management->r3c13 = $request->r3_c13=='NA'?-1:($request->r3_c13=='NR'?-2:($request->r3_c13==null?-9:$request->r3_c13));
      $stock_management->r3c14 = $request->r3_c14=='NA'?-1:($request->r3_c14==null?-9:$request->r3_c14);
      $stock_management->r3c15 = $request->r3_c15=='NA'?-1:($request->r3_c15==null?-9:$request->r3_c15);
      $stock_management->r3c16 = $request->r3_c16=='NA'?-1:($request->r3_c16=='NR'?-2:($request->r3_c16==null?-9:$request->r3_c16));
      $stock_management->r3c17 = $request->r3_c17=='NA'?-1:($request->r3_c17=='NR'?-2:($request->r3_c17==null?-9:$request->r3_c17));
      $stock_management->r3c18 = $request->r3_c18=='NA'?-1:($request->r3_c18==null?-9:$request->r3_c18);
      $stock_management->r3c19 = $request->r3_c19=='NA'?-1:($request->r3_c19==null?-9:$request->r3_c19);
      $stock_management->r3c20 = $request->r3_c20=='NA'?-1:($request->r3_c20==null?-9:$request->r3_c20);
      $stock_management->r3c21 = $request->r3_c21=='NA'?-1:($request->r3_c21=='NR'?-2:($request->r3_c21==null?-9:$request->r3_c21));
      $stock_management->r3c22 = $request->r3_c22=='NA'?-1:($request->r3_c22=='PS'?-4:($request->r3_c22=='NR'?-2:($request->r3_c22==null?-9:$request->r3_c22)));


      $stock_management->r4c1 = $request->r4_c1=='NA'?-1:($request->r4_c1==null?-9:$request->r4_c1);
      $stock_management->r4c2 = $request->r4_c2=='NA'?-1:($request->r4_c2=='E'?-3:($request->r4_c2==null?-9:$request->r4_c2));
      $stock_management->r4c3 = $request->r4_c3=='NA'?-1:($request->r4_c3==null?-9:$request->r4_c3);
      $stock_management->r4c4 = $request->r4_c4=='NA'?-1:($request->r4_c4==null?-9:$request->r4_c4);
      $stock_management->r4c5 = $request->r4_c5=='NA'?-1:($request->r4_c5==null?-9:$request->r4_c5);
      $stock_management->r4c6 = $request->r4_c6=='NA'?-1:($request->r4_c6==null?-9:$request->r4_c6);
      $stock_management->r4c7 = ($request->r4_c7=='NA'?-1:($request->r4_c7==null?-9:$request->r4_c7));
      $stock_management->r4c8 = $request->r4_c8=='NA'?-1:($request->r4_c8==null?-9:$request->r4_c8);
      $stock_management->r4c9 = $request->r4_c9=='NA'?-1:($request->r4_c9==null?-9:$request->r4_c9);
      $stock_management->r4c10 = $request->r4_c10=='NA'?-1:($request->r4_c10==null?-9:$request->r4_c10);
      $stock_management->r4c11 = $request->r4_c11=='NA'?-1:($request->r4_c11=='NR'?-2:($request->r4_c11==null?-9:$request->r4_c11));
      $stock_management->r4c12 = $request->r4_c12=='NA'?-1:($request->r4_c12=='NR'?-2:($request->r4_c12==null?-9:$request->r4_c12));
      $stock_management->r4c13 = $request->r4_c13=='NA'?-1:($request->r4_c13=='NR'?-2:($request->r4_c13==null?-9:$request->r4_c13));
      $stock_management->r4c14 = $request->r4_c14=='NA'?-1:($request->r4_c14==null?-9:$request->r4_c14);
      $stock_management->r4c15 = $request->r4_c15=='NA'?-1:($request->r4_c15==null?-9:$request->r4_c15);
      $stock_management->r4c16 = $request->r4_c16=='NA'?-1:($request->r4_c16=='NR'?-2:($request->r4_c16==null?-9:$request->r4_c16));
      $stock_management->r4c17 = $request->r4_c17=='NA'?-1:($request->r4_c17=='NR'?-2:($request->r4_c17==null?-9:$request->r4_c17));
      $stock_management->r4c18 = $request->r4_c18=='NA'?-1:($request->r4_c18==null?-9:$request->r4_c18);
      $stock_management->r4c19 = $request->r4_c19=='NA'?-1:($request->r4_c19==null?-9:$request->r4_c19);
      $stock_management->r4c20 = $request->r4_c20=='NA'?-1:($request->r4_c20==null?-9:$request->r4_c20);
      $stock_management->r4c21 = $request->r4_c21=='NA'?-1:($request->r4_c21=='NR'?-2:($request->r4_c21==null?-9:$request->r4_c21));
      $stock_management->r4c22 = $request->r4_c22=='NA'?-1:($request->r4_c22=='PS'?-4:($request->r4_c22=='NR'?-2:($request->r4_c22==null?-9:$request->r4_c22)));


      $stock_management->r11c1 = $request->r3b_c1=='NA'?-1:($request->r3b_c1==null?-9:$request->r3b_c1);
      $stock_management->r11c2 = $request->r3b_c2=='NA'?-1:($request->r3b_c2=='E'?-3:($request->r3b_c2==null?-9:$request->r3b_c2));
      $stock_management->r11c3 = $request->r3b_c3=='NA'?-1:($request->r3b_c3==null?-9:$request->r3b_c3);
      $stock_management->r11c4 = $request->r3b_c4=='NA'?-1:($request->r3b_c4==null?-9:$request->r3b_c4);
      $stock_management->r11c5 = $request->r3b_c5=='NA'?-1:($request->r3b_c5==null?-9:$request->r3b_c5);
      $stock_management->r11c6 = $request->r3b_c6=='NA'?-1:($request->r3b_c6==null?-9:$request->r3b_c6);
      $stock_management->r11c7 = ($request->r3b_c7=='NA'?-1:($request->r3b_c7==null?-9:$request->r3b_c7));
      $stock_management->r11c8 = $request->r3b_c8=='NA'?-1:($request->r3b_c8==null?-9:$request->r3b_c8);
      $stock_management->r11c9 = $request->r3b_c9=='NA'?-1:($request->r3b_c9==null?-9:$request->r3b_c9);
      $stock_management->r11c10 = $request->r3b_c10=='NA'?-1:($request->r3b_c10==null?-9:$request->r3b_c10);
      $stock_management->r11c11 = $request->r3b_c11=='NA'?-1:($request->r3b_c11=='NR'?-2:($request->r3b_c11==null?-9:$request->r3b_c11));
      $stock_management->r11c12 = $request->r3b_c12=='NA'?-1:($request->r3b_c12=='NR'?-2:($request->r3b_c12==null?-9:$request->r3b_c12));
      $stock_management->r11c13 = $request->r3b_c13=='NA'?-1:($request->r3b_c13=='NR'?-2:($request->r3b_c13==null?-9:$request->r3b_c13));
      $stock_management->r11c14 = $request->r3b_c14=='NA'?-1:($request->r3b_c14==null?-9:$request->r3b_c14);
      $stock_management->r11c15 = $request->r3b_c15=='NA'?-1:($request->r3b_c15==null?-9:$request->r3b_c15);
      $stock_management->r11c16 = $request->r3b_c16=='NA'?-1:($request->r3b_c16=='NR'?-2:($request->r3b_c16==null?-9:$request->r3b_c16));
      $stock_management->r11c17 = $request->r3b_c17=='NA'?-1:($request->r3b_c17=='NR'?-2:($request->r3b_c17==null?-9:$request->r3b_c17));
      $stock_management->r11c18 = $request->r3b_c18=='NA'?-1:($request->r3b_c18==null?-9:$request->r3b_c18);
      $stock_management->r11c19 = $request->r3b_c19=='NA'?-1:($request->r3b_c19==null?-9:$request->r3b_c19);
      $stock_management->r11c20 = $request->r3b_c20=='NA'?-1:($request->r3b_c20==null?-9:$request->r3b_c20);
      $stock_management->r11c21 = $request->r3b_c21=='NA'?-1:($request->r3b_c21=='NR'?-2:($request->r3b_c21==null?-9:$request->r3b_c21));
      $stock_management->r11c22 = $request->r3b_c22=='NA'?-1:($request->r3b_c22=='PS'?-4:($request->r3b_c22=='NR'?-2:($request->r3b_c22==null?-9:$request->r3b_c22)));


      $stock_management->r10c1 = $request->r4b_c1=='NA'?-1:($request->r4b_c1==null?-9:$request->r4b_c1);
      $stock_management->r10c2 = $request->r4b_c2=='NA'?-1:($request->r4b_c2=='E'?-3:($request->r4b_c2==null?-9:$request->r4b_c2));
      $stock_management->r10c3 = $request->r4b_c3=='NA'?-1:($request->r4b_c3==null?-9:$request->r4b_c3);
      $stock_management->r10c4 = $request->r4b_c4=='NA'?-1:($request->r4b_c4==null?-9:$request->r4b_c4);
      $stock_management->r10c5 = $request->r4b_c5=='NA'?-1:($request->r4b_c5==null?-9:$request->r4b_c5);
      $stock_management->r10c6 = $request->r4b_c6=='NA'?-1:($request->r4b_c6==null?-9:$request->r4b_c6);
      $stock_management->r10c7 = ($request->r4b_c7=='NA'?-1:($request->r4b_c7==null?-9:$request->r4b_c7));
      $stock_management->r10c8 = $request->r4b_c8=='NA'?-1:($request->r4b_c8==null?-9:$request->r4b_c8);
      $stock_management->r10c9 = $request->r4b_c9=='NA'?-1:($request->r4b_c9==null?-9:$request->r4b_c9);
      $stock_management->r10c10 = $request->r4b_c10=='NA'?-1:($request->r4b_c10==null?-9:$request->r4b_c10);
      $stock_management->r10c11 = $request->r4b_c11=='NA'?-1:($request->r4b_c11=='NR'?-2:($request->r4b_c11==null?-9:$request->r4b_c11));
      $stock_management->r10c12 = $request->r4b_c12=='NA'?-1:($request->r4b_c12=='NR'?-2:($request->r4b_c12==null?-9:$request->r4b_c12));
      $stock_management->r10c13 = $request->r4b_c13=='NA'?-1:($request->r4b_c13=='NR'?-2:($request->r4b_c13==null?-9:$request->r4b_c13));
      $stock_management->r10c14 = $request->r4b_c14=='NA'?-1:($request->r4b_c14==null?-9:$request->r4b_c14);
      $stock_management->r10c15 = $request->r4b_c15=='NA'?-1:($request->r4b_c15==null?-9:$request->r4b_c15);
      $stock_management->r10c16 = $request->r4b_c16=='NA'?-1:($request->r4b_c16=='NR'?-2:($request->r4b_c16==null?-9:$request->r4b_c16));
      $stock_management->r10c17 = $request->r4b_c17=='NA'?-1:($request->r4b_c17=='NR'?-2:($request->r4b_c17==null?-9:$request->r4b_c17));
      $stock_management->r10c18 = $request->r4b_c18=='NA'?-1:($request->r4b_c18==null?-9:$request->r4b_c18);
      $stock_management->r10c19 = $request->r4b_c19=='NA'?-1:($request->r4b_c19==null?-9:$request->r4b_c19);
      $stock_management->r10c20 = $request->r4b_c20=='NA'?-1:($request->r4b_c20==null?-9:$request->r4b_c20);
      $stock_management->r10c21 = $request->r4b_c21=='NA'?-1:($request->r4b_c21=='NR'?-2:($request->r4b_c21==null?-9:$request->r4b_c21));
      $stock_management->r10c22 = $request->r4b_c22=='NA'?-1:($request->r4b_c22=='PS'?-4:($request->r4b_c22=='NR'?-2:($request->r4b_c22==null?-9:$request->r4b_c22)));


      $stock_management->r5c1 = $request->r5_c1=='NA'?-1:($request->r5_c1==null?-9:$request->r5_c1);
      $stock_management->r5c2 = $request->r5_c2=='NA'?-1:($request->r5_c2=='E'?-3:($request->r5_c2==null?-9:$request->r5_c2));
      $stock_management->r5c3 = $request->r5_c3=='NA'?-1:($request->r5_c3==null?-9:$request->r5_c3);
      $stock_management->r5c4 = $request->r5_c4=='NA'?-1:($request->r5_c4==null?-9:$request->r5_c4);
      $stock_management->r5c5 = $request->r5_c5=='NA'?-1:($request->r5_c5==null?-9:$request->r5_c5);
      $stock_management->r5c6 = $request->r5_c6=='NA'?-1:($request->r5_c6==null?-9:$request->r5_c6);
      $stock_management->r5c7 = ($request->r5_c7=='NA'?-1:($request->r5_c7==null?-9:$request->r5_c7));
      $stock_management->r5c8 = $request->r5_c8=='NA'?-1:($request->r5_c8==null?-9:$request->r5_c8);
      $stock_management->r5c9 = $request->r5_c9=='NA'?-1:($request->r5_c9==null?-9:$request->r5_c9);
      $stock_management->r5c10 = $request->r5_c10=='NA'?-1:($request->r5_c10==null?-9:$request->r5_c10);
      $stock_management->r5c11 = $request->r5_c11=='NA'?-1:($request->r5_c11=='NR'?-2:($request->r5_c11==null?-9:$request->r5_c11));
      $stock_management->r5c12 = $request->r5_c12=='NA'?-1:($request->r5_c12=='NR'?-2:($request->r5_c12==null?-9:$request->r5_c12));
      $stock_management->r5c13 = $request->r5_c13=='NA'?-1:($request->r5_c13=='NR'?-2:($request->r5_c13==null?-9:$request->r5_c13));
      $stock_management->r5c14 = $request->r5_c14=='NA'?-1:($request->r5_c14==null?-9:$request->r5_c14);
      $stock_management->r5c15 = $request->r5_c15=='NA'?-1:($request->r5_c15==null?-9:$request->r5_c15);
      $stock_management->r5c16 = $request->r5_c16=='NA'?-1:($request->r5_c16=='NR'?-2:($request->r5_c16==null?-9:$request->r5_c16));
      $stock_management->r5c17 = $request->r5_c17=='NA'?-1:($request->r5_c17=='NR'?-2:($request->r5_c17==null?-9:$request->r5_c17));
      $stock_management->r5c18 = $request->r5_c18=='NA'?-1:($request->r5_c18==null?-9:$request->r5_c18);
      $stock_management->r5c19 = $request->r5_c19=='NA'?-1:($request->r5_c19==null?-9:$request->r5_c19);
      $stock_management->r5c20 = $request->r5_c20=='NA'?-1:($request->r5_c20==null?-9:$request->r5_c20);
      $stock_management->r5c21 = $request->r5_c21=='NA'?-1:($request->r5_c21=='NR'?-2:($request->r5_c21==null?-9:$request->r5_c21));
      $stock_management->r5c22 = $request->r5_c22=='NA'?-1:($request->r5_c22=='PS'?-4:($request->r5_c22=='NR'?-2:($request->r5_c22==null?-9:$request->r5_c22)));


      $stock_management->r6c1 = $request->r6_c1=='NA'?-1:($request->r6_c1==null?-9:$request->r6_c1);
      $stock_management->r6c2 = $request->r6_c2=='NA'?-1:($request->r6_c2=='E'?-3:($request->r6_c2==null?-9:$request->r6_c2));
      $stock_management->r6c3 = $request->r6_c3=='NA'?-1:($request->r6_c3==null?-9:$request->r6_c3);
      $stock_management->r6c4 = $request->r6_c4=='NA'?-1:($request->r6_c4==null?-9:$request->r6_c4);
      $stock_management->r6c5 = $request->r6_c5=='NA'?-1:($request->r6_c5==null?-9:$request->r6_c5);
      $stock_management->r6c6 = $request->r6_c6=='NA'?-1:($request->r6_c6==null?-9:$request->r6_c6);
      $stock_management->r6c7 = ($request->r6_c7=='NA'?-1:($request->r6_c7==null?-9:$request->r6_c7));
      $stock_management->r6c8 = $request->r6_c8=='NA'?-1:($request->r6_c8==null?-9:$request->r6_c8);
      $stock_management->r6c9 = $request->r6_c9=='NA'?-1:($request->r6_c9==null?-9:$request->r6_c9);
      $stock_management->r6c10 = $request->r6_c10=='NA'?-1:($request->r6_c10==null?-9:$request->r6_c10);
      $stock_management->r6c11 = $request->r6_c11=='NA'?-1:($request->r6_c11=='NR'?-2:($request->r6_c11==null?-9:$request->r6_c11));
      $stock_management->r6c12 = $request->r6_c12=='NA'?-1:($request->r6_c12=='NR'?-2:($request->r6_c12==null?-9:$request->r6_c12));
      $stock_management->r6c13 = $request->r6_c13=='NA'?-1:($request->r6_c13=='NR'?-2:($request->r6_c13==null?-9:$request->r6_c13));
      $stock_management->r6c14 = $request->r6_c14=='NA'?-1:($request->r6_c14==null?-9:$request->r6_c14);
      $stock_management->r6c15 = $request->r6_c15=='NA'?-1:($request->r6_c15==null?-9:$request->r6_c15);
      $stock_management->r6c16 = $request->r6_c16=='NA'?-1:($request->r6_c16=='NR'?-2:($request->r6_c16==null?-9:$request->r6_c16));
      $stock_management->r6c17 = $request->r6_c17=='NA'?-1:($request->r6_c17=='NR'?-2:($request->r6_c17==null?-9:$request->r6_c17));
      $stock_management->r6c18 = $request->r6_c18=='NA'?-1:($request->r6_c18==null?-9:$request->r6_c18);
      $stock_management->r6c19 = $request->r6_c19=='NA'?-1:($request->r6_c19==null?-9:$request->r6_c19);
      $stock_management->r6c20 = $request->r6_c20=='NA'?-1:($request->r6_c20==null?-9:$request->r6_c20);
      $stock_management->r6c21 = $request->r6_c21=='NA'?-1:($request->r6_c21=='NR'?-2:($request->r6_c21==null?-9:$request->r6_c21));
      $stock_management->r6c22 = $request->r6_c22=='NA'?-1:($request->r6_c22=='PS'?-4:($request->r6_c22=='NR'?-2:($request->r6_c22==null?-9:$request->r6_c22)));


      $stock_management->r7c1 = $request->r7_c1=='NA'?-1:($request->r7_c1==null?-9:$request->r7_c1);
      $stock_management->r7c2 = $request->r7_c2=='NA'?-1:($request->r7_c2=='E'?-3:($request->r7_c2==null?-9:$request->r7_c2));
      $stock_management->r7c3 = $request->r7_c3=='NA'?-1:($request->r7_c3==null?-9:$request->r7_c3);
      $stock_management->r7c4 = $request->r7_c4=='NA'?-1:($request->r7_c4==null?-9:$request->r7_c4);
      $stock_management->r7c5 = $request->r7_c5=='NA'?-1:($request->r7_c5==null?-9:$request->r7_c5);
      $stock_management->r7c6 = $request->r7_c6=='NA'?-1:($request->r7_c6==null?-9:$request->r7_c6);
      $stock_management->r7c7 = ($request->r7_c7=='NA'?-1:($request->r7_c7==null?-9:$request->r7_c7));
      $stock_management->r7c8 = $request->r7_c8=='NA'?-1:($request->r7_c8==null?-9:$request->r7_c8);
      $stock_management->r7c9 = $request->r7_c9=='NA'?-1:($request->r7_c9==null?-9:$request->r7_c9);
      $stock_management->r7c10 = $request->r7_c10=='NA'?-1:($request->r7_c10==null?-9:$request->r7_c10);
      $stock_management->r7c11 = $request->r7_c11=='NA'?-1:($request->r7_c11=='NR'?-2:($request->r7_c11==null?-9:$request->r7_c11));
      $stock_management->r7c12 = $request->r7_c12=='NA'?-1:($request->r7_c12=='NR'?-2:($request->r7_c12==null?-9:$request->r7_c12));
      $stock_management->r7c13 = $request->r7_c13=='NA'?-1:($request->r7_c13=='NR'?-2:($request->r7_c13==null?-9:$request->r7_c13));
      $stock_management->r7c14 = $request->r7_c14=='NA'?-1:($request->r7_c14==null?-9:$request->r7_c14);
      $stock_management->r7c15 = $request->r7_c15=='NA'?-1:($request->r7_c15==null?-9:$request->r7_c15);
      $stock_management->r7c16 = $request->r7_c16=='NA'?-1:($request->r7_c16=='NR'?-2:($request->r7_c16==null?-9:$request->r7_c16));
      $stock_management->r7c17 = $request->r7_c17=='NA'?-1:($request->r7_c17=='NR'?-2:($request->r7_c17==null?-9:$request->r7_c17));
      $stock_management->r7c18 = $request->r7_c18=='NA'?-1:($request->r7_c18==null?-9:$request->r7_c18);
      $stock_management->r7c19 = $request->r7_c19=='NA'?-1:($request->r7_c19==null?-9:$request->r7_c19);
      $stock_management->r7c20 = $request->r7_c20=='NA'?-1:($request->r7_c20==null?-9:$request->r7_c20);
      $stock_management->r7c21 = $request->r7_c21=='NA'?-1:($request->r7_c21=='NR'?-2:($request->r7_c21==null?-9:$request->r7_c21));
      $stock_management->r7c22 = $request->r7_c22=='NA'?-1:($request->r7_c22=='PS'?-4:($request->r7_c22=='NR'?-2:($request->r7_c22==null?-9:$request->r7_c22)));


      $stock_management->r8c1 = $request->r8_c1=='NA'?-1:($request->r8_c1==null?-9:$request->r8_c1);
      $stock_management->r8c2 = $request->r8_c2=='NA'?-1:($request->r8_c2=='E'?-3:($request->r8_c2==null?-9:$request->r8_c2));
      $stock_management->r8c3 = $request->r8_c3=='NA'?-1:($request->r8_c3==null?-9:$request->r8_c3);
      $stock_management->r8c4 = $request->r8_c4=='NA'?-1:($request->r8_c4==null?-9:$request->r8_c4);
      $stock_management->r8c5 = $request->r8_c5=='NA'?-1:($request->r8_c5==null?-9:$request->r8_c5);
      $stock_management->r8c6 = $request->r8_c6=='NA'?-1:($request->r8_c6==null?-9:$request->r8_c6);
      $stock_management->r8c7 = ($request->r8_c7=='NA'?-1:($request->r8_c7==null?-9:$request->r8_c7));
      $stock_management->r8c8 = $request->r8_c8=='NA'?-1:($request->r8_c8==null?-9:$request->r8_c8);
      $stock_management->r8c9 = $request->r8_c9=='NA'?-1:($request->r8_c9==null?-9:$request->r8_c9);
      $stock_management->r8c10 = $request->r8_c10=='NA'?-1:($request->r8_c10==null?-9:$request->r8_c10);
      $stock_management->r8c11 = $request->r8_c11=='NA'?-1:($request->r8_c11=='NR'?-2:($request->r8_c11==null?-9:$request->r8_c11));
      $stock_management->r8c12 = $request->r8_c12=='NA'?-1:($request->r8_c12=='NR'?-2:($request->r8_c12==null?-9:$request->r8_c12));
      $stock_management->r8c13 = $request->r8_c13=='NA'?-1:($request->r8_c13=='NR'?-2:($request->r8_c13==null?-9:$request->r8_c13));
      $stock_management->r8c14 = $request->r8_c14=='NA'?-1:($request->r8_c14==null?-9:$request->r8_c14);
      $stock_management->r8c15 = $request->r8_c15=='NA'?-1:($request->r8_c15==null?-9:$request->r8_c15);
      $stock_management->r8c16 = $request->r8_c16=='NA'?-1:($request->r8_c16=='NR'?-2:($request->r8_c16==null?-9:$request->r8_c16));
      $stock_management->r8c17 = $request->r8_c17=='NA'?-1:($request->r8_c17=='NR'?-2:($request->r8_c17==null?-9:$request->r8_c17));
      $stock_management->r8c18 = $request->r8_c18=='NA'?-1:($request->r8_c18==null?-9:$request->r8_c18);
      $stock_management->r8c19 = $request->r8_c19=='NA'?-1:($request->r8_c19==null?-9:$request->r8_c19);
      $stock_management->r8c20 = $request->r8_c20=='NA'?-1:($request->r8_c20==null?-9:$request->r8_c20);
      $stock_management->r8c21 = $request->r8_c21=='NA'?-1:($request->r8_c21=='NR'?-2:($request->r8_c21==null?-9:$request->r8_c21));
      $stock_management->r8c22 = $request->r8_c22=='NA'?-1:($request->r8_c22=='PS'?-4:($request->r8_c22=='NR'?-2:($request->r8_c22==null?-9:$request->r8_c22)));


      $stock_management->r9c1 = $request->r9_c1=='NA'?-1:($request->r9_c1==null?-9:$request->r9_c1);
      $stock_management->r9c2 = $request->r9_c2=='NA'?-1:($request->r9_c2=='E'?-3:($request->r9_c2==null?-9:$request->r9_c2));
      $stock_management->r9c3 = $request->r9_c3=='NA'?-1:($request->r9_c3==null?-9:$request->r9_c3);
      $stock_management->r9c4 = $request->r9_c4=='NA'?-1:($request->r9_c4==null?-9:$request->r9_c4);
      $stock_management->r9c5 = $request->r9_c5=='NA'?-1:($request->r9_c5==null?-9:$request->r9_c5);
      $stock_management->r9c6 = $request->r9_c6=='NA'?-1:($request->r9_c6==null?-9:$request->r9_c6);
      $stock_management->r9c7 = ($request->r9_c7=='NA'?-1:($request->r9_c7==null?-9:$request->r9_c7));
      $stock_management->r9c8 = $request->r9_c8=='NA'?-1:($request->r9_c8==null?-9:$request->r9_c8);
      $stock_management->r9c9 = $request->r9_c9=='NA'?-1:($request->r9_c9==null?-9:$request->r9_c9);
      $stock_management->r9c10 = $request->r9_c10=='NA'?-1:($request->r9_c10==null?-9:$request->r9_c10);
      $stock_management->r9c11 = $request->r9_c11=='NA'?-1:($request->r9_c11=='NR'?-2:($request->r9_c11==null?-9:$request->r9_c11));
      $stock_management->r9c12 = $request->r9_c12=='NA'?-1:($request->r9_c12=='NR'?-2:($request->r9_c12==null?-9:$request->r9_c12));
      $stock_management->r9c13 = $request->r9_c13=='NA'?-1:($request->r9_c13=='NR'?-2:($request->r9_c13==null?-9:$request->r9_c13));
      $stock_management->r9c14 = $request->r9_c14=='NA'?-1:($request->r9_c14==null?-9:$request->r9_c14);
      $stock_management->r9c15 = $request->r9_c15=='NA'?-1:($request->r9_c15==null?-9:$request->r9_c15);
      $stock_management->r9c16 = $request->r9_c16=='NA'?-1:($request->r9_c16=='NR'?-2:($request->r9_c16==null?-9:$request->r9_c16));
      $stock_management->r9c17 = $request->r9_c17=='NA'?-1:($request->r9_c17=='NR'?-2:($request->r9_c17==null?-9:$request->r9_c17));
      $stock_management->r9c18 = $request->r9_c18=='NA'?-1:($request->r9_c18==null?-9:$request->r9_c18);
      $stock_management->r9c19 = $request->r9_c19=='NA'?-1:($request->r9_c19==null?-9:$request->r9_c19);
      $stock_management->r9c20 = $request->r9_c20=='NA'?-1:($request->r9_c20==null?-9:$request->r9_c20);
      $stock_management->r9c21 = $request->r9_c21=='NA'?-1:($request->r9_c21=='NR'?-2:($request->r9_c21==null?-9:$request->r9_c21));
      $stock_management->r9c22 = $request->r9_c22=='NA'?-1:($request->r9_c22=='PS'?-4:($request->r9_c22=='NR'?-2:($request->r9_c22==null?-9:$request->r9_c22)));

      $stock_management->stock_management_comments  = $request->stock_management_comments;

      $stock_management->health_facility_id = $request->facility_id;
      $stock_management->survey_summary_id = $summary->id;
      $stock_management->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
      $stock_management->form_id = $request->form_id;
      $stock_management->created_by = Auth::user()->id;
      $stock_management->updated_by = Auth::user()->id;
      $stock_management->upload_status = 0;

      $stock_management_response = $stock_management->save();

    }
    else
    {

      //save stock management
      $stock_management = StockManagement::where('form_id',$request->form_id)->first();

      $stock_management->r1c1 = $request->r1_c1=='NA'?-1:($request->r1_c1==null?-9:$request->r1_c1);
      $stock_management->r1c2 = $request->r1_c2=='NA'?-1:($request->r1_c2=='E'?-3:($request->r1_c2==null?-9:$request->r1_c2));
      $stock_management->r1c3 = $request->r1_c3=='NA'?-1:($request->r1_c3==null?-9:$request->r1_c3);
      $stock_management->r1c4 = $request->r1_c4=='NA'?-1:($request->r1_c4==null?-9:$request->r1_c4);
      $stock_management->r1c5 = $request->r1_c5=='NA'?-1:($request->r1_c5==null?-9:$request->r1_c5);
      $stock_management->r1c6 = $request->r1_c6=='NA'?-1:($request->r1_c6==null?-9:$request->r1_c6);
      $stock_management->r1c7 = ($request->r1_c7=='NA'?-1:($request->r1_c7==null?-9:$request->r1_c7));
      $stock_management->r1c8 = $request->r1_c8=='NA'?-1:($request->r1_c8==null?-9:$request->r1_c8);
      $stock_management->r1c9 = $request->r1_c9=='NA'?-1:($request->r1_c9==null?-9:$request->r1_c9);
      $stock_management->r1c10 = $request->r1_c10=='NA'?-1:($request->r1_c10==null?-9:$request->r1_c10);
      $stock_management->r1c11 = $request->r1_c11=='NA'?-1:($request->r1_c11=='NR'?-2:($request->r1_c11==null?-9:$request->r1_c11));
      $stock_management->r1c12 = $request->r1_c12=='NA'?-1:($request->r1_c12=='NR'?-2:($request->r1_c12==null?-9:$request->r1_c12));
      $stock_management->r1c13 = $request->r1_c13=='NA'?-1:($request->r1_c13=='NR'?-2:($request->r1_c13==null?-9:$request->r1_c13));
      $stock_management->r1c14 = $request->r1_c14=='NA'?-1:($request->r1_c14==null?-9:$request->r1_c14);
      $stock_management->r1c15 = $request->r1_c15=='NA'?-1:($request->r1_c15==null?-9:$request->r1_c15);
      $stock_management->r1c16 = $request->r1_c16=='NA'?-1:($request->r1_c16=='NR'?-2:($request->r1_c16==null?-9:$request->r1_c16));
      $stock_management->r1c17 = $request->r1_c17=='NA'?-1:($request->r1_c17=='NR'?-2:($request->r1_c17==null?-9:$request->r1_c17));
      $stock_management->r1c18 = $request->r1_c18=='NA'?-1:($request->r1_c18==null?-9:$request->r1_c18);
      $stock_management->r1c19 = $request->r1_c19=='NA'?-1:($request->r1_c19==null?-9:$request->r1_c19);
      $stock_management->r1c20 = $request->r1_c20=='NA'?-1:($request->r1_c20==null?-9:$request->r1_c20);
      $stock_management->r1c21 = $request->r1_c21=='NA'?-1:($request->r1_c21=='NR'?-2:($request->r1_c21==null?-9:$request->r1_c21));
      $stock_management->r1c22 = $request->r1_c22=='NA'?-1:($request->r1_c22=='PS'?-4:($request->r1_c22=='NR'?-2:($request->r1_c22==null?-9:$request->r1_c22)));


      $stock_management->r2c2_cd4item = $request->cd4_testing;
      $stock_management->r2c1 = $request->r2_c1=='NA'?-1:($request->r2_c1==null?-9:$request->r2_c1);
      $stock_management->r2c2 = $request->r2_c2=='NA'?-1:($request->r2_c2=='E'?-3:($request->r2_c2==null?-9:$request->r2_c2));
      $stock_management->r2c3 = $request->r2_c3=='NA'?-1:($request->r2_c3==null?-9:$request->r2_c3);
      $stock_management->r2c4 = $request->r2_c4=='NA'?-1:($request->r2_c4==null?-9:$request->r2_c4);
      $stock_management->r2c5 = $request->r2_c5=='NA'?-1:($request->r2_c5==null?-9:$request->r2_c5);
      $stock_management->r2c6 = $request->r2_c6=='NA'?-1:($request->r2_c6==null?-9:$request->r2_c6);
      $stock_management->r2c7 = ($request->r2_c7=='NA'?-1:($request->r2_c7==null?-9:$request->r2_c7));
      $stock_management->r2c8 = $request->r2_c8=='NA'?-1:($request->r2_c8==null?-9:$request->r2_c8);
      $stock_management->r2c9 = $request->r2_c9=='NA'?-1:($request->r2_c9==null?-9:$request->r2_c9);
      $stock_management->r2c10 = $request->r2_c10=='NA'?-1:($request->r2_c10==null?-9:$request->r2_c10);
      $stock_management->r2c11 = $request->r2_c11=='NA'?-1:($request->r2_c11=='NR'?-2:($request->r2_c11==null?-9:$request->r2_c11));
      $stock_management->r2c12 = $request->r2_c12=='NA'?-1:($request->r2_c12=='NR'?-2:($request->r2_c12==null?-9:$request->r2_c12));
      $stock_management->r2c13 = $request->r2_c13=='NA'?-1:($request->r2_c13=='NR'?-2:($request->r2_c13==null?-9:$request->r2_c13));
      $stock_management->r2c14 = $request->r2_c14=='NA'?-1:($request->r2_c14==null?-9:$request->r2_c14);
      $stock_management->r2c15 = $request->r2_c15=='NA'?-1:($request->r2_c15==null?-9:$request->r2_c15);
      $stock_management->r2c16 = $request->r2_c16=='NA'?-1:($request->r2_c16=='NR'?-2:($request->r2_c16==null?-9:$request->r2_c16));
      $stock_management->r2c17 = $request->r2_c17=='NA'?-1:($request->r2_c17=='NR'?-2:($request->r2_c17==null?-9:$request->r2_c17));
      $stock_management->r2c18 = $request->r2_c18=='NA'?-1:($request->r2_c18==null?-9:$request->r2_c18);
      $stock_management->r2c19 = $request->r2_c19=='NA'?-1:($request->r2_c19==null?-9:$request->r2_c19);
      $stock_management->r2c20 = $request->r2_c20=='NA'?-1:($request->r2_c20==null?-9:$request->r2_c20);
      $stock_management->r2c21 = $request->r2_c21=='NA'?-1:($request->r2_c21=='NR'?-2:($request->r2_c21==null?-9:$request->r2_c21));
      $stock_management->r2c22 = $request->r2_c22=='NA'?-1:($request->r2_c22=='PS'?-4:($request->r2_c22=='NR'?-2:($request->r2_c22==null?-9:$request->r2_c22)));

      $stock_management->r3c1 = $request->r3_c1=='NA'?-1:($request->r3_c1==null?-9:$request->r3_c1);
      $stock_management->r3c2 = $request->r3_c2=='NA'?-1:($request->r3_c2=='E'?-3:($request->r3_c2==null?-9:$request->r3_c2));
      $stock_management->r3c3 = $request->r3_c3=='NA'?-1:($request->r3_c3==null?-9:$request->r3_c3);
      $stock_management->r3c4 = $request->r3_c4=='NA'?-1:($request->r3_c4==null?-9:$request->r3_c4);
      $stock_management->r3c5 = $request->r3_c5=='NA'?-1:($request->r3_c5==null?-9:$request->r3_c5);
      $stock_management->r3c6 = $request->r3_c6=='NA'?-1:($request->r3_c6==null?-9:$request->r3_c6);
      $stock_management->r3c7 = ($request->r3_c7=='NA'?-1:($request->r3_c7==null?-9:$request->r3_c7));
      $stock_management->r3c8 = $request->r3_c8=='NA'?-1:($request->r3_c8==null?-9:$request->r3_c8);
      $stock_management->r3c9 = $request->r3_c9=='NA'?-1:($request->r3_c9==null?-9:$request->r3_c9);
      $stock_management->r3c10 = $request->r3_c10=='NA'?-1:($request->r3_c10==null?-9:$request->r3_c10);
      $stock_management->r3c11 = $request->r3_c11=='NA'?-1:($request->r3_c11=='NR'?-2:($request->r3_c11==null?-9:$request->r3_c11));
      $stock_management->r3c12 = $request->r3_c12=='NA'?-1:($request->r3_c12=='NR'?-2:($request->r3_c12==null?-9:$request->r3_c12));
      $stock_management->r3c13 = $request->r3_c13=='NA'?-1:($request->r3_c13=='NR'?-2:($request->r3_c13==null?-9:$request->r3_c13));
      $stock_management->r3c14 = $request->r3_c14=='NA'?-1:($request->r3_c14==null?-9:$request->r3_c14);
      $stock_management->r3c15 = $request->r3_c15=='NA'?-1:($request->r3_c15==null?-9:$request->r3_c15);
      $stock_management->r3c16 = $request->r3_c16=='NA'?-1:($request->r3_c16=='NR'?-2:($request->r3_c16==null?-9:$request->r3_c16));
      $stock_management->r3c17 = $request->r3_c17=='NA'?-1:($request->r3_c17=='NR'?-2:($request->r3_c17==null?-9:$request->r3_c17));
      $stock_management->r3c18 = $request->r3_c18=='NA'?-1:($request->r3_c18==null?-9:$request->r3_c18);
      $stock_management->r3c19 = $request->r3_c19=='NA'?-1:($request->r3_c19==null?-9:$request->r3_c19);
      $stock_management->r3c20 = $request->r3_c20=='NA'?-1:($request->r3_c20==null?-9:$request->r3_c20);
      $stock_management->r3c21 = $request->r3_c21=='NA'?-1:($request->r3_c21=='NR'?-2:($request->r3_c21==null?-9:$request->r3_c21));
      $stock_management->r3c22 = $request->r3_c22=='NA'?-1:($request->r3_c22=='PS'?-4:($request->r3_c22=='NR'?-2:($request->r3_c22==null?-9:$request->r3_c22)));


      $stock_management->r4c1 = $request->r4_c1=='NA'?-1:($request->r4_c1==null?-9:$request->r4_c1);
      $stock_management->r4c2 = $request->r4_c2=='NA'?-1:($request->r4_c2=='E'?-3:($request->r4_c2==null?-9:$request->r4_c2));
      $stock_management->r4c3 = $request->r4_c3=='NA'?-1:($request->r4_c3==null?-9:$request->r4_c3);
      $stock_management->r4c4 = $request->r4_c4=='NA'?-1:($request->r4_c4==null?-9:$request->r4_c4);
      $stock_management->r4c5 = $request->r4_c5=='NA'?-1:($request->r4_c5==null?-9:$request->r4_c5);
      $stock_management->r4c6 = $request->r4_c6=='NA'?-1:($request->r4_c6==null?-9:$request->r4_c6);
      $stock_management->r4c7 = ($request->r4_c7=='NA'?-1:($request->r4_c7==null?-9:$request->r4_c7));
      $stock_management->r4c8 = $request->r4_c8=='NA'?-1:($request->r4_c8==null?-9:$request->r4_c8);
      $stock_management->r4c9 = $request->r4_c9=='NA'?-1:($request->r4_c9==null?-9:$request->r4_c9);
      $stock_management->r4c10 = $request->r4_c10=='NA'?-1:($request->r4_c10==null?-9:$request->r4_c10);
      $stock_management->r4c11 = $request->r4_c11=='NA'?-1:($request->r4_c11=='NR'?-2:($request->r4_c11==null?-9:$request->r4_c11));
      $stock_management->r4c12 = $request->r4_c12=='NA'?-1:($request->r4_c12=='NR'?-2:($request->r4_c12==null?-9:$request->r4_c12));
      $stock_management->r4c13 = $request->r4_c13=='NA'?-1:($request->r4_c13=='NR'?-2:($request->r4_c13==null?-9:$request->r4_c13));
      $stock_management->r4c14 = $request->r4_c14=='NA'?-1:($request->r4_c14==null?-9:$request->r4_c14);
      $stock_management->r4c15 = $request->r4_c15=='NA'?-1:($request->r4_c15==null?-9:$request->r4_c15);
      $stock_management->r4c16 = $request->r4_c16=='NA'?-1:($request->r4_c16=='NR'?-2:($request->r4_c16==null?-9:$request->r4_c16));
      $stock_management->r4c17 = $request->r4_c17=='NA'?-1:($request->r4_c17=='NR'?-2:($request->r4_c17==null?-9:$request->r4_c17));
      $stock_management->r4c18 = $request->r4_c18=='NA'?-1:($request->r4_c18==null?-9:$request->r4_c18);
      $stock_management->r4c19 = $request->r4_c19=='NA'?-1:($request->r4_c19==null?-9:$request->r4_c19);
      $stock_management->r4c20 = $request->r4_c20=='NA'?-1:($request->r4_c20==null?-9:$request->r4_c20);
      $stock_management->r4c21 = $request->r4_c21=='NA'?-1:($request->r4_c21=='NR'?-2:($request->r4_c21==null?-9:$request->r4_c21));
      $stock_management->r4c22 = $request->r4_c22=='NA'?-1:($request->r4_c22=='PS'?-4:($request->r4_c22=='NR'?-2:($request->r4_c22==null?-9:$request->r4_c22)));


      $stock_management->r11c1 = $request->r3b_c1=='NA'?-1:($request->r3b_c1==null?-9:$request->r3b_c1);
      $stock_management->r11c2 = $request->r3b_c2=='NA'?-1:($request->r3b_c2=='E'?-3:($request->r3b_c2==null?-9:$request->r3b_c2));
      $stock_management->r11c3 = $request->r3b_c3=='NA'?-1:($request->r3b_c3==null?-9:$request->r3b_c3);
      $stock_management->r11c4 = $request->r3b_c4=='NA'?-1:($request->r3b_c4==null?-9:$request->r3b_c4);
      $stock_management->r11c5 = $request->r3b_c5=='NA'?-1:($request->r3b_c5==null?-9:$request->r3b_c5);
      $stock_management->r11c6 = $request->r3b_c6=='NA'?-1:($request->r3b_c6==null?-9:$request->r3b_c6);
      $stock_management->r11c7 = ($request->r3b_c7=='NA'?-1:($request->r3b_c7==null?-9:$request->r3b_c7));
      $stock_management->r11c8 = $request->r3b_c8=='NA'?-1:($request->r3b_c8==null?-9:$request->r3b_c8);
      $stock_management->r11c9 = $request->r3b_c9=='NA'?-1:($request->r3b_c9==null?-9:$request->r3b_c9);
      $stock_management->r11c10 = $request->r3b_c10=='NA'?-1:($request->r3b_c10==null?-9:$request->r3b_c10);
      $stock_management->r11c11 = $request->r3b_c11=='NA'?-1:($request->r3b_c11=='NR'?-2:($request->r3b_c11==null?-9:$request->r3b_c11));
      $stock_management->r11c12 = $request->r3b_c12=='NA'?-1:($request->r3b_c12=='NR'?-2:($request->r3b_c12==null?-9:$request->r3b_c12));
      $stock_management->r11c13 = $request->r3b_c13=='NA'?-1:($request->r3b_c13=='NR'?-2:($request->r3b_c13==null?-9:$request->r3b_c13));
      $stock_management->r11c14 = $request->r3b_c14=='NA'?-1:($request->r3b_c14==null?-9:$request->r3b_c14);
      $stock_management->r11c15 = $request->r3b_c15=='NA'?-1:($request->r3b_c15==null?-9:$request->r3b_c15);
      $stock_management->r11c16 = $request->r3b_c16=='NA'?-1:($request->r3b_c16=='NR'?-2:($request->r3b_c16==null?-9:$request->r3b_c16));
      $stock_management->r11c17 = $request->r3b_c17=='NA'?-1:($request->r3b_c17=='NR'?-2:($request->r3b_c17==null?-9:$request->r3b_c17));
      $stock_management->r11c18 = $request->r3b_c18=='NA'?-1:($request->r3b_c18==null?-9:$request->r3b_c18);
      $stock_management->r11c19 = $request->r3b_c19=='NA'?-1:($request->r3b_c19==null?-9:$request->r3b_c19);
      $stock_management->r11c20 = $request->r3b_c20=='NA'?-1:($request->r3b_c20==null?-9:$request->r3b_c20);
      $stock_management->r11c21 = $request->r3b_c21=='NA'?-1:($request->r3b_c21=='NR'?-2:($request->r3b_c21==null?-9:$request->r3b_c21));
      $stock_management->r11c22 = $request->r3b_c22=='NA'?-1:($request->r3b_c22=='PS'?-4:($request->r3b_c22=='NR'?-2:($request->r3b_c22==null?-9:$request->r3b_c22)));


      $stock_management->r10c1 = $request->r4b_c1=='NA'?-1:($request->r4b_c1==null?-9:$request->r4b_c1);
      $stock_management->r10c2 = $request->r4b_c2=='NA'?-1:($request->r4b_c2=='E'?-3:($request->r4b_c2==null?-9:$request->r4b_c2));
      $stock_management->r10c3 = $request->r4b_c3=='NA'?-1:($request->r4b_c3==null?-9:$request->r4b_c3);
      $stock_management->r10c4 = $request->r4b_c4=='NA'?-1:($request->r4b_c4==null?-9:$request->r4b_c4);
      $stock_management->r10c5 = $request->r4b_c5=='NA'?-1:($request->r4b_c5==null?-9:$request->r4b_c5);
      $stock_management->r10c6 = $request->r4b_c6=='NA'?-1:($request->r4b_c6==null?-9:$request->r4b_c6);
      $stock_management->r10c7 = ($request->r4b_c7=='NA'?-1:($request->r4b_c7==null?-9:$request->r4b_c7));
      $stock_management->r10c8 = $request->r4b_c8=='NA'?-1:($request->r4b_c8==null?-9:$request->r4b_c8);
      $stock_management->r10c9 = $request->r4b_c9=='NA'?-1:($request->r4b_c9==null?-9:$request->r4b_c9);
      $stock_management->r10c10 = $request->r4b_c10=='NA'?-1:($request->r4b_c10==null?-9:$request->r4b_c10);
      $stock_management->r10c11 = $request->r4b_c11=='NA'?-1:($request->r4b_c11=='NR'?-2:($request->r4b_c11==null?-9:$request->r4b_c11));
      $stock_management->r10c12 = $request->r4b_c12=='NA'?-1:($request->r4b_c12=='NR'?-2:($request->r4b_c12==null?-9:$request->r4b_c12));
      $stock_management->r10c13 = $request->r4b_c13=='NA'?-1:($request->r4b_c13=='NR'?-2:($request->r4b_c13==null?-9:$request->r4b_c13));
      $stock_management->r10c14 = $request->r4b_c14=='NA'?-1:($request->r4b_c14==null?-9:$request->r4b_c14);
      $stock_management->r10c15 = $request->r4b_c15=='NA'?-1:($request->r4b_c15==null?-9:$request->r4b_c15);
      $stock_management->r10c16 = $request->r4b_c16=='NA'?-1:($request->r4b_c16=='NR'?-2:($request->r4b_c16==null?-9:$request->r4b_c16));
      $stock_management->r10c17 = $request->r4b_c17=='NA'?-1:($request->r4b_c17=='NR'?-2:($request->r4b_c17==null?-9:$request->r4b_c17));
      $stock_management->r10c18 = $request->r4b_c18=='NA'?-1:($request->r4b_c18==null?-9:$request->r4b_c18);
      $stock_management->r10c19 = $request->r4b_c19=='NA'?-1:($request->r4b_c19==null?-9:$request->r4b_c19);
      $stock_management->r10c20 = $request->r4b_c20=='NA'?-1:($request->r4b_c20==null?-9:$request->r4b_c20);
      $stock_management->r10c21 = $request->r4b_c21=='NA'?-1:($request->r4b_c21=='NR'?-2:($request->r4b_c21==null?-9:$request->r4b_c21));
      $stock_management->r10c22 = $request->r4b_c22=='NA'?-1:($request->r4b_c22=='PS'?-4:($request->r4b_c22=='NR'?-2:($request->r4b_c22==null?-9:$request->r4b_c22)));


      $stock_management->r5c1 = $request->r5_c1=='NA'?-1:($request->r5_c1==null?-9:$request->r5_c1);
      $stock_management->r5c2 = $request->r5_c2=='NA'?-1:($request->r5_c2=='E'?-3:($request->r5_c2==null?-9:$request->r5_c2));
      $stock_management->r5c3 = $request->r5_c3=='NA'?-1:($request->r5_c3==null?-9:$request->r5_c3);
      $stock_management->r5c4 = $request->r5_c4=='NA'?-1:($request->r5_c4==null?-9:$request->r5_c4);
      $stock_management->r5c5 = $request->r5_c5=='NA'?-1:($request->r5_c5==null?-9:$request->r5_c5);
      $stock_management->r5c6 = $request->r5_c6=='NA'?-1:($request->r5_c6==null?-9:$request->r5_c6);
      $stock_management->r5c7 = ($request->r5_c7=='NA'?-1:($request->r5_c7==null?-9:$request->r5_c7));
      $stock_management->r5c8 = $request->r5_c8=='NA'?-1:($request->r5_c8==null?-9:$request->r5_c8);
      $stock_management->r5c9 = $request->r5_c9=='NA'?-1:($request->r5_c9==null?-9:$request->r5_c9);
      $stock_management->r5c10 = $request->r5_c10=='NA'?-1:($request->r5_c10==null?-9:$request->r5_c10);
      $stock_management->r5c11 = $request->r5_c11=='NA'?-1:($request->r5_c11=='NR'?-2:($request->r5_c11==null?-9:$request->r5_c11));
      $stock_management->r5c12 = $request->r5_c12=='NA'?-1:($request->r5_c12=='NR'?-2:($request->r5_c12==null?-9:$request->r5_c12));
      $stock_management->r5c13 = $request->r5_c13=='NA'?-1:($request->r5_c13=='NR'?-2:($request->r5_c13==null?-9:$request->r5_c13));
      $stock_management->r5c14 = $request->r5_c14=='NA'?-1:($request->r5_c14==null?-9:$request->r5_c14);
      $stock_management->r5c15 = $request->r5_c15=='NA'?-1:($request->r5_c15==null?-9:$request->r5_c15);
      $stock_management->r5c16 = $request->r5_c16=='NA'?-1:($request->r5_c16=='NR'?-2:($request->r5_c16==null?-9:$request->r5_c16));
      $stock_management->r5c17 = $request->r5_c17=='NA'?-1:($request->r5_c17=='NR'?-2:($request->r5_c17==null?-9:$request->r5_c17));
      $stock_management->r5c18 = $request->r5_c18=='NA'?-1:($request->r5_c18==null?-9:$request->r5_c18);
      $stock_management->r5c19 = $request->r5_c19=='NA'?-1:($request->r5_c19==null?-9:$request->r5_c19);
      $stock_management->r5c20 = $request->r5_c20=='NA'?-1:($request->r5_c20==null?-9:$request->r5_c20);
      $stock_management->r5c21 = $request->r5_c21=='NA'?-1:($request->r5_c21=='NR'?-2:($request->r5_c21==null?-9:$request->r5_c21));
      $stock_management->r5c22 = $request->r5_c22=='NA'?-1:($request->r5_c22=='PS'?-4:($request->r5_c22=='NR'?-2:($request->r5_c22==null?-9:$request->r5_c22)));


      $stock_management->r6c1 = $request->r6_c1=='NA'?-1:($request->r6_c1==null?-9:$request->r6_c1);
      $stock_management->r6c2 = $request->r6_c2=='NA'?-1:($request->r6_c2=='E'?-3:($request->r6_c2==null?-9:$request->r6_c2));
      $stock_management->r6c3 = $request->r6_c3=='NA'?-1:($request->r6_c3==null?-9:$request->r6_c3);
      $stock_management->r6c4 = $request->r6_c4=='NA'?-1:($request->r6_c4==null?-9:$request->r6_c4);
      $stock_management->r6c5 = $request->r6_c5=='NA'?-1:($request->r6_c5==null?-9:$request->r6_c5);
      $stock_management->r6c6 = $request->r6_c6=='NA'?-1:($request->r6_c6==null?-9:$request->r6_c6);
      $stock_management->r6c7 = ($request->r6_c7=='NA'?-1:($request->r6_c7==null?-9:$request->r6_c7));
      $stock_management->r6c8 = $request->r6_c8=='NA'?-1:($request->r6_c8==null?-9:$request->r6_c8);
      $stock_management->r6c9 = $request->r6_c9=='NA'?-1:($request->r6_c9==null?-9:$request->r6_c9);
      $stock_management->r6c10 = $request->r6_c10=='NA'?-1:($request->r6_c10==null?-9:$request->r6_c10);
      $stock_management->r6c11 = $request->r6_c11=='NA'?-1:($request->r6_c11=='NR'?-2:($request->r6_c11==null?-9:$request->r6_c11));
      $stock_management->r6c12 = $request->r6_c12=='NA'?-1:($request->r6_c12=='NR'?-2:($request->r6_c12==null?-9:$request->r6_c12));
      $stock_management->r6c13 = $request->r6_c13=='NA'?-1:($request->r6_c13=='NR'?-2:($request->r6_c13==null?-9:$request->r6_c13));
      $stock_management->r6c14 = $request->r6_c14=='NA'?-1:($request->r6_c14==null?-9:$request->r6_c14);
      $stock_management->r6c15 = $request->r6_c15=='NA'?-1:($request->r6_c15==null?-9:$request->r6_c15);
      $stock_management->r6c16 = $request->r6_c16=='NA'?-1:($request->r6_c16=='NR'?-2:($request->r6_c16==null?-9:$request->r6_c16));
      $stock_management->r6c17 = $request->r6_c17=='NA'?-1:($request->r6_c17=='NR'?-2:($request->r6_c17==null?-9:$request->r6_c17));
      $stock_management->r6c18 = $request->r6_c18=='NA'?-1:($request->r6_c18==null?-9:$request->r6_c18);
      $stock_management->r6c19 = $request->r6_c19=='NA'?-1:($request->r6_c19==null?-9:$request->r6_c19);
      $stock_management->r6c20 = $request->r6_c20=='NA'?-1:($request->r6_c20==null?-9:$request->r6_c20);
      $stock_management->r6c21 = $request->r6_c21=='NA'?-1:($request->r6_c21=='NR'?-2:($request->r6_c21==null?-9:$request->r6_c21));
      $stock_management->r6c22 = $request->r6_c22=='NA'?-1:($request->r6_c22=='PS'?-4:($request->r6_c22=='NR'?-2:($request->r6_c22==null?-9:$request->r6_c22)));


      $stock_management->r7c1 = $request->r7_c1=='NA'?-1:($request->r7_c1==null?-9:$request->r7_c1);
      $stock_management->r7c2 = $request->r7_c2=='NA'?-1:($request->r7_c2=='E'?-3:($request->r7_c2==null?-9:$request->r7_c2));
      $stock_management->r7c3 = $request->r7_c3=='NA'?-1:($request->r7_c3==null?-9:$request->r7_c3);
      $stock_management->r7c4 = $request->r7_c4=='NA'?-1:($request->r7_c4==null?-9:$request->r7_c4);
      $stock_management->r7c5 = $request->r7_c5=='NA'?-1:($request->r7_c5==null?-9:$request->r7_c5);
      $stock_management->r7c6 = $request->r7_c6=='NA'?-1:($request->r7_c6==null?-9:$request->r7_c6);
      $stock_management->r7c7 = ($request->r7_c7=='NA'?-1:($request->r7_c7==null?-9:$request->r7_c7));
      $stock_management->r7c8 = $request->r7_c8=='NA'?-1:($request->r7_c8==null?-9:$request->r7_c8);
      $stock_management->r7c9 = $request->r7_c9=='NA'?-1:($request->r7_c9==null?-9:$request->r7_c9);
      $stock_management->r7c10 = $request->r7_c10=='NA'?-1:($request->r7_c10==null?-9:$request->r7_c10);
      $stock_management->r7c11 = $request->r7_c11=='NA'?-1:($request->r7_c11=='NR'?-2:($request->r7_c11==null?-9:$request->r7_c11));
      $stock_management->r7c12 = $request->r7_c12=='NA'?-1:($request->r7_c12=='NR'?-2:($request->r7_c12==null?-9:$request->r7_c12));
      $stock_management->r7c13 = $request->r7_c13=='NA'?-1:($request->r7_c13=='NR'?-2:($request->r7_c13==null?-9:$request->r7_c13));
      $stock_management->r7c14 = $request->r7_c14=='NA'?-1:($request->r7_c14==null?-9:$request->r7_c14);
      $stock_management->r7c15 = $request->r7_c15=='NA'?-1:($request->r7_c15==null?-9:$request->r7_c15);
      $stock_management->r7c16 = $request->r7_c16=='NA'?-1:($request->r7_c16=='NR'?-2:($request->r7_c16==null?-9:$request->r7_c16));
      $stock_management->r7c17 = $request->r7_c17=='NA'?-1:($request->r7_c17=='NR'?-2:($request->r7_c17==null?-9:$request->r7_c17));
      $stock_management->r7c18 = $request->r7_c18=='NA'?-1:($request->r7_c18==null?-9:$request->r7_c18);
      $stock_management->r7c19 = $request->r7_c19=='NA'?-1:($request->r7_c19==null?-9:$request->r7_c19);
      $stock_management->r7c20 = $request->r7_c20=='NA'?-1:($request->r7_c20==null?-9:$request->r7_c20);
      $stock_management->r7c21 = $request->r7_c21=='NA'?-1:($request->r7_c21=='NR'?-2:($request->r7_c21==null?-9:$request->r7_c21));
      $stock_management->r7c22 = $request->r7_c22=='NA'?-1:($request->r7_c22=='PS'?-4:($request->r7_c22=='NR'?-2:($request->r7_c22==null?-9:$request->r7_c22)));


      $stock_management->r8c1 = $request->r8_c1=='NA'?-1:($request->r8_c1==null?-9:$request->r8_c1);
      $stock_management->r8c2 = $request->r8_c2=='NA'?-1:($request->r8_c2=='E'?-3:($request->r8_c2==null?-9:$request->r8_c2));
      $stock_management->r8c3 = $request->r8_c3=='NA'?-1:($request->r8_c3==null?-9:$request->r8_c3);
      $stock_management->r8c4 = $request->r8_c4=='NA'?-1:($request->r8_c4==null?-9:$request->r8_c4);
      $stock_management->r8c5 = $request->r8_c5=='NA'?-1:($request->r8_c5==null?-9:$request->r8_c5);
      $stock_management->r8c6 = $request->r8_c6=='NA'?-1:($request->r8_c6==null?-9:$request->r8_c6);
      $stock_management->r8c7 = ($request->r8_c7=='NA'?-1:($request->r8_c7==null?-9:$request->r8_c7));
      $stock_management->r8c8 = $request->r8_c8=='NA'?-1:($request->r8_c8==null?-9:$request->r8_c8);
      $stock_management->r8c9 = $request->r8_c9=='NA'?-1:($request->r8_c9==null?-9:$request->r8_c9);
      $stock_management->r8c10 = $request->r8_c10=='NA'?-1:($request->r8_c10==null?-9:$request->r8_c10);
      $stock_management->r8c11 = $request->r8_c11=='NA'?-1:($request->r8_c11=='NR'?-2:($request->r8_c11==null?-9:$request->r8_c11));
      $stock_management->r8c12 = $request->r8_c12=='NA'?-1:($request->r8_c12=='NR'?-2:($request->r8_c12==null?-9:$request->r8_c12));
      $stock_management->r8c13 = $request->r8_c13=='NA'?-1:($request->r8_c13=='NR'?-2:($request->r8_c13==null?-9:$request->r8_c13));
      $stock_management->r8c14 = $request->r8_c14=='NA'?-1:($request->r8_c14==null?-9:$request->r8_c14);
      $stock_management->r8c15 = $request->r8_c15=='NA'?-1:($request->r8_c15==null?-9:$request->r8_c15);
      $stock_management->r8c16 = $request->r8_c16=='NA'?-1:($request->r8_c16=='NR'?-2:($request->r8_c16==null?-9:$request->r8_c16));
      $stock_management->r8c17 = $request->r8_c17=='NA'?-1:($request->r8_c17=='NR'?-2:($request->r8_c17==null?-9:$request->r8_c17));
      $stock_management->r8c18 = $request->r8_c18=='NA'?-1:($request->r8_c18==null?-9:$request->r8_c18);
      $stock_management->r8c19 = $request->r8_c19=='NA'?-1:($request->r8_c19==null?-9:$request->r8_c19);
      $stock_management->r8c20 = $request->r8_c20=='NA'?-1:($request->r8_c20==null?-9:$request->r8_c20);
      $stock_management->r8c21 = $request->r8_c21=='NA'?-1:($request->r8_c21=='NR'?-2:($request->r8_c21==null?-9:$request->r8_c21));
      $stock_management->r8c22 = $request->r8_c22=='NA'?-1:($request->r8_c22=='PS'?-4:($request->r8_c22=='NR'?-2:($request->r8_c22==null?-9:$request->r8_c22)));


      $stock_management->r9c1 = $request->r9_c1=='NA'?-1:($request->r9_c1==null?-9:$request->r9_c1);
      $stock_management->r9c2 = $request->r9_c2=='NA'?-1:($request->r9_c2=='E'?-3:($request->r9_c2==null?-9:$request->r9_c2));
      $stock_management->r9c3 = $request->r9_c3=='NA'?-1:($request->r9_c3==null?-9:$request->r9_c3);
      $stock_management->r9c4 = $request->r9_c4=='NA'?-1:($request->r9_c4==null?-9:$request->r9_c4);
      $stock_management->r9c5 = $request->r9_c5=='NA'?-1:($request->r9_c5==null?-9:$request->r9_c5);
      $stock_management->r9c6 = $request->r9_c6=='NA'?-1:($request->r9_c6==null?-9:$request->r9_c6);
      $stock_management->r9c7 = ($request->r9_c7=='NA'?-1:($request->r9_c7==null?-9:$request->r9_c7));
      $stock_management->r9c8 = $request->r9_c8=='NA'?-1:($request->r9_c8==null?-9:$request->r9_c8);
      $stock_management->r9c9 = $request->r9_c9=='NA'?-1:($request->r9_c9==null?-9:$request->r9_c9);
      $stock_management->r9c10 = $request->r9_c10=='NA'?-1:($request->r9_c10==null?-9:$request->r9_c10);
      $stock_management->r9c11 = $request->r9_c11=='NA'?-1:($request->r9_c11=='NR'?-2:($request->r9_c11==null?-9:$request->r9_c11));
      $stock_management->r9c12 = $request->r9_c12=='NA'?-1:($request->r9_c12=='NR'?-2:($request->r9_c12==null?-9:$request->r9_c12));
      $stock_management->r9c13 = $request->r9_c13=='NA'?-1:($request->r9_c13=='NR'?-2:($request->r9_c13==null?-9:$request->r9_c13));
      $stock_management->r9c14 = $request->r9_c14=='NA'?-1:($request->r9_c14==null?-9:$request->r9_c14);
      $stock_management->r9c15 = $request->r9_c15=='NA'?-1:($request->r9_c15==null?-9:$request->r9_c15);
      $stock_management->r9c16 = $request->r9_c16=='NA'?-1:($request->r9_c16=='NR'?-2:($request->r9_c16==null?-9:$request->r9_c16));
      $stock_management->r9c17 = $request->r9_c17=='NA'?-1:($request->r9_c17=='NR'?-2:($request->r9_c17==null?-9:$request->r9_c17));
      $stock_management->r9c18 = $request->r9_c18=='NA'?-1:($request->r9_c18==null?-9:$request->r9_c18);
      $stock_management->r9c19 = $request->r9_c19=='NA'?-1:($request->r9_c19==null?-9:$request->r9_c19);
      $stock_management->r9c20 = $request->r9_c20=='NA'?-1:($request->r9_c20==null?-9:$request->r9_c20);
      $stock_management->r9c21 = $request->r9_c21=='NA'?-1:($request->r9_c21=='NR'?-2:($request->r9_c21==null?-9:$request->r9_c21));
      $stock_management->r9c22 = $request->r9_c22=='NA'?-1:($request->r9_c22=='PS'?-4:($request->r9_c22=='NR'?-2:($request->r9_c22==null?-9:$request->r9_c22)));

      $stock_management->stock_management_comments  = $request->stock_management_comments;

      $stock_management->health_facility_id = $request->facility_id;
      $stock_management->survey_summary_id = $summary->id;
      $stock_management->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
      $stock_management->form_id = $request->form_id;
      $stock_management->updated_by = Auth::user()->id;

      $stock_management_response = $stock_management->save();

    }

    $indicators = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();
    if($indicators == null )
    {

      //save indicator summary scores
      $indicator_score = new IndicatorScoreSummary;

      $indicator_score->indicator1_score = $request->indicator1_score;
      $indicator_score->indicator2_score = $request->indicator2_score;
      $indicator_score->indicator3_score = $request->indicator3_score;
      $indicator_score->indicator4_score = $request->indicator4_score;
      $indicator_score->indicator5_score = $request->indicator5_score;
      $indicator_score->indicator6_score = $request->indicator6_score;
      $indicator_score->indicator7_score = $request->indicator7_score;
      $indicator_score->indicator8_score = $request->indicator8_score;
      $indicator_score->indicator9_score = $request->indicator9_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->created_by = Auth::user()->id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->upload_status = 0;
      $indicator_score->save();
    }

    else
    {

      //save indicator summary scores
      $indicator_score = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();

      $indicator_score->indicator1_score = $request->indicator1_score;
      $indicator_score->indicator2_score = $request->indicator2_score;
      $indicator_score->indicator3_score = $request->indicator3_score;
      $indicator_score->indicator4_score = $request->indicator4_score;
      $indicator_score->indicator5_score = $request->indicator5_score;
      $indicator_score->indicator6_score = $request->indicator6_score;
      $indicator_score->indicator7_score = $request->indicator7_score;
      $indicator_score->indicator8_score = $request->indicator8_score;
      $indicator_score->indicator9_score = $request->indicator9_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->updated_by = Auth::user()->id;
      // $indicator_score->upload_status = 0;
      $indicator_score->save();

    }

    return response()->json([ 'stock_management' => $stock_management_response ]);

  }

  public function saveStorageManagement(Request $request)
  {

    $summary = SurveySummary::where('form_id','=',$request->form_id)->first();

    $summary->step = 2;
    $summary->save();

    $storage10_response = $storage11_response = $storage12_response = $storage13_response = $storage14_response = null;

    $exists_10 = StorageManagement10::where('form_id','=',$request->form_id)->first();


    if($exists_10==null)
    {
      //save storage management 10
      $storage10 = new StorageManagement10;

      $storage10->sub_indicator_10a = $request->storage_management_10a=='NA'?-1:$request->storage_management_10a;
      $storage10->sub_indicator_10b = $request->storage_management_10b=='NA'?-1:$request->storage_management_10b;
      $storage10->sub_indicator_10c = $request->storage_management_10c=='NA'?-1:$request->storage_management_10c;
      $storage10->sub_indicator_10d = $request->storage_management_10d=='NA'?-1:$request->storage_management_10d;

      $storage10->indicator_10_comments  = $request->storage_management_10_comments;

      $storage10->health_facility_id = $request->facility_id;
      $storage10->survey_summary_id = $summary->id;
      $storage10->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage10->form_id = $request->form_id;
      $storage10->created_by = Auth::user()->id;
      $storage10->upload_status = 0;
      $storage10_response = $storage10->save();
    }
    else
    {
      //save storage management 10
      $storage10 = StorageManagement10::where('form_id','=',$request->form_id)->first();

      $storage10->sub_indicator_10a = $request->storage_management_10a=='NA'?-1:$request->storage_management_10a;
      $storage10->sub_indicator_10b = $request->storage_management_10b=='NA'?-1:$request->storage_management_10b;
      $storage10->sub_indicator_10c = $request->storage_management_10c=='NA'?-1:$request->storage_management_10c;
      $storage10->sub_indicator_10d = $request->storage_management_10d=='NA'?-1:$request->storage_management_10d;

      $storage10->indicator_10_comments  = $request->storage_management_10_comments;

      $storage10->health_facility_id = $request->facility_id;
      $storage10->survey_summary_id = $summary->id;
      $storage10->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage10->updated_by = Auth::user()->id;
      $storage10_response = $storage10->save();
    }

    $exists_11 = StorageManagement11::where('form_id','=',$request->form_id)->first();

    if($exists_11==null)
    {

      //save storage management 11
      $storage11 = new StorageManagement11;

      $storage11->sub_indicator_11a = $request->storage_management_11a=='NA'?-1:$request->storage_management_11a;
      $storage11->sub_indicator_11b = $request->storage_management_11b=='NA'?-1:$request->storage_management_11b;
      $storage11->sub_indicator_11c = $request->storage_management_11c=='NA'?-1:$request->storage_management_11c;
      $storage11->sub_indicator_11d = $request->storage_management_11d=='NA'?-1:$request->storage_management_11d;
      $storage11->sub_indicator_11e = $request->storage_management_11e=='NA'?-1:$request->storage_management_11e;

      $storage11->indicator_11_comments  = $request->storage_management_11_comments;

      $storage11->health_facility_id = $request->facility_id;
      $storage11->survey_summary_id = $summary->id;
      $storage11->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage11->form_id = $request->form_id;
      $storage11->created_by = Auth::user()->id;
      $storage11->upload_status = 0;
      $storage11_response = $storage11->save();

    }

    else
    {
      //save storage management 11
      $storage11 = StorageManagement11::where('form_id','=',$request->form_id)->first();

      $storage11->sub_indicator_11a = $request->storage_management_11a=='NA'?-1:$request->storage_management_11a;
      $storage11->sub_indicator_11b = $request->storage_management_11b=='NA'?-1:$request->storage_management_11b;
      $storage11->sub_indicator_11c = $request->storage_management_11c=='NA'?-1:$request->storage_management_11c;
      $storage11->sub_indicator_11d = $request->storage_management_11d=='NA'?-1:$request->storage_management_11d;
      $storage11->sub_indicator_11e = $request->storage_management_11e=='NA'?-1:$request->storage_management_11e;

      $storage11->indicator_11_comments  = $request->storage_management_11_comments;

      $storage11->health_facility_id = $request->facility_id;
      $storage11->survey_summary_id = $summary->id;
      $storage11->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage11->form_id = $request->form_id;
      $storage11->updated_by = Auth::user()->id;
      $storage11_response = $storage11->save();
    }

    $exists_12 = StorageManagement12::where('form_id','=',$request->form_id)->first();

    if($exists_12==null)
    {
      //save storage management 12
      $storage12 = new StorageManagement12;

      $storage12->sub_indicator_12a_main_store = $request->storage_management_12a1=='NA'?-1:$request->storage_management_12a1;
      $storage12->sub_indicator_12b_main_store = $request->storage_management_12b1=='NA'?-1:$request->storage_management_12b1;
      $storage12->sub_indicator_12c_main_store = $request->storage_management_12c1=='NA'?-1:$request->storage_management_12c1;
      $storage12->sub_indicator_12d_main_store = $request->storage_management_12d1=='NA'?-1:$request->storage_management_12d1;
      $storage12->sub_indicator_12e_main_store = $request->storage_management_12e1=='NA'?-1:$request->storage_management_12e1;

      $storage12->sub_indicator_12a_lab_store  = $request->storage_management_12a2=='NA'?-1:$request->storage_management_12a2;
      $storage12->sub_indicator_12b_lab_store  = $request->storage_management_12b2=='NA'?-1:$request->storage_management_12b2;
      $storage12->sub_indicator_12c_lab_store  = $request->storage_management_12c2=='NA'?-1:$request->storage_management_12c2;
      $storage12->sub_indicator_12d_lab_store  = $request->storage_management_12d2=='NA'?-1:$request->storage_management_12d2;
      $storage12->sub_indicator_12e_lab_store  = $request->storage_management_12e2=='NA'?-1:$request->storage_management_12e2;
      $storage12->indicator_12_comments  = $request->storage_management_12_comments;

      $storage12->health_facility_id = $request->facility_id;
      $storage12->survey_summary_id = $summary->id;
      $storage12->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage12->form_id = $request->form_id;
      $storage12->created_by = Auth::user()->id;
      $storage12->upload_status = 0;
      $storage12_response = $storage12->save();

    }

    else
    {
      //save storage management 12
      $storage12 = StorageManagement12::where('form_id','=',$request->form_id)->first();

      $storage12->sub_indicator_12a_main_store = $request->storage_management_12a1=='NA'?-1:$request->storage_management_12a1;
      $storage12->sub_indicator_12b_main_store = $request->storage_management_12b1=='NA'?-1:$request->storage_management_12b1;
      $storage12->sub_indicator_12c_main_store = $request->storage_management_12c1=='NA'?-1:$request->storage_management_12c1;
      $storage12->sub_indicator_12d_main_store = $request->storage_management_12d1=='NA'?-1:$request->storage_management_12d1;
      $storage12->sub_indicator_12e_main_store = $request->storage_management_12e1=='NA'?-1:$request->storage_management_12e1;

      $storage12->sub_indicator_12a_lab_store  = $request->storage_management_12a2=='NA'?-1:$request->storage_management_12a2;
      $storage12->sub_indicator_12b_lab_store  = $request->storage_management_12b2=='NA'?-1:$request->storage_management_12b2;
      $storage12->sub_indicator_12c_lab_store  = $request->storage_management_12c2=='NA'?-1:$request->storage_management_12c2;
      $storage12->sub_indicator_12d_lab_store  = $request->storage_management_12d2=='NA'?-1:$request->storage_management_12d2;
      $storage12->sub_indicator_12e_lab_store  = $request->storage_management_12e2=='NA'?-1:$request->storage_management_12e2;
      $storage12->indicator_12_comments  = $request->storage_management_12_comments;

      $storage12->health_facility_id = $request->facility_id;
      $storage12->survey_summary_id = $summary->id;
      $storage12->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage12->form_id = $request->form_id;
      $storage12->updated_by = Auth::user()->id;
      $storage12_response = $storage12->save();

    }


    $exists_13 = StorageManagement13::where('form_id','=',$request->form_id)->first();

    if($exists_13==null)
    {

      //save storage management 13
      $storage13 = new StorageManagement13;

      $storage13->sub_indicator_13a_main_store = $request->storage_management_13a1=='NA'?-1:$request->storage_management_13a1;
      $storage13->sub_indicator_13b_main_store = $request->storage_management_13b1=='NA'?-1:$request->storage_management_13b1;
      $storage13->sub_indicator_13c_main_store = $request->storage_management_13c1=='NA'?-1:$request->storage_management_13c1;
      $storage13->sub_indicator_13d_main_store = $request->storage_management_13d1=='NA'?-1:$request->storage_management_13d1;
      $storage13->sub_indicator_13e_main_store = $request->storage_management_13e1=='NA'?-1:$request->storage_management_13e1;
      $storage13->sub_indicator_13f_main_store = $request->storage_management_13f1=='NA'?-1:$request->storage_management_13f1;
      $storage13->sub_indicator_13g_main_store = $request->storage_management_13g1=='NA'?-1:$request->storage_management_13g1;
      $storage13->sub_indicator_13h_main_store = $request->storage_management_13h1=='NA'?-1:$request->storage_management_13h1;
      $storage13->sub_indicator_13i_main_store = $request->storage_management_13i1=='NA'?-1:$request->storage_management_13i1;
      $storage13->sub_indicator_13j_main_store = $request->storage_management_13j1=='NA'?-1:$request->storage_management_13j1;
      $storage13->sub_indicator_13k_main_store = $request->storage_management_13k1=='NA'?-1:$request->storage_management_13k1;
      $storage13->sub_indicator_13l_main_store = $request->storage_management_13l1=='NA'?-1:$request->storage_management_13l1;

      $storage13->sub_indicator_13a_lab_store  = $request->storage_management_13a2=='NA'?-1:$request->storage_management_13a2;
      $storage13->sub_indicator_13b_lab_store  = $request->storage_management_13b2=='NA'?-1:$request->storage_management_13b2;
      $storage13->sub_indicator_13c_lab_store  = $request->storage_management_13c2=='NA'?-1:$request->storage_management_13c2;
      $storage13->sub_indicator_13d_lab_store  = $request->storage_management_13d2=='NA'?-1:$request->storage_management_13d2;
      $storage13->sub_indicator_13e_lab_store  = $request->storage_management_13e2=='NA'?-1:$request->storage_management_13e2;
      $storage13->sub_indicator_13f_lab_store  = $request->storage_management_13f2=='NA'?-1:$request->storage_management_13f2;
      $storage13->sub_indicator_13g_lab_store  = $request->storage_management_13g2=='NA'?-1:$request->storage_management_13g2;
      $storage13->sub_indicator_13h_lab_store  = $request->storage_management_13h2=='NA'?-1:$request->storage_management_13h2;
      $storage13->sub_indicator_13i_lab_store  = $request->storage_management_13i2=='NA'?-1:$request->storage_management_13i2;
      $storage13->sub_indicator_13j_lab_store  = $request->storage_management_13j2=='NA'?-1:$request->storage_management_13j2;
      $storage13->sub_indicator_13k_lab_store  = $request->storage_management_13k2=='NA'?-1:$request->storage_management_13k2;
      $storage13->sub_indicator_13l_lab_store  = $request->storage_management_13l2=='NA'?-1:$request->storage_management_13l2;
      $storage13->indicator_13_comments  = $request->storage_management_13_comments;

      $storage13->health_facility_id = $request->facility_id;
      $storage13->survey_summary_id = $summary->id;
      $storage13->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage13->form_id = $request->form_id;
      $storage13->created_by = Auth::user()->id;
      $storage13->updated_by = Auth::user()->id;
      $storage13->upload_status = 0;
      $storage13_response = $storage13->save();

    }


    else
    {
      //save storage management 13
      $storage13 = StorageManagement13::where('form_id','=',$request->form_id)->first();

      $storage13->sub_indicator_13a_main_store = $request->storage_management_13a1=='NA'?-1:$request->storage_management_13a1;
      $storage13->sub_indicator_13b_main_store = $request->storage_management_13b1=='NA'?-1:$request->storage_management_13b1;
      $storage13->sub_indicator_13c_main_store = $request->storage_management_13c1=='NA'?-1:$request->storage_management_13c1;
      $storage13->sub_indicator_13d_main_store = $request->storage_management_13d1=='NA'?-1:$request->storage_management_13d1;
      $storage13->sub_indicator_13e_main_store = $request->storage_management_13e1=='NA'?-1:$request->storage_management_13e1;
      $storage13->sub_indicator_13f_main_store = $request->storage_management_13f1=='NA'?-1:$request->storage_management_13f1;
      $storage13->sub_indicator_13g_main_store = $request->storage_management_13g1=='NA'?-1:$request->storage_management_13g1;
      $storage13->sub_indicator_13h_main_store = $request->storage_management_13h1=='NA'?-1:$request->storage_management_13h1;
      $storage13->sub_indicator_13i_main_store = $request->storage_management_13i1=='NA'?-1:$request->storage_management_13i1;
      $storage13->sub_indicator_13j_main_store = $request->storage_management_13j1=='NA'?-1:$request->storage_management_13j1;
      $storage13->sub_indicator_13k_main_store = $request->storage_management_13k1=='NA'?-1:$request->storage_management_13k1;
      $storage13->sub_indicator_13l_main_store = $request->storage_management_13l1=='NA'?-1:$request->storage_management_13l1;

      $storage13->sub_indicator_13a_lab_store  = $request->storage_management_13a2=='NA'?-1:$request->storage_management_13a2;
      $storage13->sub_indicator_13b_lab_store  = $request->storage_management_13b2=='NA'?-1:$request->storage_management_13b2;
      $storage13->sub_indicator_13c_lab_store  = $request->storage_management_13c2=='NA'?-1:$request->storage_management_13c2;
      $storage13->sub_indicator_13d_lab_store  = $request->storage_management_13d2=='NA'?-1:$request->storage_management_13d2;
      $storage13->sub_indicator_13e_lab_store  = $request->storage_management_13e2=='NA'?-1:$request->storage_management_13e2;
      $storage13->sub_indicator_13f_lab_store  = $request->storage_management_13f2=='NA'?-1:$request->storage_management_13f2;
      $storage13->sub_indicator_13g_lab_store  = $request->storage_management_13g2=='NA'?-1:$request->storage_management_13g2;
      $storage13->sub_indicator_13h_lab_store  = $request->storage_management_13h2=='NA'?-1:$request->storage_management_13h2;
      $storage13->sub_indicator_13i_lab_store  = $request->storage_management_13i2=='NA'?-1:$request->storage_management_13i2;
      $storage13->sub_indicator_13j_lab_store  = $request->storage_management_13j2=='NA'?-1:$request->storage_management_13j2;
      $storage13->sub_indicator_13k_lab_store  = $request->storage_management_13k2=='NA'?-1:$request->storage_management_13k2;
      $storage13->sub_indicator_13l_lab_store  = $request->storage_management_13l2=='NA'?-1:$request->storage_management_13l2;
      $storage13->indicator_13_comments  = $request->storage_management_13_comments;

      $storage13->health_facility_id = $request->facility_id;
      $storage13->survey_summary_id = $summary->id;
      $storage13->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage13->form_id = $request->form_id;
      $storage13->updated_by = Auth::user()->id;

      $storage13_response = $storage13->save();

    }

    $exists_14 = StorageManagement14::where('form_id','=',$request->form_id)->first();

    if($exists_14==null)
    {

      //save storage management 14
      $storage14 = new StorageManagement14;

      $storage14->sub_indicator_14a_main_store = $request->storage_management_14a1=='NA'?-1:$request->storage_management_14a1;
      $storage14->sub_indicator_14b_main_store = $request->storage_management_14b1=='NA'?-1:$request->storage_management_14b1;
      $storage14->sub_indicator_14c_main_store = $request->storage_management_14c1=='NA'?-1:$request->storage_management_14c1;
      $storage14->sub_indicator_14d_main_store = $request->storage_management_14d1=='NA'?-1:$request->storage_management_14d1;
      $storage14->sub_indicator_14e_main_store = $request->storage_management_14e1=='NA'?-1:$request->storage_management_14e1;
      $storage14->sub_indicator_14f_main_store = $request->storage_management_14f1=='NA'?-1:$request->storage_management_14f1;
      $storage14->sub_indicator_14g_main_store = $request->storage_management_14g1=='NA'?-1:$request->storage_management_14g1;
      $storage14->sub_indicator_14h_main_store = $request->storage_management_14h1=='NA'?-1:$request->storage_management_14h1;

      $storage14->sub_indicator_14a_lab_store  = $request->storage_management_14a2=='NA'?-1:$request->storage_management_14a2;
      $storage14->sub_indicator_14b_lab_store  = $request->storage_management_14b2=='NA'?-1:$request->storage_management_14b2;
      $storage14->sub_indicator_14c_lab_store  = $request->storage_management_14c2=='NA'?-1:$request->storage_management_14c2;
      $storage14->sub_indicator_14d_lab_store  = $request->storage_management_14d2=='NA'?-1:$request->storage_management_14d2;
      $storage14->sub_indicator_14e_lab_store  = $request->storage_management_14e2=='NA'?-1:$request->storage_management_14e2;
      $storage14->sub_indicator_14f_lab_store  = $request->storage_management_14f2=='NA'?-1:$request->storage_management_14f2;
      $storage14->sub_indicator_14g_lab_store  = $request->storage_management_14g2=='NA'?-1:$request->storage_management_14g2;
      $storage14->sub_indicator_14h_lab_store  = $request->storage_management_14h2=='NA'?-1:$request->storage_management_14h2;

      $storage14->indicator_14_comments  = $request->storage_management_14_comments;

      $storage14->health_facility_id = $request->facility_id;
      $storage14->survey_summary_id = $summary->id;
      $storage14->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage14->form_id = $request->form_id;
      $storage14->created_by = Auth::user()->id;
      $storage14->upload_status = 0;
      $storage14_response = $storage14->save();

    }

    else
    {

      //save storage management 14
      $storage14 = StorageManagement14::where('form_id','=',$request->form_id)->first();

      $storage14->sub_indicator_14a_main_store = $request->storage_management_14a1=='NA'?-1:$request->storage_management_14a1;
      $storage14->sub_indicator_14b_main_store = $request->storage_management_14b1=='NA'?-1:$request->storage_management_14b1;
      $storage14->sub_indicator_14c_main_store = $request->storage_management_14c1=='NA'?-1:$request->storage_management_14c1;
      $storage14->sub_indicator_14d_main_store = $request->storage_management_14d1=='NA'?-1:$request->storage_management_14d1;
      $storage14->sub_indicator_14e_main_store = $request->storage_management_14e1=='NA'?-1:$request->storage_management_14e1;
      $storage14->sub_indicator_14f_main_store = $request->storage_management_14f1=='NA'?-1:$request->storage_management_14f1;
      $storage14->sub_indicator_14g_main_store = $request->storage_management_14g1=='NA'?-1:$request->storage_management_14g1;
      $storage14->sub_indicator_14h_main_store = $request->storage_management_14h1=='NA'?-1:$request->storage_management_14h1;

      $storage14->sub_indicator_14a_lab_store  = $request->storage_management_14a2=='NA'?-1:$request->storage_management_14a2;
      $storage14->sub_indicator_14b_lab_store  = $request->storage_management_14b2=='NA'?-1:$request->storage_management_14b2;
      $storage14->sub_indicator_14c_lab_store  = $request->storage_management_14c2=='NA'?-1:$request->storage_management_14c2;
      $storage14->sub_indicator_14d_lab_store  = $request->storage_management_14d2=='NA'?-1:$request->storage_management_14d2;
      $storage14->sub_indicator_14e_lab_store  = $request->storage_management_14e2=='NA'?-1:$request->storage_management_14e2;
      $storage14->sub_indicator_14f_lab_store  = $request->storage_management_14f2=='NA'?-1:$request->storage_management_14f2;
      $storage14->sub_indicator_14g_lab_store  = $request->storage_management_14g2=='NA'?-1:$request->storage_management_14g2;
      $storage14->sub_indicator_14h_lab_store  = $request->storage_management_14h2=='NA'?-1:$request->storage_management_14h2;

      $storage14->indicator_14_comments  = $request->storage_management_14_comments;

      $storage14->health_facility_id = $request->facility_id;
      $storage14->survey_summary_id = $summary->id;
      $storage14->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $storage14->form_id = $request->form_id;
      $storage14->updated_by = Auth::user()->id;
      $storage14_response = $storage14->save();

    }

    $indicators = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();
    if($indicators == null )
    {

      //save indicator summary scores
      $indicator_score = new IndicatorScoreSummary;

      $indicator_score->indicator10_score = $request->indicator10_score;
      $indicator_score->indicator11_score = $request->indicator11_score;
      $indicator_score->indicator12_score = $request->indicator12_score;
      $indicator_score->indicator13_score = $request->indicator13_score;
      $indicator_score->indicator14_score = $request->indicator14_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->created_by = Auth::user()->id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->save();
    }

    else
    {

      //save indicator summary scores
      $indicator_score = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();

      $indicator_score->indicator10_score = $request->indicator10_score;
      $indicator_score->indicator11_score = $request->indicator11_score;
      $indicator_score->indicator12_score = $request->indicator12_score;
      $indicator_score->indicator13_score = $request->indicator13_score;
      $indicator_score->indicator14_score = $request->indicator14_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->updated_by = Auth::user()->id;
      $indicator_score->save();

    }

    return response()->json([ 'storage10' => $storage10_response,'storage11' => $storage11_response,'storage12' => $storage12_response,'storage13' => $storage13_response,'storage14' => $storage14_response ]);

  }

  public function saveOrdering(Request $request)
  {

    $summary = SurveySummary::where('form_id','=',$request->form_id)->first();

    $summary->step = 3;
    $summary->save();


    $ordering15_response = $ordering16_response = $ordering17_response = null;

    $exists_15 = Ordering15::where('form_id','=',$request->form_id)->first();

    if($exists_15 == null)
    {

      //save ordering 15
      $ordering15 = new Ordering15;

      $ordering15->sub_indicator_15a = $request->ordering_15a=='NR'?-1:$request->ordering_15a;
      $ordering15->sub_indicator_15a_soh = $request->ordering_15a1;
      $ordering15->sub_indicator_15a_issued = $request->ordering_15a2;
      $ordering15->sub_indicator_15a_amc = $request->ordering_15a3;
      $ordering15->sub_indicator_15b = $request->ordering_15b=='NR'?-1:$request->ordering_15b;
      $ordering15->sub_indicator_15c = $request->ordering_15c=='NR'?-1:$request->ordering_15c;

      $ordering15->indicator_15_comments  = $request->ordering_15_comments;

      $ordering15->health_facility_id = $request->facility_id;
      $ordering15->survey_summary_id = $summary->id;
      $ordering15->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $ordering15->form_id = $request->form_id;
      $ordering15->created_by = Auth::user()->id;
      $ordering15->upload_status = 0;
      $ordering15_response = $ordering15->save();

    }
    else
    {
      //save ordering 15
      $ordering15 = Ordering15::where('form_id','=',$request->form_id)->first();

      $ordering15->sub_indicator_15a = $request->ordering_15a=='NR'?-1:$request->ordering_15a;
      $ordering15->sub_indicator_15a_soh = $request->ordering_15a1;
      $ordering15->sub_indicator_15a_issued = $request->ordering_15a2;
      $ordering15->sub_indicator_15a_amc = $request->ordering_15a3;
      $ordering15->sub_indicator_15b = $request->ordering_15b=='NR'?-1:$request->ordering_15b;
      $ordering15->sub_indicator_15c = $request->ordering_15c=='NR'?-1:$request->ordering_15c;

      $ordering15->indicator_15_comments  = $request->ordering_15_comments;

      $ordering15->health_facility_id = $request->facility_id;
      $ordering15->survey_summary_id = $summary->id;
      $ordering15->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $ordering15->form_id = $request->form_id;
      $ordering15->updated_by = Auth::user()->id;
      $ordering15_response = $ordering15->save();

    }

    $exists_16 = Ordering16::where('form_id','=',$request->form_id)->first();

    if($exists_16 == null)
    {

      //save ordering 16
      $ordering16 = new Ordering16;

      $ordering16->sub_indicator_16a = DateTime::createFromFormat('d F Y', $request->ordering_16a);
      $ordering16->sub_indicator_16b = DateTime::createFromFormat('d F Y', $request->ordering_16b);
      $ordering16->sub_indicator_16c = $request->ordering_16c=='NR'?-1:$request->ordering_16c;

      $ordering16->sub_indicator_16d = DateTime::createFromFormat('d F Y', $request->ordering_16d);
      $ordering16->sub_indicator_16e = DateTime::createFromFormat('d F Y', $request->ordering_16e);
      $ordering16->sub_indicator_16f = $request->ordering_16f=='NR'?-1:$request->ordering_16f;

      $ordering16->indicator_16_comments  = $request->ordering_16_comments;

      $ordering16->health_facility_id = $request->facility_id;
      $ordering16->survey_summary_id = $summary->id;
      $ordering16->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $ordering16->form_id = $request->form_id;
      $ordering16->created_by = Auth::user()->id;
      $ordering16->upload_status = 0;
      $ordering16_response = $ordering16->save();

    }

    else
    {
      //save ordering 16
      $ordering16 = Ordering16::where('form_id','=',$request->form_id)->first();

      $ordering16->sub_indicator_16a = DateTime::createFromFormat('d F Y', $request->ordering_16a);
      $ordering16->sub_indicator_16b = DateTime::createFromFormat('d F Y', $request->ordering_16b);
      $ordering16->sub_indicator_16c = $request->ordering_16c=='NR'?-1:$request->ordering_16c;

      $ordering16->sub_indicator_16d = DateTime::createFromFormat('d F Y', $request->ordering_16d);
      $ordering16->sub_indicator_16e = DateTime::createFromFormat('d F Y', $request->ordering_16e);
      $ordering16->sub_indicator_16f = $request->ordering_16f=='NR'?-1:$request->ordering_16f;

      $ordering16->indicator_16_comments  = $request->ordering_16_comments;

      $ordering16->health_facility_id = $request->facility_id;
      $ordering16->survey_summary_id = $summary->id;
      $ordering16->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $ordering16->form_id = $request->form_id;
      $ordering16->updated_by = Auth::user()->id;
      $ordering16_response = $ordering16->save();

    }

    $exists_17 = Ordering17::where('form_id','=',$request->form_id)->first();
    if($exists_17 == null)
    {

      //save ordering 17
      $ordering17 = new Ordering17;

      $ordering17->sub_indicator_17a = $request->ordering_17a=='NA'?-1:$request->ordering_17a;

      $ordering17->indicator_17_comments  = $request->ordering_17_comments;

      $ordering17->health_facility_id = $request->facility_id;
      $ordering17->survey_summary_id = $summary->id;
      $ordering17->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $ordering17->form_id = $request->form_id;
      $ordering17->created_by = Auth::user()->id;
      $ordering17->upload_status = 0;
      $ordering17_response = $ordering17->save();

    }

    else
    {
      //save ordering 17
      $ordering17 = Ordering17::where('form_id','=',$request->form_id)->first();

      $ordering17->sub_indicator_17a = $request->ordering_17a=='NA'?-1:$request->ordering_17a;

      $ordering17->indicator_17_comments  = $request->ordering_17_comments;

      $ordering17->health_facility_id = $request->facility_id;
      $ordering17->survey_summary_id = $summary->id;
      $ordering17->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
      $ordering17->form_id = $request->form_id;
      $ordering17->updated_by = Auth::user()->id;
      $ordering17_response = $ordering17->save();
    }


    $indicators = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();
    if($indicators == null )
    {

      //save indicator summary scores
      $indicator_score = new IndicatorScoreSummary;

      $indicator_score->indicator15_score = $request->indicator15_score;
      $indicator_score->indicator16_score = $request->indicator16_score;
      $indicator_score->indicator17_score = $request->indicator17_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->created_by = Auth::user()->id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->save();
    }

    else
    {

      //save indicator summary scores
      $indicator_score = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();

      $indicator_score->indicator15_score = $request->indicator15_score;
      $indicator_score->indicator16_score = $request->indicator16_score;
      $indicator_score->indicator17_score = $request->indicator17_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->updated_by = Auth::user()->id;
      $indicator_score->save();

    }

    return response()->json([ 'ordering15' => $ordering15_response,'ordering16' => $ordering16_response,'ordering17' => $ordering17_response ]);

  }

  public function saveEquipment(Request $request)
  {

    $summary = SurveySummary::where('form_id','=',$request->form_id)->first();

    $summary->step = 4;
    $summary->save();

    $equipment18_response = $equipment19_response = $equipment20_response = $equipment21_response = null;

    //save equipment 18
    $equipment18 = Equipment18::where('survey_summary_id',$summary->id)->first();
    if($equipment18 == null )
    {

      $equipment18 = new Equipment18;
      $equipment18->health_facility_id = $summary->health_facility_id;
      $equipment18->survey_summary_id = $summary->id;
      $equipment18->visit_date = $summary->visit_date;
      $equipment18->form_id = $summary->form_id;
      $equipment18->created_by = Auth::user()->id;
      $equipment18->upload_status = 0;


      $equipment18->sub_indicator_18a = $request->lab_equipment_18a;
      $equipment18->sub_indicator_18b = $request->lab_equipment_18b;
      $equipment18->sub_indicator_18c = $request->lab_equipment_18c;
      $equipment18->sub_indicator_18d = $request->lab_equipment_18d;


      $equipment18->indicator_18_comments  = $request->lab_equipment_18_comments;

      $equipment18_response  = $equipment18->save();

    }

    else
    {

      $equipment18 = Equipment18::where('survey_summary_id',$summary->id)->first();
      $equipment18->health_facility_id = $summary->health_facility_id;
      $equipment18->survey_summary_id = $summary->id;
      $equipment18->visit_date = $summary->visit_date;
      $equipment18->form_id = $summary->form_id;
      $equipment18->updated_by = Auth::user()->id;


      $equipment18->sub_indicator_18a = $request->lab_equipment_18a;
      $equipment18->sub_indicator_18b = $request->lab_equipment_18b;
      $equipment18->sub_indicator_18c = $request->lab_equipment_18c;
      $equipment18->sub_indicator_18d = $request->lab_equipment_18d;


      $equipment18->indicator_18_comments  = $request->lab_equipment_18_comments;

      $equipment18_response  = $equipment18->save();

    }



    //save equipment 19
    $equipment19 = Equipment19::where('survey_summary_id',$summary->id)->first();
    if($equipment19 == null )
    {

      $equipment19 = new Equipment19;
      $equipment19->health_facility_id = $summary->health_facility_id;
      $equipment19->survey_summary_id = $summary->id;
      $equipment19->visit_date = $summary->visit_date;
      $equipment19->form_id = $summary->form_id;
      $equipment19->created_by = Auth::user()->id;
      $equipment19->upload_status = 0;

      $equipment19->sub_indicator_19a = $request->lab_equipment_19a=='NA'?-1:$request->lab_equipment_19a;
      $equipment19->sub_indicator_19b = $request->lab_equipment_19b=='NA'?-1:$request->lab_equipment_19b;
      $equipment19->sub_indicator_19c = $request->lab_equipment_19c=='NA'?-1:$request->lab_equipment_19c;
      $equipment19->sub_indicator_19d = $request->lab_equipment_19d=='NA'?-1:$request->lab_equipment_19d;

      $equipment19->indicator_19_comments  = $request->lab_equipment_19_comments;

      $equipment19_response = $equipment19->save();

    }

    else
    {

      $equipment19 = Equipment19::where('survey_summary_id',$summary->id)->first();;
      $equipment19->health_facility_id = $summary->health_facility_id;
      $equipment19->survey_summary_id = $summary->id;
      $equipment19->visit_date = $summary->visit_date;
      $equipment19->form_id = $summary->form_id;
      $equipment19->updated_by = Auth::user()->id;

      $equipment19->sub_indicator_19a = $request->lab_equipment_19a=='NA'?-1:$request->lab_equipment_19a;
      $equipment19->sub_indicator_19b = $request->lab_equipment_19b=='NA'?-1:$request->lab_equipment_19b;
      $equipment19->sub_indicator_19c = $request->lab_equipment_19c=='NA'?-1:$request->lab_equipment_19c;
      $equipment19->sub_indicator_19d = $request->lab_equipment_19d=='NA'?-1:$request->lab_equipment_19d;

      $equipment19->indicator_19_comments  = $request->lab_equipment_19_comments;

      $equipment19_response = $equipment19->save();

    }

    //save equipment 20
    $equipment20 = Equipment20::where('survey_summary_id',$summary->id)->first();
    if($equipment20 == null )
    {

      $equipment20 = new Equipment20;

      $equipment20->health_facility_id = $summary->health_facility_id;
      $equipment20->survey_summary_id = $summary->id;
      $equipment20->visit_date = $summary->visit_date;
      $equipment20->form_id = $summary->form_id;
      $equipment20->created_by = Auth::user()->id;

      $equipment20->cd4_machine = $request->lab_equipment_20_cd4;
      $equipment20->chemistry_machine = $request->lab_equipment_20_chemistry;
      $equipment20->heamatology_machine = $request->lab_equipment_20_hematology;

      $equipment20->sub_indicator_20a1 = $request->lab_equipment_20a1=='NA'?-1:$request->lab_equipment_20a1;
      $equipment20->sub_indicator_20a2 = $request->lab_equipment_20a2=='NA'?-1:$request->lab_equipment_20a2;
      $equipment20->sub_indicator_20a3 = $request->lab_equipment_20a3=='NA'?-1:$request->lab_equipment_20a3;
      $equipment20->sub_indicator_20a4 = $request->lab_equipment_20a4=='NA'?-1:$request->lab_equipment_20a4;
      $equipment20->sub_indicator_20a5 = $request->lab_equipment_20a5=='NA'?-1:$request->lab_equipment_20a5;
      $equipment20->sub_indicator_20a6 = $request->lab_equipment_20a6=='NA'?-1:$request->lab_equipment_20a6;

      $equipment20->sub_indicator_20b1 = $request->lab_equipment_20b1=='NA'?-1:$request->lab_equipment_20b1;
      $equipment20->sub_indicator_20b2 = $request->lab_equipment_20b2=='NA'?-1:$request->lab_equipment_20b2;
      $equipment20->sub_indicator_20b3 = $request->lab_equipment_20b3=='NA'?-1:$request->lab_equipment_20b3;
      $equipment20->sub_indicator_20b4 = $request->lab_equipment_20b4=='NA'?-1:$request->lab_equipment_20b4;
      $equipment20->sub_indicator_20b5 = $request->lab_equipment_20b5=='NA'?-1:$request->lab_equipment_20b5;
      $equipment20->sub_indicator_20b6 = $request->lab_equipment_20b6=='NA'?-1:$request->lab_equipment_20b6;

      $equipment20->sub_indicator_20c1 = $request->lab_equipment_20c1=='NA'?-1:$request->lab_equipment_20c1;
      $equipment20->sub_indicator_20c2 = $request->lab_equipment_20c2=='NA'?-1:$request->lab_equipment_20c2;
      $equipment20->sub_indicator_20c3 = $request->lab_equipment_20c3=='NA'?-1:$request->lab_equipment_20c3;
      $equipment20->sub_indicator_20c4 = $request->lab_equipment_20c4=='NA'?-1:$request->lab_equipment_20c4;
      $equipment20->sub_indicator_20c5 = $request->lab_equipment_20c5=='NA'?-1:$request->lab_equipment_20c5;
      $equipment20->sub_indicator_20c6 = $request->lab_equipment_20c6=='NA'?-1:$request->lab_equipment_20c6;

      $equipment20->sub_indicator_20d1 = $request->lab_equipment_20d1=='NA'?-1:$request->lab_equipment_20d1;
      $equipment20->sub_indicator_20d2 = $request->lab_equipment_20d2=='NA'?-1:$request->lab_equipment_20d2;
      $equipment20->sub_indicator_20d3 = $request->lab_equipment_20d3=='NA'?-1:$request->lab_equipment_20d3;
      $equipment20->sub_indicator_20d4 = $request->lab_equipment_20d4=='NA'?-1:$request->lab_equipment_20d4;
      $equipment20->sub_indicator_20d5 = $request->lab_equipment_20d5=='NA'?-1:$request->lab_equipment_20d5;
      $equipment20->sub_indicator_20d6 = $request->lab_equipment_20d6=='NA'?-1:$request->lab_equipment_20d6;

      $equipment20->sub_indicator_20e1 = $request->lab_equipment_20e1=='NA'?-1:$request->lab_equipment_20e1;
      $equipment20->sub_indicator_20e2 = $request->lab_equipment_20e2=='NA'?-1:$request->lab_equipment_20e2;
      $equipment20->sub_indicator_20e3 = $request->lab_equipment_20e3=='NA'?-1:$request->lab_equipment_20e3;
      $equipment20->sub_indicator_20e4 = $request->lab_equipment_20e4=='NA'?-1:$request->lab_equipment_20e4;
      $equipment20->sub_indicator_20e5 = $request->lab_equipment_20e5=='NA'?-1:$request->lab_equipment_20e5;
      $equipment20->sub_indicator_20e6 = $request->lab_equipment_20e6=='NA'?-1:$request->lab_equipment_20e6;

      $equipment20->sub_indicator_20f1 = $request->lab_equipment_20f1=='NA'?-1:$request->lab_equipment_20f1;
      $equipment20->sub_indicator_20f2 = $request->lab_equipment_20f2=='NA'?-1:$request->lab_equipment_20f2;
      $equipment20->sub_indicator_20f3 = $request->lab_equipment_20f3=='NA'?-1:$request->lab_equipment_20f3;
      $equipment20->sub_indicator_20f4 = $request->lab_equipment_20f4=='NA'?-1:$request->lab_equipment_20f4;
      $equipment20->sub_indicator_20f5 = $request->lab_equipment_20f5=='NA'?-1:$request->lab_equipment_20f5;
      $equipment20->sub_indicator_20f6 = $request->lab_equipment_20f6=='NA'?-1:$request->lab_equipment_20f6;

      $equipment20->indicator_20_comments  = $request->lab_equipment_20_comments;
      $equipment20->upload_status  = 0;

      $equipment20_response  = $equipment20->save();

    }

    //save equipment 20
    else
    {

      $equipment20 = Equipment20::where('survey_summary_id',$summary->id)->first();

      $equipment20->health_facility_id = $summary->health_facility_id;
      $equipment20->survey_summary_id = $summary->id;
      $equipment20->visit_date = $summary->visit_date;
      $equipment20->form_id = $summary->form_id;
      $equipment20->updated_by = Auth::user()->id;

      $equipment20->cd4_machine = $request->lab_equipment_20_cd4;
      $equipment20->chemistry_machine = $request->lab_equipment_20_chemistry;
      $equipment20->heamatology_machine = $request->lab_equipment_20_hematology;

      $equipment20->sub_indicator_20a1 = $request->lab_equipment_20a1=='NA'?-1:$request->lab_equipment_20a1;
      $equipment20->sub_indicator_20a2 = $request->lab_equipment_20a2=='NA'?-1:$request->lab_equipment_20a2;
      $equipment20->sub_indicator_20a3 = $request->lab_equipment_20a3=='NA'?-1:$request->lab_equipment_20a3;
      $equipment20->sub_indicator_20a4 = $request->lab_equipment_20a4=='NA'?-1:$request->lab_equipment_20a4;
      $equipment20->sub_indicator_20a5 = $request->lab_equipment_20a5=='NA'?-1:$request->lab_equipment_20a5;
      $equipment20->sub_indicator_20a6 = $request->lab_equipment_20a6=='NA'?-1:$request->lab_equipment_20a6;

      $equipment20->sub_indicator_20b1 = $request->lab_equipment_20b1=='NA'?-1:$request->lab_equipment_20b1;
      $equipment20->sub_indicator_20b2 = $request->lab_equipment_20b2=='NA'?-1:$request->lab_equipment_20b2;
      $equipment20->sub_indicator_20b3 = $request->lab_equipment_20b3=='NA'?-1:$request->lab_equipment_20b3;
      $equipment20->sub_indicator_20b4 = $request->lab_equipment_20b4=='NA'?-1:$request->lab_equipment_20b4;
      $equipment20->sub_indicator_20b5 = $request->lab_equipment_20b5=='NA'?-1:$request->lab_equipment_20b5;
      $equipment20->sub_indicator_20b6 = $request->lab_equipment_20b6=='NA'?-1:$request->lab_equipment_20b6;

      $equipment20->sub_indicator_20c1 = $request->lab_equipment_20c1=='NA'?-1:$request->lab_equipment_20c1;
      $equipment20->sub_indicator_20c2 = $request->lab_equipment_20c2=='NA'?-1:$request->lab_equipment_20c2;
      $equipment20->sub_indicator_20c3 = $request->lab_equipment_20c3=='NA'?-1:$request->lab_equipment_20c3;
      $equipment20->sub_indicator_20c4 = $request->lab_equipment_20c4=='NA'?-1:$request->lab_equipment_20c4;
      $equipment20->sub_indicator_20c5 = $request->lab_equipment_20c5=='NA'?-1:$request->lab_equipment_20c5;
      $equipment20->sub_indicator_20c6 = $request->lab_equipment_20c6=='NA'?-1:$request->lab_equipment_20c6;

      $equipment20->sub_indicator_20d1 = $request->lab_equipment_20d1=='NA'?-1:$request->lab_equipment_20d1;
      $equipment20->sub_indicator_20d2 = $request->lab_equipment_20d2=='NA'?-1:$request->lab_equipment_20d2;
      $equipment20->sub_indicator_20d3 = $request->lab_equipment_20d3=='NA'?-1:$request->lab_equipment_20d3;
      $equipment20->sub_indicator_20d4 = $request->lab_equipment_20d4=='NA'?-1:$request->lab_equipment_20d4;
      $equipment20->sub_indicator_20d5 = $request->lab_equipment_20d5=='NA'?-1:$request->lab_equipment_20d5;
      $equipment20->sub_indicator_20d6 = $request->lab_equipment_20d6=='NA'?-1:$request->lab_equipment_20d6;

      $equipment20->sub_indicator_20e1 = $request->lab_equipment_20e1=='NA'?-1:$request->lab_equipment_20e1;
      $equipment20->sub_indicator_20e2 = $request->lab_equipment_20e2=='NA'?-1:$request->lab_equipment_20e2;
      $equipment20->sub_indicator_20e3 = $request->lab_equipment_20e3=='NA'?-1:$request->lab_equipment_20e3;
      $equipment20->sub_indicator_20e4 = $request->lab_equipment_20e4=='NA'?-1:$request->lab_equipment_20e4;
      $equipment20->sub_indicator_20e5 = $request->lab_equipment_20e5=='NA'?-1:$request->lab_equipment_20e5;
      $equipment20->sub_indicator_20e6 = $request->lab_equipment_20e6=='NA'?-1:$request->lab_equipment_20e6;

      $equipment20->sub_indicator_20f1 = $request->lab_equipment_20f1=='NA'?-1:$request->lab_equipment_20f1;
      $equipment20->sub_indicator_20f2 = $request->lab_equipment_20f2=='NA'?-1:$request->lab_equipment_20f2;
      $equipment20->sub_indicator_20f3 = $request->lab_equipment_20f3=='NA'?-1:$request->lab_equipment_20f3;
      $equipment20->sub_indicator_20f4 = $request->lab_equipment_20f4=='NA'?-1:$request->lab_equipment_20f4;
      $equipment20->sub_indicator_20f5 = $request->lab_equipment_20f5=='NA'?-1:$request->lab_equipment_20f5;
      $equipment20->sub_indicator_20f6 = $request->lab_equipment_20f6=='NA'?-1:$request->lab_equipment_20f6;

      $equipment20->indicator_20_comments  = $request->lab_equipment_20_comments;

      $equipment20_response  = $equipment20->save();

    }

    //save equipment 21
    $equipment21 = Equipment21::where('survey_summary_id',$summary->id)->first();
    if($equipment21 == null )
    {

      $equipment21 = new Equipment21;
      $equipment21->health_facility_id = $summary->health_facility_id;
      $equipment21->survey_summary_id = $summary->id;
      $equipment21->visit_date = $summary->visit_date;
      $equipment21->form_id = $summary->form_id;
      $equipment21->upload_status = 0;
      $equipment21->created_by = Auth::user()->id;

      $equipment21->sub_indicator_211ac = $request->cd4_facs_presto_21e2=='NA'?-1:$request->cd4_facs_presto_21e2;
      $equipment21->sub_indicator_211ad = $request->cd4_facs_presto_21e3=='NA'?-1:$request->cd4_facs_presto_21e3;
      $equipment21->sub_indicator_211ah = $request->cd4_facs_presto_21e7=='NA'?-1:$request->cd4_facs_presto_21e7;
      $equipment21->sub_indicator_211bc = $request->cd4_facs_calibre_21a2=='NA'?-1:$request->cd4_facs_calibre_21a2;
      $equipment21->sub_indicator_211bd = $request->cd4_facs_calibre_21a3=='NA'?-1:$request->cd4_facs_calibre_21a3;
      $equipment21->sub_indicator_211bh = $request->cd4_facs_calibre_21a7=='NA'?-1:$request->cd4_facs_calibre_21a7;
      $equipment21->sub_indicator_211cc = $request->cd4_facs_count_21b2=='NA'?-1:$request->cd4_facs_count_21b2;
      $equipment21->sub_indicator_211cd = $request->cd4_facs_count_21b3=='NA'?-1:$request->cd4_facs_count_21b3;
      $equipment21->sub_indicator_211ch = $request->cd4_facs_count_21b7=='NA'?-1:$request->cd4_facs_count_21b7;
      $equipment21->sub_indicator_211dc = $request->cd4_partec_count_21c2=='NA'?-1:$request->cd4_partec_count_21c2;
      $equipment21->sub_indicator_211dd = $request->cd4_partec_count_21c3=='NA'?-1:$request->cd4_partec_count_21c3;
      $equipment21->sub_indicator_211dh = $request->cd4_partec_count_21c7=='NA'?-1:$request->cd4_partec_count_21c7;
      $equipment21->sub_indicator_211ec = $request->cd4_pima_21d2=='NA'?-1:$request->cd4_pima_21d2;
      $equipment21->sub_indicator_211ed = $request->cd4_pima_21d3=='NA'?-1:$request->cd4_pima_21d3;
      $equipment21->sub_indicator_211eh = $request->cd4_pima_21d7=='NA'?-1:$request->cd4_pima_21d7;

      $equipment21->sub_indicator_212ac = $request->chemistry_c311_21a2=='NA'?-1:$request->chemistry_c311_21a2;
      $equipment21->sub_indicator_212ad = $request->chemistry_c311_21a3=='NA'?-1:$request->chemistry_c311_21a3;
      $equipment21->sub_indicator_212ah = $request->chemistry_c311_21a7=='NA'?-1:$request->chemistry_c311_21a7;
      $equipment21->sub_indicator_212bc = $request->chemistry_c111_21b2=='NA'?-1:$request->chemistry_c111_21b2;
      $equipment21->sub_indicator_212bd = $request->chemistry_c111_21b3=='NA'?-1:$request->chemistry_c111_21b3;
      $equipment21->sub_indicator_212bh = $request->chemistry_c111_21b7=='NA'?-1:$request->chemistry_c111_21b7;
      $equipment21->sub_indicator_213ac = $request->haematology_huma600_21a2=='NA'?-1:$request->haematology_huma600_21a2;
      $equipment21->sub_indicator_213ad = $request->haematology_huma600_21a3=='NA'?-1:$request->haematology_huma600_21a3;
      $equipment21->sub_indicator_213ah = $request->haematology_huma600_21a7=='NA'?-1:$request->haematology_huma600_21a7;

      $equipment21->sub_indicator_213bc = $request->haematology_huma30TS_21b2=='NA'?-1:$request->haematology_huma30TS_21b2;
      $equipment21->sub_indicator_213bd = $request->haematology_huma30TS_21b3=='NA'?-1:$request->haematology_huma30TS_21b3;
      $equipment21->sub_indicator_213bh = $request->haematology_huma30TS_21b7=='NA'?-1:$request->haematology_huma30TS_21b7;

      $equipment21->sub_indicator_213cc = $request->haematology_huma60TS_21c2=='NA'?-1:$request->haematology_huma60TS_21c2;
      $equipment21->sub_indicator_213cd = $request->haematology_huma60TS_21c3=='NA'?-1:$request->haematology_huma60TS_21c3;
      $equipment21->sub_indicator_213ch = $request->haematology_huma60TS_21c7=='NA'?-1:$request->haematology_huma60TS_21c7;

      $equipment21->sub_indicator_213dc = $request->haematology_mind3200_21e2=='NA'?-1:$request->haematology_mind3200_21e2;
      $equipment21->sub_indicator_213dd = $request->haematology_mind3200_21e3=='NA'?-1:$request->haematology_mind3200_21e3;
      $equipment21->sub_indicator_213dh = $request->haematology_mind3200_21e7=='NA'?-1:$request->haematology_mind3200_21e7;

      $equipment21->sub_indicator_213ec = $request->haematology_mind3000_21f2=='NA'?-1:$request->haematology_mind3000_21f2;
      $equipment21->sub_indicator_213ed = $request->haematology_mind3000_21f3=='NA'?-1:$request->haematology_mind3000_21f3;
      $equipment21->sub_indicator_213eh = $request->haematology_mind3000_21f7=='NA'?-1:$request->haematology_mind3000_21f7;

      $equipment21->sub_indicator_213fc = $request->haematology_mind2800_21j2=='NA'?-1:$request->haematology_mind2800_21j2;
      $equipment21->sub_indicator_213fd = $request->haematology_mind2800_21j3=='NA'?-1:$request->haematology_mind2800_21j3;
      $equipment21->sub_indicator_213fh = $request->haematology_mind2800_21j7=='NA'?-1:$request->haematology_mind2800_21j7;

      $equipment21->sub_indicator_213gc = $request->haematology_mind2300_21i2=='NA'?-1:$request->haematology_mind2300_21i2;
      $equipment21->sub_indicator_213gd = $request->haematology_mind2300_21i3=='NA'?-1:$request->haematology_mind2300_21i3;
      $equipment21->sub_indicator_213gh = $request->haematology_mind2300_21i7=='NA'?-1:$request->haematology_mind2300_21i7;

      $equipment21->sub_indicator_213hc = $request->haematology_medonic_21k2=='NA'?-1:$request->haematology_medonic_21k2;
      $equipment21->sub_indicator_213hd = $request->haematology_medonic_21k3=='NA'?-1:$request->haematology_medonic_21k3;
      $equipment21->sub_indicator_213hh = $request->haematology_medonic_21k7=='NA'?-1:$request->haematology_medonic_21k7;

      $equipment21->sub_indicator_213ic = $request->haematology_sysmex100_21g2=='NA'?-1:$request->haematology_sysmex100_21g2;
      $equipment21->sub_indicator_213id = $request->haematology_sysmex100_21g3=='NA'?-1:$request->haematology_sysmex100_21g3;
      $equipment21->sub_indicator_213ih = $request->haematology_sysmex100_21g7=='NA'?-1:$request->haematology_sysmex100_21g7;

      $equipment21->sub_indicator_213jc = $request->haematology_sysmex300_21h2=='NA'?-1:$request->haematology_sysmex300_21h2;
      $equipment21->sub_indicator_213jd = $request->haematology_sysmex300_21h3=='NA'?-1:$request->haematology_sysmex300_21h3;
      $equipment21->sub_indicator_213jh = $request->haematology_sysmex300_21h7=='NA'?-1:$request->haematology_sysmex300_21h7;


      $equipment21->indicator_21_comments  = $request->lab_equipment_21_comments;

      $equipment21_response = $equipment21->save();

    }

    else
    {

      $equipment21 = Equipment21::where('survey_summary_id',$summary->id)->first();
      $equipment21->health_facility_id = $summary->health_facility_id;
      $equipment21->survey_summary_id = $summary->id;
      $equipment21->visit_date = $summary->visit_date;
      $equipment21->form_id = $summary->form_id;
      $equipment21->updated_by = Auth::user()->id;

      $equipment21->sub_indicator_211ac = $request->cd4_facs_presto_21e2=='NA'?-1:$request->cd4_facs_presto_21e2;
      $equipment21->sub_indicator_211ad = $request->cd4_facs_presto_21e3=='NA'?-1:$request->cd4_facs_presto_21e3;
      $equipment21->sub_indicator_211ah = $request->cd4_facs_presto_21e7=='NA'?-1:$request->cd4_facs_presto_21e7;
      $equipment21->sub_indicator_211bc = $request->cd4_facs_calibre_21a2=='NA'?-1:$request->cd4_facs_calibre_21a2;
      $equipment21->sub_indicator_211bd = $request->cd4_facs_calibre_21a3=='NA'?-1:$request->cd4_facs_calibre_21a3;
      $equipment21->sub_indicator_211bh = $request->cd4_facs_calibre_21a7=='NA'?-1:$request->cd4_facs_calibre_21a7;
      $equipment21->sub_indicator_211cc = $request->cd4_facs_count_21b2=='NA'?-1:$request->cd4_facs_count_21b2;
      $equipment21->sub_indicator_211cd = $request->cd4_facs_count_21b3=='NA'?-1:$request->cd4_facs_count_21b3;
      $equipment21->sub_indicator_211ch = $request->cd4_facs_count_21b7=='NA'?-1:$request->cd4_facs_count_21b7;
      $equipment21->sub_indicator_211dc = $request->cd4_partec_count_21c2=='NA'?-1:$request->cd4_partec_count_21c2;
      $equipment21->sub_indicator_211dd = $request->cd4_partec_count_21c3=='NA'?-1:$request->cd4_partec_count_21c3;
      $equipment21->sub_indicator_211dh = $request->cd4_partec_count_21c7=='NA'?-1:$request->cd4_partec_count_21c7;
      $equipment21->sub_indicator_211ec = $request->cd4_pima_21d2=='NA'?-1:$request->cd4_pima_21d2;
      $equipment21->sub_indicator_211ed = $request->cd4_pima_21d3=='NA'?-1:$request->cd4_pima_21d3;
      $equipment21->sub_indicator_211eh = $request->cd4_pima_21d7=='NA'?-1:$request->cd4_pima_21d7;

      $equipment21->sub_indicator_212ac = $request->chemistry_c311_21a2=='NA'?-1:$request->chemistry_c311_21a2;
      $equipment21->sub_indicator_212ad = $request->chemistry_c311_21a3=='NA'?-1:$request->chemistry_c311_21a3;
      $equipment21->sub_indicator_212ah = $request->chemistry_c311_21a7=='NA'?-1:$request->chemistry_c311_21a7;
      $equipment21->sub_indicator_212bc = $request->chemistry_c111_21b2=='NA'?-1:$request->chemistry_c111_21b2;
      $equipment21->sub_indicator_212bd = $request->chemistry_c111_21b3=='NA'?-1:$request->chemistry_c111_21b3;
      $equipment21->sub_indicator_212bh = $request->chemistry_c111_21b7=='NA'?-1:$request->chemistry_c111_21b7;
      $equipment21->sub_indicator_213ac = $request->haematology_huma600_21a2=='NA'?-1:$request->haematology_huma600_21a2;
      $equipment21->sub_indicator_213ad = $request->haematology_huma600_21a3=='NA'?-1:$request->haematology_huma600_21a3;
      $equipment21->sub_indicator_213ah = $request->haematology_huma600_21a7=='NA'?-1:$request->haematology_huma600_21a7;

      $equipment21->sub_indicator_213bc = $request->haematology_huma30TS_21b2=='NA'?-1:$request->haematology_huma30TS_21b2;
      $equipment21->sub_indicator_213bd = $request->haematology_huma30TS_21b3=='NA'?-1:$request->haematology_huma30TS_21b3;
      $equipment21->sub_indicator_213bh = $request->haematology_huma30TS_21b7=='NA'?-1:$request->haematology_huma30TS_21b7;

      $equipment21->sub_indicator_213cc = $request->haematology_huma60TS_21c2=='NA'?-1:$request->haematology_huma60TS_21c2;
      $equipment21->sub_indicator_213cd = $request->haematology_huma60TS_21c3=='NA'?-1:$request->haematology_huma60TS_21c3;
      $equipment21->sub_indicator_213ch = $request->haematology_huma60TS_21c7=='NA'?-1:$request->haematology_huma60TS_21c7;

      $equipment21->sub_indicator_213dc = $request->haematology_mind3200_21e2=='NA'?-1:$request->haematology_mind3200_21e2;
      $equipment21->sub_indicator_213dd = $request->haematology_mind3200_21e3=='NA'?-1:$request->haematology_mind3200_21e3;
      $equipment21->sub_indicator_213dh = $request->haematology_mind3200_21e7=='NA'?-1:$request->haematology_mind3200_21e7;

      $equipment21->sub_indicator_213ec = $request->haematology_mind3000_21f2=='NA'?-1:$request->haematology_mind3000_21f2;
      $equipment21->sub_indicator_213ed = $request->haematology_mind3000_21f3=='NA'?-1:$request->haematology_mind3000_21f3;
      $equipment21->sub_indicator_213eh = $request->haematology_mind3000_21f7=='NA'?-1:$request->haematology_mind3000_21f7;

      $equipment21->sub_indicator_213fc = $request->haematology_mind2800_21j2=='NA'?-1:$request->haematology_mind2800_21j2;
      $equipment21->sub_indicator_213fd = $request->haematology_mind2800_21j3=='NA'?-1:$request->haematology_mind2800_21j3;
      $equipment21->sub_indicator_213fh = $request->haematology_mind2800_21j7=='NA'?-1:$request->haematology_mind2800_21j7;

      $equipment21->sub_indicator_213gc = $request->haematology_mind2300_21i2=='NA'?-1:$request->haematology_mind2300_21i2;
      $equipment21->sub_indicator_213gd = $request->haematology_mind2300_21i3=='NA'?-1:$request->haematology_mind2300_21i3;
      $equipment21->sub_indicator_213gh = $request->haematology_mind2300_21i7=='NA'?-1:$request->haematology_mind2300_21i7;

      $equipment21->sub_indicator_213hc = $request->haematology_medonic_21k2=='NA'?-1:$request->haematology_medonic_21k2;
      $equipment21->sub_indicator_213hd = $request->haematology_medonic_21k3=='NA'?-1:$request->haematology_medonic_21k3;
      $equipment21->sub_indicator_213hh = $request->haematology_medonic_21k7=='NA'?-1:$request->haematology_medonic_21k7;

      $equipment21->sub_indicator_213ic = $request->haematology_sysmex100_21g2=='NA'?-1:$request->haematology_sysmex100_21g2;
      $equipment21->sub_indicator_213id = $request->haematology_sysmex100_21g3=='NA'?-1:$request->haematology_sysmex100_21g3;
      $equipment21->sub_indicator_213ih = $request->haematology_sysmex100_21g7=='NA'?-1:$request->haematology_sysmex100_21g7;

      $equipment21->sub_indicator_213jc = $request->haematology_sysmex300_21h2=='NA'?-1:$request->haematology_sysmex300_21h2;
      $equipment21->sub_indicator_213jd = $request->haematology_sysmex300_21h3=='NA'?-1:$request->haematology_sysmex300_21h3;
      $equipment21->sub_indicator_213jh = $request->haematology_sysmex300_21h7=='NA'?-1:$request->haematology_sysmex300_21h7;


      $equipment21->indicator_21_comments  = $request->lab_equipment_21_comments;

      $equipment21_response = $equipment21->save();

    }

    $indicators = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();
    if($indicators == null )
    {

      //save indicator summary scores
      $indicator_score = new IndicatorScoreSummary;

      $indicator_score->indicator18_score = $request->indicator18_score;
      $indicator_score->indicator19_score = $request->indicator19_score;
      $indicator_score->indicator20_score = $request->indicator20_score;
      $indicator_score->indicator21_score = $request->indicator21_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->created_by = Auth::user()->id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->save();
    }

    else
    {

      //save indicator summary scores
      $indicator_score = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();

      $indicator_score->indicator18_score = $request->indicator18_score;
      $indicator_score->indicator19_score = $request->indicator19_score;
      $indicator_score->indicator20_score = $request->indicator20_score;
      $indicator_score->indicator21_score = $request->indicator21_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->updated_by = Auth::user()->id;
      $indicator_score->save();

    }


    return response()->json([ 'equipment18' => $equipment18_response,
    'equipment19' => $equipment19_response,
    'equipment20' => $equipment20_response,
    'equipment21' => $equipment21_response ]);
  }

  public function saveLabInfoSystem(Request $request)
  {

    $summary = SurveySummary::where('form_id','=',$request->form_id)->first();

    $summary->step = 5;
    $summary->save();

    $information_system22 = $information_system23 = $information_system24 = $information_system25 = $information_system26 = $information_system27 = null;


    //save information system 22
    $information_system22 = InformationSystem22::where('survey_summary_id',$summary->id)->first();

    if($information_system22 == null )
    {

      $information_system22 = new InformationSystem22;
      $information_system22->health_facility_id = $summary->health_facility_id;
      $information_system22->survey_summary_id = $summary->id;
      $information_system22->visit_date = $summary->visit_date;
      $information_system22->form_id = $summary->form_id;
      $information_system22->created_by = Auth::user()->id;

      $information_system22->sub_indicator_22a = $request->lab_info_system_22a=='NA'?-1:$request->lab_info_system_22a;
      $information_system22->sub_indicator_22b = $request->lab_info_system_22b=='NA'?-1:$request->lab_info_system_22b;
      $information_system22->sub_indicator_22c = $request->lab_info_system_22c=='NA'?-1:$request->lab_info_system_22c;
      $information_system22->sub_indicator_22d = $request->lab_info_system_22d=='NA'?-1:$request->lab_info_system_22d;
      $information_system22->sub_indicator_22e = $request->lab_info_system_22e=='NA'?-1:$request->lab_info_system_22e;
      $information_system22->sub_indicator_22f = $request->lab_info_system_22f=='NA'?-1:$request->lab_info_system_22f;
      $information_system22->sub_indicator_22g = $request->lab_info_system_22g=='NA'?-1:$request->lab_info_system_22g;
      $information_system22->sub_indicator_22h = $request->lab_info_system_22h=='NA'?-1:$request->lab_info_system_22h;
      $information_system22->sub_indicator_22i = $request->lab_info_system_22i=='NA'?-1:$request->lab_info_system_22i;
      $information_system22->sub_indicator_22j = $request->lab_info_system_22j=='NA'?-1:$request->lab_info_system_22j;
      $information_system22->sub_indicator_22k = $request->lab_info_system_22k=='NA'?-1:$request->lab_info_system_22k;
      $information_system22->sub_indicator_22l = $request->lab_info_system_22l=='NA'?-1:$request->lab_info_system_22l;
      $information_system22->sub_indicator_22m = $request->lab_info_system_22m=='NA'?-1:$request->lab_info_system_22m;
      $information_system22->sub_indicator_22n = $request->lab_info_system_22n=='NA'?-1:$request->lab_info_system_22n;

      $information_system22->indicator_22_comments  = $request->lab_info_system_22_comments;
      $information_system22->upload_status  = 0;

      $info_system22_response = $information_system22->save();

    }

    else
    {

      $information_system22 = InformationSystem22::where('survey_summary_id',$summary->id)->first();
      $information_system22->health_facility_id = $summary->health_facility_id;
      $information_system22->survey_summary_id = $summary->id;
      $information_system22->visit_date = $summary->visit_date;
      $information_system22->form_id = $summary->form_id;
      $information_system22->updated_by = Auth::user()->id;

      $information_system22->sub_indicator_22a = $request->lab_info_system_22a=='NA'?-1:$request->lab_info_system_22a;
      $information_system22->sub_indicator_22b = $request->lab_info_system_22b=='NA'?-1:$request->lab_info_system_22b;
      $information_system22->sub_indicator_22c = $request->lab_info_system_22c=='NA'?-1:$request->lab_info_system_22c;
      $information_system22->sub_indicator_22d = $request->lab_info_system_22d=='NA'?-1:$request->lab_info_system_22d;
      $information_system22->sub_indicator_22e = $request->lab_info_system_22e=='NA'?-1:$request->lab_info_system_22e;
      $information_system22->sub_indicator_22f = $request->lab_info_system_22f=='NA'?-1:$request->lab_info_system_22f;
      $information_system22->sub_indicator_22g = $request->lab_info_system_22g=='NA'?-1:$request->lab_info_system_22g;
      $information_system22->sub_indicator_22h = $request->lab_info_system_22h=='NA'?-1:$request->lab_info_system_22h;
      $information_system22->sub_indicator_22i = $request->lab_info_system_22i=='NA'?-1:$request->lab_info_system_22i;
      $information_system22->sub_indicator_22j = $request->lab_info_system_22j=='NA'?-1:$request->lab_info_system_22j;
      $information_system22->sub_indicator_22k = $request->lab_info_system_22k=='NA'?-1:$request->lab_info_system_22k;
      $information_system22->sub_indicator_22l = $request->lab_info_system_22l=='NA'?-1:$request->lab_info_system_22l;
      $information_system22->sub_indicator_22m = $request->lab_info_system_22m=='NA'?-1:$request->lab_info_system_22m;
      $information_system22->sub_indicator_22n = $request->lab_info_system_22n=='NA'?-1:$request->lab_info_system_22n;

      $information_system22->indicator_22_comments  = $request->lab_info_system_22_comments;

      $info_system22_response = $information_system22->save();

    }

    //save information system 23
    $information_system23 = InformationSystem23::where('survey_summary_id',$summary->id)->first();
    if($information_system23 == null )
    {

      $information_system23 = new InformationSystem23;
      $information_system23->health_facility_id = $summary->health_facility_id;
      $information_system23->survey_summary_id = $summary->id;
      $information_system23->visit_date = $summary->visit_date;
      $information_system23->form_id = $summary->form_id;
      $information_system23->created_by = Auth::user()->id;

      $information_system23->sub_indicator_23a = $request->lab_info_system_23a=='NA'?-1:$request->lab_info_system_23a;
      $information_system23->sub_indicator_23b = $request->lab_info_system_23b=='NA'?-1:$request->lab_info_system_23b;

      $information_system23->indicator_23_comments  = $request->lab_info_system_23_comments;
      $information_system23->upload_status = 0;

      $info_system23_response = $information_system23->save();

    }
    else
    {

      $information_system23 = InformationSystem23::where('survey_summary_id',$summary->id)->first();
      $information_system23->health_facility_id = $summary->health_facility_id;
      $information_system23->survey_summary_id = $summary->id;
      $information_system23->visit_date = $summary->visit_date;
      $information_system23->form_id = $summary->form_id;
      $information_system23->created_by = Auth::user()->id;

      $information_system23->sub_indicator_23a = $request->lab_info_system_23a=='NA'?-1:$request->lab_info_system_23a;
      $information_system23->sub_indicator_23b = $request->lab_info_system_23b=='NA'?-1:$request->lab_info_system_23b;

      $information_system23->indicator_23_comments  = $request->lab_info_system_23_comments;

      $info_system23_response = $information_system23->save();

    }

    //save information system 24
    $information_system24 = InformationSystem24::where('survey_summary_id',$summary->id)->first();
    if($information_system24 == null )
    {

      $information_system24 = new InformationSystem24;


      $information_system24->sub_indicator_24a = DateTime::createFromFormat('d F Y', $request->lab_info_system_24a);
      $information_system24->sub_indicator_24b = DateTime::createFromFormat('d F Y', $request->lab_info_system_24b);

      $information_system24->health_facility_id = $summary->health_facility_id;
      $information_system24->survey_summary_id = $summary->id;
      $information_system24->visit_date = $summary->visit_date;
      $information_system24->form_id = $summary->form_id;
      $information_system24->upload_status = 0;
      $information_system24->created_by = Auth::user()->id;


      $information_system24->sub_indicator_24c = $request->lab_info_system_24c=='NA'?-1:$request->lab_info_system_24c;

      $information_system24->indicator_24_comments  = $request->lab_info_system_24_comments;

      $info_system24_response = $information_system24->save();

    }
    else
    {

      $information_system24 = InformationSystem24::where('survey_summary_id',$summary->id)->first();


      $information_system24->sub_indicator_24a = DateTime::createFromFormat('d F Y', $request->lab_info_system_24a);
      $information_system24->sub_indicator_24b = DateTime::createFromFormat('d F Y', $request->lab_info_system_24b);

      $information_system24->health_facility_id = $summary->health_facility_id;
      $information_system24->survey_summary_id = $summary->id;
      $information_system24->visit_date = $summary->visit_date;
      $information_system24->form_id = $summary->form_id;
      $information_system24->updated_by = Auth::user()->id;


      $information_system24->sub_indicator_24c = $request->lab_info_system_24c=='NA'?-1:$request->lab_info_system_24c;

      $information_system24->indicator_24_comments  = $request->lab_info_system_24_comments;

      $info_system24_response = $information_system24->save();

    }


    //save information system 25
    $information_system25 = InformationSystem25::where('survey_summary_id',$summary->id)->first();
    if($information_system25 == null )
    {

      $information_system25 = new InformationSystem25;
      $information_system25->health_facility_id = $summary->health_facility_id;
      $information_system25->survey_summary_id = $summary->id;
      $information_system25->visit_date = $summary->visit_date;
      $information_system25->form_id = $summary->form_id;
      $information_system25->created_by = Auth::user()->id;

      $information_system25->sub_indicator_25aa =  DateTime::createFromFormat('d F Y',$request->lab_info_system_25a);
      $information_system25->sub_indicator_25ab = $request->lab_info_system_25b=='NA'?-1:$request->lab_info_system_25b;
      $information_system25->sub_indicator_25ac = $request->lab_info_system_25c=='NA'?-1:$request->lab_info_system_25c;

      $information_system25->sub_indicator_25ba1 = $request->lab_info_system_25ba1=='NA'?-1:$request->lab_info_system_25ba1;
      $information_system25->sub_indicator_25ba2 = $request->lab_info_system_25ba2=='NA'?-1:$request->lab_info_system_25ba2;
      $information_system25->sub_indicator_25ba3 = $request->lab_info_system_25ba3=='NA'?-1:$request->lab_info_system_25ba3;
      $information_system25->sub_indicator_25ba4 = $request->lab_info_system_25ba4=='NA'?-1:$request->lab_info_system_25ba4;
      $information_system25->sub_indicator_25ba5 = $request->lab_info_system_25ba5=='NA'?-1:$request->lab_info_system_25ba5;
      $information_system25->sub_indicator_25ba6 = $request->lab_info_system_25ba6=='NA'?-1:$request->lab_info_system_25ba6;
      $information_system25->sub_indicator_25ba7 = $request->lab_info_system_25ba7=='NA'?-1:$request->lab_info_system_25ba7;
      $information_system25->sub_indicator_25ba8 = $request->lab_info_system_25ba8=='NA'?-1:$request->lab_info_system_25ba8;


      $information_system25->sub_indicator_25bb1 = $request->lab_info_system_25bb1=='NA'?-1:$request->lab_info_system_25bb1;
      $information_system25->sub_indicator_25bb2 = $request->lab_info_system_25bb2=='NA'?-1:$request->lab_info_system_25bb2;
      $information_system25->sub_indicator_25bb3 = $request->lab_info_system_25bb3=='NA'?-1:$request->lab_info_system_25bb3;
      $information_system25->sub_indicator_25bb4 = $request->lab_info_system_25bb4=='NA'?-1:$request->lab_info_system_25bb4;
      $information_system25->sub_indicator_25bb5 = $request->lab_info_system_25bb5=='NA'?-1:$request->lab_info_system_25bb5;
      $information_system25->sub_indicator_25bb6 = $request->lab_info_system_25bb6=='NA'?-1:$request->lab_info_system_25bb6;
      $information_system25->sub_indicator_25bb7 = $request->lab_info_system_25bb7=='NA'?-1:$request->lab_info_system_25bb7;
      $information_system25->sub_indicator_25bb8 = $request->lab_info_system_25bb8=='NA'?-1:$request->lab_info_system_25bb8;


      $information_system25->sub_indicator_25bc1 = $request->lab_info_system_25bc1=='NA'?-1:$request->lab_info_system_25bc1;
      $information_system25->sub_indicator_25bc2 = $request->lab_info_system_25bc2=='NA'?-1:$request->lab_info_system_25bc2;
      $information_system25->sub_indicator_25bc3 = $request->lab_info_system_25bc3=='NA'?-1:$request->lab_info_system_25bc3;
      $information_system25->sub_indicator_25bc4 = $request->lab_info_system_25bc4=='NA'?-1:$request->lab_info_system_25bc4;
      $information_system25->sub_indicator_25bc5 = $request->lab_info_system_25bc5=='NA'?-1:$request->lab_info_system_25bc5;
      $information_system25->sub_indicator_25bc6 = $request->lab_info_system_25bc6=='NA'?-1:$request->lab_info_system_25bc6;
      $information_system25->sub_indicator_25bc7 = $request->lab_info_system_25bc7=='NA'?-1:$request->lab_info_system_25bc7;
      $information_system25->sub_indicator_25bc8 = $request->lab_info_system_25bc8=='NA'?-1:$request->lab_info_system_25bc8;


      $information_system25->sub_indicator_cd4item = $request->cd4_testing=='NA'?-1:$request->cd4_testing;
      $information_system25->sub_indicator_25bd1 = $request->lab_info_system_25bd1=='NA'?-1:$request->lab_info_system_25bd1;
      $information_system25->sub_indicator_25bd2 = $request->lab_info_system_25bd2=='NA'?-1:$request->lab_info_system_25bd2;
      $information_system25->sub_indicator_25bd3 = $request->lab_info_system_25bd3=='NA'?-1:$request->lab_info_system_25bd3;
      $information_system25->sub_indicator_25bd4 = $request->lab_info_system_25bd4=='NA'?-1:$request->lab_info_system_25bd4;
      $information_system25->sub_indicator_25bd5 = $request->lab_info_system_25bd5=='NA'?-1:$request->lab_info_system_25bd5;
      $information_system25->sub_indicator_25bd6 = $request->lab_info_system_25bd6=='NA'?-1:$request->lab_info_system_25bd6;
      $information_system25->sub_indicator_25bd7 = $request->lab_info_system_25bd7=='NA'?-1:$request->lab_info_system_25bd7;
      $information_system25->sub_indicator_25bd8 = $request->lab_info_system_25bd8=='NA'?-1:$request->lab_info_system_25bd8;

      $information_system25->sub_indicator_25be1 = $request->lab_info_system_25be1=='NA'?-1:$request->lab_info_system_25be1;
      $information_system25->sub_indicator_25be2 = $request->lab_info_system_25be2=='NA'?-1:$request->lab_info_system_25be2;
      $information_system25->sub_indicator_25be3 = $request->lab_info_system_25be3=='NA'?-1:$request->lab_info_system_25be3;
      $information_system25->sub_indicator_25be4 = $request->lab_info_system_25be4=='NA'?-1:$request->lab_info_system_25be4;
      $information_system25->sub_indicator_25be5 = $request->lab_info_system_25be5=='NA'?-1:$request->lab_info_system_25be5;
      $information_system25->sub_indicator_25be6 = $request->lab_info_system_25be6=='NA'?-1:$request->lab_info_system_25be6;
      $information_system25->sub_indicator_25be7 = $request->lab_info_system_25be7=='NA'?-1:$request->lab_info_system_25be7;
      $information_system25->sub_indicator_25be8 = $request->lab_info_system_25be8=='NA'?-1:$request->lab_info_system_25be8;


      $information_system25->sub_indicator_25bf1 = $request->lab_info_system_25bf1=='NA'?-1:$request->lab_info_system_25bf1;
      $information_system25->sub_indicator_25bf2 = $request->lab_info_system_25bf2=='NA'?-1:$request->lab_info_system_25bf2;
      $information_system25->sub_indicator_25bf3 = $request->lab_info_system_25bf3=='NA'?-1:$request->lab_info_system_25bf3;
      $information_system25->sub_indicator_25bf4 = $request->lab_info_system_25bf4=='NA'?-1:$request->lab_info_system_25bf4;
      $information_system25->sub_indicator_25bf5 = $request->lab_info_system_25bf5=='NA'?-1:$request->lab_info_system_25bf5;
      $information_system25->sub_indicator_25bf6 = $request->lab_info_system_25bf6=='NA'?-1:$request->lab_info_system_25bf6;
      $information_system25->sub_indicator_25bf7 = $request->lab_info_system_25bf7=='NA'?-1:$request->lab_info_system_25bf7;
      $information_system25->sub_indicator_25bf8 = $request->lab_info_system_25bf8=='NA'?-1:$request->lab_info_system_25bf8;


      $information_system25->sub_indicator_25bg1 = $request->lab_info_system_25bg1=='NA'?-1:$request->lab_info_system_25bg1;
      $information_system25->sub_indicator_25bg2 = $request->lab_info_system_25bg2=='NA'?-1:$request->lab_info_system_25bg2;
      $information_system25->sub_indicator_25bg3 = $request->lab_info_system_25bg3=='NA'?-1:$request->lab_info_system_25bg3;
      $information_system25->sub_indicator_25bg4 = $request->lab_info_system_25bg4=='NA'?-1:$request->lab_info_system_25bg4;
      $information_system25->sub_indicator_25bg5 = $request->lab_info_system_25bg5=='NA'?-1:$request->lab_info_system_25bg5;
      $information_system25->sub_indicator_25bg6 = $request->lab_info_system_25bg6=='NA'?-1:$request->lab_info_system_25bg6;
      $information_system25->sub_indicator_25bg7 = $request->lab_info_system_25bg7=='NA'?-1:$request->lab_info_system_25bg7;
      $information_system25->sub_indicator_25bg8 = $request->lab_info_system_25bg8=='NA'?-1:$request->lab_info_system_25bg8;


      $information_system25->sub_indicator_25ca1 = $request->lab_info_system_25ca1=='NA'?-1:$request->lab_info_system_25ca1;
      $information_system25->sub_indicator_25ca2 = $request->lab_info_system_25ca2=='NA'?-1:$request->lab_info_system_25ca2;
      $information_system25->sub_indicator_25ca3 = $request->lab_info_system_25ca3=='NA'?-1:$request->lab_info_system_25ca3;
      $information_system25->sub_indicator_25ca4 = $request->lab_info_system_25ca4=='NA'?-1:$request->lab_info_system_25ca4;


      $information_system25->sub_indicator_25cb1 = $request->lab_info_system_25cb1=='NA'?-1:$request->lab_info_system_25cb1;
      $information_system25->sub_indicator_25cb2 = $request->lab_info_system_25cb2=='NA'?-1:$request->lab_info_system_25cb2;
      $information_system25->sub_indicator_25cb3 = $request->lab_info_system_25cb3=='NA'?-1:$request->lab_info_system_25cb3;
      $information_system25->sub_indicator_25cb4 = $request->lab_info_system_25cb4=='NA'?-1:$request->lab_info_system_25cb4;

      $information_system25->sub_indicator_25cc1 = $request->lab_info_system_25cc1=='NA'?-1:$request->lab_info_system_25cc1;
      $information_system25->sub_indicator_25cc2 = $request->lab_info_system_25cc2=='NA'?-1:$request->lab_info_system_25cc2;
      $information_system25->sub_indicator_25cc3 = $request->lab_info_system_25cc3=='NA'?-1:$request->lab_info_system_25cc3;
      $information_system25->sub_indicator_25cc4 = $request->lab_info_system_25cc4=='NA'?-1:$request->lab_info_system_25cc4;

      $information_system25->sub_indicator_25cd1 = $request->lab_info_system_25cd1=='NA'?-1:$request->lab_info_system_25cd1;
      $information_system25->sub_indicator_25cd2 = $request->lab_info_system_25cd2=='NA'?-1:$request->lab_info_system_25cd2;
      $information_system25->sub_indicator_25cd3 = $request->lab_info_system_25cd3=='NA'?-1:$request->lab_info_system_25cd3;
      $information_system25->sub_indicator_25cd4 = $request->lab_info_system_25cd4=='NA'?-1:$request->lab_info_system_25cd4;

      $information_system25->sub_indicator_25ce1 = $request->lab_info_system_25ce1=='NA'?-1:$request->lab_info_system_25ce1;
      $information_system25->sub_indicator_25ce2 = $request->lab_info_system_25ce2=='NA'?-1:$request->lab_info_system_25ce2;
      $information_system25->sub_indicator_25ce3 = $request->lab_info_system_25ce3=='NA'?-1:$request->lab_info_system_25ce3;
      $information_system25->sub_indicator_25ce4 = $request->lab_info_system_25ce4=='NA'?-1:$request->lab_info_system_25ce4;

      $information_system25->sub_indicator_25cf1 = $request->lab_info_system_25cf1=='NA'?-1:$request->lab_info_system_25cf1;
      $information_system25->sub_indicator_25cf2 = $request->lab_info_system_25cf2=='NA'?-1:$request->lab_info_system_25cf2;
      $information_system25->sub_indicator_25cf3 = $request->lab_info_system_25cf3=='NA'?-1:$request->lab_info_system_25cf3;
      $information_system25->sub_indicator_25cf4 = $request->lab_info_system_25cf4=='NA'?-1:$request->lab_info_system_25cf4;

      $information_system25->indicator_25_comments  = $request->lab_info_system_25_comments;
      $information_system25->upload_status  = 0;

      $info_system25_response = $information_system25->save();

    }
    else
    {

      $information_system25 = InformationSystem25::where('survey_summary_id',$summary->id)->first();
      $information_system25->health_facility_id = $summary->health_facility_id;
      $information_system25->survey_summary_id = $summary->id;
      $information_system25->visit_date = $summary->visit_date;
      $information_system25->form_id = $summary->form_id;
      $information_system25->updated_by = Auth::user()->id;

      $information_system25->sub_indicator_25aa =  DateTime::createFromFormat('d F Y',$request->lab_info_system_25a);
      $information_system25->sub_indicator_25ab = $request->lab_info_system_25b=='NA'?-1:$request->lab_info_system_25b;
      $information_system25->sub_indicator_25ac = $request->lab_info_system_25c=='NA'?-1:$request->lab_info_system_25c;

      $information_system25->sub_indicator_25ba1 = $request->lab_info_system_25ba1=='NA'?-1:$request->lab_info_system_25ba1;
      $information_system25->sub_indicator_25ba2 = $request->lab_info_system_25ba2=='NA'?-1:$request->lab_info_system_25ba2;
      $information_system25->sub_indicator_25ba3 = $request->lab_info_system_25ba3=='NA'?-1:$request->lab_info_system_25ba3;
      $information_system25->sub_indicator_25ba4 = $request->lab_info_system_25ba4=='NA'?-1:$request->lab_info_system_25ba4;
      $information_system25->sub_indicator_25ba5 = $request->lab_info_system_25ba5=='NA'?-1:$request->lab_info_system_25ba5;
      $information_system25->sub_indicator_25ba6 = $request->lab_info_system_25ba6=='NA'?-1:$request->lab_info_system_25ba6;
      $information_system25->sub_indicator_25ba7 = $request->lab_info_system_25ba7=='NA'?-1:$request->lab_info_system_25ba7;
      $information_system25->sub_indicator_25ba8 = $request->lab_info_system_25ba8=='NA'?-1:$request->lab_info_system_25ba8;


      $information_system25->sub_indicator_25bb1 = $request->lab_info_system_25bb1=='NA'?-1:$request->lab_info_system_25bb1;
      $information_system25->sub_indicator_25bb2 = $request->lab_info_system_25bb2=='NA'?-1:$request->lab_info_system_25bb2;
      $information_system25->sub_indicator_25bb3 = $request->lab_info_system_25bb3=='NA'?-1:$request->lab_info_system_25bb3;
      $information_system25->sub_indicator_25bb4 = $request->lab_info_system_25bb4=='NA'?-1:$request->lab_info_system_25bb4;
      $information_system25->sub_indicator_25bb5 = $request->lab_info_system_25bb5=='NA'?-1:$request->lab_info_system_25bb5;
      $information_system25->sub_indicator_25bb6 = $request->lab_info_system_25bb6=='NA'?-1:$request->lab_info_system_25bb6;
      $information_system25->sub_indicator_25bb7 = $request->lab_info_system_25bb7=='NA'?-1:$request->lab_info_system_25bb7;
      $information_system25->sub_indicator_25bb8 = $request->lab_info_system_25bb8=='NA'?-1:$request->lab_info_system_25bb8;


      $information_system25->sub_indicator_25bc1 = $request->lab_info_system_25bc1=='NA'?-1:$request->lab_info_system_25bc1;
      $information_system25->sub_indicator_25bc2 = $request->lab_info_system_25bc2=='NA'?-1:$request->lab_info_system_25bc2;
      $information_system25->sub_indicator_25bc3 = $request->lab_info_system_25bc3=='NA'?-1:$request->lab_info_system_25bc3;
      $information_system25->sub_indicator_25bc4 = $request->lab_info_system_25bc4=='NA'?-1:$request->lab_info_system_25bc4;
      $information_system25->sub_indicator_25bc5 = $request->lab_info_system_25bc5=='NA'?-1:$request->lab_info_system_25bc5;
      $information_system25->sub_indicator_25bc6 = $request->lab_info_system_25bc6=='NA'?-1:$request->lab_info_system_25bc6;
      $information_system25->sub_indicator_25bc7 = $request->lab_info_system_25bc7=='NA'?-1:$request->lab_info_system_25bc7;
      $information_system25->sub_indicator_25bc8 = $request->lab_info_system_25bc8=='NA'?-1:$request->lab_info_system_25bc8;


      $information_system25->sub_indicator_cd4item = $request->cd4_testing=='NA'?-1:$request->cd4_testing;
      $information_system25->sub_indicator_25bd1 = $request->lab_info_system_25bd1=='NA'?-1:$request->lab_info_system_25bd1;
      $information_system25->sub_indicator_25bd2 = $request->lab_info_system_25bd2=='NA'?-1:$request->lab_info_system_25bd2;
      $information_system25->sub_indicator_25bd3 = $request->lab_info_system_25bd3=='NA'?-1:$request->lab_info_system_25bd3;
      $information_system25->sub_indicator_25bd4 = $request->lab_info_system_25bd4=='NA'?-1:$request->lab_info_system_25bd4;
      $information_system25->sub_indicator_25bd5 = $request->lab_info_system_25bd5=='NA'?-1:$request->lab_info_system_25bd5;
      $information_system25->sub_indicator_25bd6 = $request->lab_info_system_25bd6=='NA'?-1:$request->lab_info_system_25bd6;
      $information_system25->sub_indicator_25bd7 = $request->lab_info_system_25bd7=='NA'?-1:$request->lab_info_system_25bd7;
      $information_system25->sub_indicator_25bd8 = $request->lab_info_system_25bd8=='NA'?-1:$request->lab_info_system_25bd8;

      $information_system25->sub_indicator_25be1 = $request->lab_info_system_25be1=='NA'?-1:$request->lab_info_system_25be1;
      $information_system25->sub_indicator_25be2 = $request->lab_info_system_25be2=='NA'?-1:$request->lab_info_system_25be2;
      $information_system25->sub_indicator_25be3 = $request->lab_info_system_25be3=='NA'?-1:$request->lab_info_system_25be3;
      $information_system25->sub_indicator_25be4 = $request->lab_info_system_25be4=='NA'?-1:$request->lab_info_system_25be4;
      $information_system25->sub_indicator_25be5 = $request->lab_info_system_25be5=='NA'?-1:$request->lab_info_system_25be5;
      $information_system25->sub_indicator_25be6 = $request->lab_info_system_25be6=='NA'?-1:$request->lab_info_system_25be6;
      $information_system25->sub_indicator_25be7 = $request->lab_info_system_25be7=='NA'?-1:$request->lab_info_system_25be7;
      $information_system25->sub_indicator_25be8 = $request->lab_info_system_25be8=='NA'?-1:$request->lab_info_system_25be8;


      $information_system25->sub_indicator_25bf1 = $request->lab_info_system_25bf1=='NA'?-1:$request->lab_info_system_25bf1;
      $information_system25->sub_indicator_25bf2 = $request->lab_info_system_25bf2=='NA'?-1:$request->lab_info_system_25bf2;
      $information_system25->sub_indicator_25bf3 = $request->lab_info_system_25bf3=='NA'?-1:$request->lab_info_system_25bf3;
      $information_system25->sub_indicator_25bf4 = $request->lab_info_system_25bf4=='NA'?-1:$request->lab_info_system_25bf4;
      $information_system25->sub_indicator_25bf5 = $request->lab_info_system_25bf5=='NA'?-1:$request->lab_info_system_25bf5;
      $information_system25->sub_indicator_25bf6 = $request->lab_info_system_25bf6=='NA'?-1:$request->lab_info_system_25bf6;
      $information_system25->sub_indicator_25bf7 = $request->lab_info_system_25bf7=='NA'?-1:$request->lab_info_system_25bf7;
      $information_system25->sub_indicator_25bf8 = $request->lab_info_system_25bf8=='NA'?-1:$request->lab_info_system_25bf8;


      $information_system25->sub_indicator_25bg1 = $request->lab_info_system_25bg1=='NA'?-1:$request->lab_info_system_25bg1;
      $information_system25->sub_indicator_25bg2 = $request->lab_info_system_25bg2=='NA'?-1:$request->lab_info_system_25bg2;
      $information_system25->sub_indicator_25bg3 = $request->lab_info_system_25bg3=='NA'?-1:$request->lab_info_system_25bg3;
      $information_system25->sub_indicator_25bg4 = $request->lab_info_system_25bg4=='NA'?-1:$request->lab_info_system_25bg4;
      $information_system25->sub_indicator_25bg5 = $request->lab_info_system_25bg5=='NA'?-1:$request->lab_info_system_25bg5;
      $information_system25->sub_indicator_25bg6 = $request->lab_info_system_25bg6=='NA'?-1:$request->lab_info_system_25bg6;
      $information_system25->sub_indicator_25bg7 = $request->lab_info_system_25bg7=='NA'?-1:$request->lab_info_system_25bg7;
      $information_system25->sub_indicator_25bg8 = $request->lab_info_system_25bg8=='NA'?-1:$request->lab_info_system_25bg8;


      $information_system25->sub_indicator_25ca1 = $request->lab_info_system_25ca1=='NA'?-1:$request->lab_info_system_25ca1;
      $information_system25->sub_indicator_25ca2 = $request->lab_info_system_25ca2=='NA'?-1:$request->lab_info_system_25ca2;
      $information_system25->sub_indicator_25ca3 = $request->lab_info_system_25ca3=='NA'?-1:$request->lab_info_system_25ca3;
      $information_system25->sub_indicator_25ca4 = $request->lab_info_system_25ca4=='NA'?-1:$request->lab_info_system_25ca4;


      $information_system25->sub_indicator_25cb1 = $request->lab_info_system_25cb1=='NA'?-1:$request->lab_info_system_25cb1;
      $information_system25->sub_indicator_25cb2 = $request->lab_info_system_25cb2=='NA'?-1:$request->lab_info_system_25cb2;
      $information_system25->sub_indicator_25cb3 = $request->lab_info_system_25cb3=='NA'?-1:$request->lab_info_system_25cb3;
      $information_system25->sub_indicator_25cb4 = $request->lab_info_system_25cb4=='NA'?-1:$request->lab_info_system_25cb4;

      $information_system25->sub_indicator_25cc1 = $request->lab_info_system_25cc1=='NA'?-1:$request->lab_info_system_25cc1;
      $information_system25->sub_indicator_25cc2 = $request->lab_info_system_25cc2=='NA'?-1:$request->lab_info_system_25cc2;
      $information_system25->sub_indicator_25cc3 = $request->lab_info_system_25cc3=='NA'?-1:$request->lab_info_system_25cc3;
      $information_system25->sub_indicator_25cc4 = $request->lab_info_system_25cc4=='NA'?-1:$request->lab_info_system_25cc4;

      $information_system25->sub_indicator_25cd1 = $request->lab_info_system_25cd1=='NA'?-1:$request->lab_info_system_25cd1;
      $information_system25->sub_indicator_25cd2 = $request->lab_info_system_25cd2=='NA'?-1:$request->lab_info_system_25cd2;
      $information_system25->sub_indicator_25cd3 = $request->lab_info_system_25cd3=='NA'?-1:$request->lab_info_system_25cd3;
      $information_system25->sub_indicator_25cd4 = $request->lab_info_system_25cd4=='NA'?-1:$request->lab_info_system_25cd4;

      $information_system25->sub_indicator_25ce1 = $request->lab_info_system_25ce1=='NA'?-1:$request->lab_info_system_25ce1;
      $information_system25->sub_indicator_25ce2 = $request->lab_info_system_25ce2=='NA'?-1:$request->lab_info_system_25ce2;
      $information_system25->sub_indicator_25ce3 = $request->lab_info_system_25ce3=='NA'?-1:$request->lab_info_system_25ce3;
      $information_system25->sub_indicator_25ce4 = $request->lab_info_system_25ce4=='NA'?-1:$request->lab_info_system_25ce4;

      $information_system25->sub_indicator_25cf1 = $request->lab_info_system_25cf1=='NA'?-1:$request->lab_info_system_25cf1;
      $information_system25->sub_indicator_25cf2 = $request->lab_info_system_25cf2=='NA'?-1:$request->lab_info_system_25cf2;
      $information_system25->sub_indicator_25cf3 = $request->lab_info_system_25cf3=='NA'?-1:$request->lab_info_system_25cf3;
      $information_system25->sub_indicator_25cf4 = $request->lab_info_system_25cf4=='NA'?-1:$request->lab_info_system_25cf4;

      $information_system25->indicator_25_comments  = $request->lab_info_system_25_comments;

      $info_system25_response = $information_system25->save();

    }


    //save information system 26
    $information_system26 = InformationSystem26::where('survey_summary_id',$summary->id)->first();
    if($information_system26 == null )
    {

      $information_system26 = new InformationSystem26;
      $information_system26->health_facility_id = $summary->health_facility_id;
      $information_system26->survey_summary_id = $summary->id;
      $information_system26->visit_date = $summary->visit_date;
      $information_system26->form_id = $summary->form_id;
      $information_system26->created_by = Auth::user()->id;

      $information_system26->sub_indicator_26a = $request->lab_info_system_26a=='NA'?-1:$request->lab_info_system_26a;
      $information_system26->sub_indicator_26b = $request->lab_info_system_26b=='NA'?-1:$request->lab_info_system_26b;

      $information_system26->indicator_26_comments  = $request->lab_info_system_26_comments;
      $information_system26->upload_status  = 0;

      $info_system26_response = $information_system26->save();

    }

    else
    {

      $information_system26 = InformationSystem26::where('survey_summary_id',$summary->id)->first();
      $information_system26->health_facility_id = $summary->health_facility_id;
      $information_system26->survey_summary_id = $summary->id;
      $information_system26->visit_date = $summary->visit_date;
      $information_system26->form_id = $summary->form_id;
      $information_system26->created_by = Auth::user()->id;

      $information_system26->sub_indicator_26a = $request->lab_info_system_26a=='NA'?-1:$request->lab_info_system_26a;
      $information_system26->sub_indicator_26b = $request->lab_info_system_26b=='NA'?-1:$request->lab_info_system_26b;

      $information_system26->indicator_26_comments  = $request->lab_info_system_26_comments;

      $info_system26_response = $information_system26->save();

    }

    //save information system 27
    $information_system27 = InformationSystem27::where('survey_summary_id',$summary->id)->first();
    if($information_system27 == null )
    {

      $information_system27 = new InformationSystem27;

      $information_system27->health_facility_id = $summary->health_facility_id;
      $information_system27->survey_summary_id = $summary->id;
      $information_system27->visit_date = $summary->visit_date;
      $information_system27->form_id = $summary->form_id;
      $information_system27->created_by = Auth::user()->id;

      $information_system27->sub_indicator_27a = $request->lab_info_system_27a=='NA'?-1:$request->lab_info_system_27a;
      $information_system27->sub_indicator_27b = $request->lab_info_system_27b=='NA'?-1:$request->lab_info_system_27b;
      $information_system27->sub_indicator_27c = $request->lab_info_system_27c=='NA'?-1:$request->lab_info_system_27c;
      $information_system27->sub_indicator_27d = $request->lab_info_system_27d=='NA'?-1:$request->lab_info_system_27d;

      $information_system27->indicator_27_comments  = $request->lab_info_system_27_comments;
      $information_system27->upload_status  = 0;

      $info_system27_response = $information_system27->save();

    }

    else
    {

      $information_system27 = InformationSystem27::where('survey_summary_id',$summary->id)->first();

      $information_system27->health_facility_id = $summary->health_facility_id;
      $information_system27->survey_summary_id = $summary->id;
      $information_system27->visit_date = $summary->visit_date;
      $information_system27->form_id = $summary->form_id;
      $information_system27->updated_by = Auth::user()->id;

      $information_system27->sub_indicator_27a = $request->lab_info_system_27a=='NA'?-1:$request->lab_info_system_27a;
      $information_system27->sub_indicator_27b = $request->lab_info_system_27b=='NA'?-1:$request->lab_info_system_27b;
      $information_system27->sub_indicator_27c = $request->lab_info_system_27c=='NA'?-1:$request->lab_info_system_27c;
      $information_system27->sub_indicator_27d = $request->lab_info_system_27d=='NA'?-1:$request->lab_info_system_27d;

      $information_system27->indicator_27_comments  = $request->lab_info_system_27_comments;

      $info_system27_response = $information_system27->save();

    }

    $indicators = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();
    if($indicators == null )
    {

      //save indicator summary scores
      $indicator_score = new IndicatorScoreSummary;

      $indicator_score->indicator22_score = $request->indicator22_score;
      $indicator_score->indicator23_score = $request->indicator23_score;
      $indicator_score->indicator24_score = $request->indicator24_score;
      $indicator_score->indicator25_score = $request->indicator25_score;
      $indicator_score->indicator26_score = $request->indicator26_score;
      $indicator_score->indicator27_score = $request->indicator27_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->created_by = Auth::user()->id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->save();
    }
    else
    {

      //save indicator summary scores
      $indicator_score = IndicatorScoreSummary::where('survey_summary_id',$summary->id)->first();

      $indicator_score->indicator22_score = $request->indicator22_score;
      $indicator_score->indicator23_score = $request->indicator23_score;
      $indicator_score->indicator24_score = $request->indicator24_score;
      $indicator_score->indicator25_score = $request->indicator25_score;
      $indicator_score->indicator26_score = $request->indicator26_score;
      $indicator_score->indicator27_score = $request->indicator27_score;

      $indicator_score->health_facility_id = $summary->health_facility_id;
      $indicator_score->survey_summary_id = $summary->id;
      $indicator_score->visit_date = $summary->visit_date;
      $indicator_score->form_id = $summary->form_id;
      $indicator_score->visit_number = $summary->visit_number;
      $indicator_score->updated_by = Auth::user()->id;
      $indicator_score->save();

    }

    return response()->json([ 'info_system22' => $info_system22_response,
    'info_system23' => $info_system23_response,'info_system24' => $info_system24_response,
    'info_system25' => $info_system25_response,'info_system26' => $info_system26_response,
    'info_system27' => $info_system27_response ]);
  }

  public function endWizard(Request $request)
  {

    $summary = SurveySummary::where('form_id','=',$request->form_id)->first();

    $summary->step = 6;
    $summary->save();

    // redirect
    Session::flash('message', 'Form saved successfully. Form id is '.$request->form_id);
    Session::flash('alert-type', 'success');

    return Redirect::to('survey');

  }


  public function getStockManagement(Request $request)
  {

    $stock_management = StockManagement::where('form_id','=',$request->form_id)->first();
    $scores = IndicatorScoreSummary::where('form_id',$request->form_id)->first();

    return response()->json([ 'stock_management' => $stock_management ,'scores' => $scores ]);

  }


  public function getStorageManagement(Request $request)
  {

    $storage_management10 = StorageManagement10::where('form_id','=',$request->form_id)->first();
    $storage_management11 = StorageManagement11::where('form_id','=',$request->form_id)->first();
    $storage_management12 = StorageManagement12::where('form_id','=',$request->form_id)->first();
    $storage_management13 = StorageManagement13::where('form_id','=',$request->form_id)->first();
    $storage_management14 = StorageManagement14::where('form_id','=',$request->form_id)->first();
    $scores = IndicatorScoreSummary::where('form_id',$request->form_id)->first();

    return response()->json([ 'storage_management10' => $storage_management10 ,'storage_management11' => $storage_management11 ,'storage_management12' => $storage_management12 ,'storage_management13' => $storage_management13 ,'storage_management14' => $storage_management14 ,'scores' => $scores ]);

  }


  public function getOrdering(Request $request)
  {

    $ordering15 = Ordering15::where('form_id','=',$request->form_id)->first();
    $ordering16 = Ordering16::where('form_id','=',$request->form_id)->first();
    $ordering17 = Ordering17::where('form_id','=',$request->form_id)->first();
    $scores = IndicatorScoreSummary::where('form_id',$request->form_id)->first();

    return response()->json([ 'ordering15' => $ordering15 ,'ordering16' => $ordering16 ,'ordering17' => $ordering17  ,'scores' => $scores ]);

  }

  public function getEquipment(Request $request)
  {

    $equipment18 = Equipment18::where('form_id','=',$request->form_id)->first();
    $equipment19 = Equipment19::where('form_id','=',$request->form_id)->first();
    $equipment20 = Equipment20::where('form_id','=',$request->form_id)->first();
    $equipment21 = Equipment21::where('form_id','=',$request->form_id)->first();
    $scores = IndicatorScoreSummary::where('form_id',$request->form_id)->first();

    return response()->json([ 'equipment18' => $equipment18 ,'equipment19' => $equipment19 ,'equipment20' => $equipment20 ,'equipment21' => $equipment21 ,'scores' => $scores ]);

  }

  public function getLabInfoSystem(Request $request)
  {

    $lab_system22 = InformationSystem22::where('form_id','=',$request->form_id)->first();
    $lab_system23 = InformationSystem23::where('form_id','=',$request->form_id)->first();
    $lab_system24 = InformationSystem24::where('form_id','=',$request->form_id)->first();
    $lab_system25 = InformationSystem25::where('form_id','=',$request->form_id)->first();
    $lab_system26 = InformationSystem26::where('form_id','=',$request->form_id)->first();
    $lab_system27 = InformationSystem27::where('form_id','=',$request->form_id)->first();
    $scores = IndicatorScoreSummary::where('form_id',$request->form_id)->first();

    return response()->json([ 'lab_system22' => $lab_system22 ,'lab_system23' => $lab_system23 ,'lab_system24' => $lab_system24 ,'lab_system25' => $lab_system25 ,'lab_system26' => $lab_system26  ,'lab_system27' => $lab_system27 ,'scores' => $scores ]);

  }

  public function remoteUpload()
  {


    $surveysummary = SurveySummary::where('step', '=', 6)->where('upload_status', '=', 0)->get();


    foreach ($surveysummary as $value ) {
      // code...
      $vd = $value->visit_date;
      $nvd = $value->next_visit_date;
      $hf = $value->health_facility_id;
      $ca = $value->created_at;
      $ua = $value->updated_at;
      $fi = $value->form_id;
      $vn = $value->visit_number;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $st = $value->step;
      $fv = $value->form_version;
      // $us = $value->upload_status;

      DB::connection('mysql_remote')->insert('insert into survey_summary (visit_date, next_visit_date,health_facility_id, created_at, updated_at,form_id, visit_number, created_by, updated_by,step,form_version) values (?, ?,?, ?,?, ?,?, ?,?, ?,?)', [$vd,$nvd,$hf,$ca,$ua,$fi,$vn,$cb,$ub,$st,$fv]);

      DB::table('survey_summary')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }



    $supervised = SupervisedPerson::where('upload_status', '=', 0)->get();
    foreach ($supervised as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $fi = $value->form_id;
      $vd = $value->visit_date;
      $nm = $value->name;
      $gd = $value->gender;
      $ci = $value->cadre_id;
      $pn = $value->phone_number;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_supervised (health_facility_id,form_id,visit_date, name, gender,cadre_id,phone_number, created_by,updated_by,created_at, updated_at) values (?,?, ?,?, ?,?, ?,?, ?,?,?)', [$hf,$fi,$vd,$nm,$gd,$ci,$pn,$cb,$ub,$ca,$ua]);
      DB::table('spars_supervised')->where('upload_status','=',0)->update(['upload_status' => 1]);

    }

    $supervisor = Supervisor::where('upload_status', '=', 0)->get();
    foreach ($supervisor as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $fi = $value->form_id;
      $vd = $value->visit_date;
      $pi = $value->person_id;
      $cd = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;
      // $us = $value->upload_status;

     DB::connection('mysql_remote')->insert('insert into spars_supervisors (health_facility_id,form_id,visit_date, person_id, created_by,updated_by,created_at, updated_at) values (?,?,?,?,?,?,?,?)', [$hf,$fi,$vd,$pi,$cd,$ub,$ca,$ua]);
       DB::table('spars_supervisors')->where('upload_status','=',0)->update(['upload_status' => 1]);

    }

    $healthfacility = HealthFacility::where('upload_status', '=', 0)->get();
    foreach ($healthfacility as $value ) {
      // code...
        $dhi = $value->dhis2_uid;
        $rgn = $value->region;
        $dst = $value->district;
        $hsd = $value->hsd;
        $fc = $value->facility;
        $lvl = $value->level;
        $own = $value->ownership;
        $ifn = $value->in_charge_fname;
        $iln = $value->in_charge_lname;
        $ic = $value->in_charge_contact;
        $lfn = $value->lss_fname;
        $lfn = $value->lss_lname;
        $lct = $value->lss_contact;
        $vn = $value->visit_number;
        $icf = $value->is_control_facility;
        // $us = $value->upload_status;

     DB::connection('mysql_remote')->insert('insert into health_facilities (dhis2_uid,region,district, hsd,facility, level, ownership,in_charge_fname, in_charge_lname, in_charge_contact, lss_fname, lss_lname, lss_contact,visit_number, is_control_facility) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$dhi,$rgn,$dst,$hsd,$fc,$lvl,$own,$ifn,$iln,$ic,$lfn,$lfn,$lct,$vn,$icf]);
       DB::table('health_facilities')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $general = General::where('upload_status', '=', 0)->get();
    foreach ($general as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $fi = $value->form_id;
      $d1 = $value->d1;
      $d2a = $value->d2a;
      $d2b = $value->d2b;
      $d2c = $value->d2c;
      $d2d = $value->d2d;
      $d2e = $value->d2e;
      $d2f = $value->d2f;
      $d2c = $value->d2comment;
      $d3  = $value->d3;
      $d3ct = $value->d3comment;
      $d4a = $value->d4a;
      $d4b = $value->d4b;
      $d4c = $value->d4c;
      $d4d = $value->d4d;
      $d4e = $value->d4e;
      $d4f = $value->d4f;
      $d4ct = $value->d4comment;
      $d5 = $value->d5;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;
      // $upload_status;
      DB::connection('mysql_remote')->insert('insert into spars_general (health_facility_id,form_id,d1,d2a,d2b,d2c,d2d,d2e,d2f,d2comment,d3,d3comment,d4a,d4b,d4c,d4d,d4e,d4f,d4comment,d5,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$hf,$fi,$d1,$d2a,$d2b,$d2c,$d2d,$d2e,$d2f,$d2c,$d3,$d3ct,$d4a,$d4b,$d4c,$d4d,$d4e,$d4f,$d4ct,$d5,$vd,$cb,$ub,$ca,$ua]);
        DB::table('spars_general')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $stockMgt = StockManagement::where('upload_status', '=', 0)->get();
    foreach ($stockMgt as $value ) {
      // code...

      $health_facility_id = $value->health_facility_id;
      $survey_summary_id = $value->survey_summary_id;
      $form_id = $value->form_id;
      $r1c1 = $value->r1c1;
      $r1c2 = $value->r1c2;
      $r1c3 = $value->r1c3;
      $r1c4 = $value->r1c4;
      $r1c5 = $value->r1c5;
      $r1c6 = $value->r1c6;
      $r1c7 = $value->r1c7;
      $r1c8 = $value->r1c8;
      $r1c9 = $value->r1c9;
      $r1c10 = $value->r1c10;
      $r1c11 = $value->r1c11;
      $r1c12 = $value->r1c12;
      $r1c13 = $value->r1c13;
      $r1c14 = $value->r1c14;
      $r1c15 = $value->r1c15;
      $r1c16 = $value->r1c16;
      $r1c17 = $value->r1c17;
      $r1c18 = $value->r1c18;
      $r1c19 = $value->r1c19;
      $r1c20 = $value->r1c20;
      $r1c21 = $value->r1c21;
      $r1c22 = $value->r1c22;
      $r2c1 = $value->r2c1;
      $r2c2_cd4item = $value->r2c2;
      $r2c2 = $value->r2c2;
      $r2c3 = $value->r2c3;
      $r2c4 = $value->r2c4;
      $r2c5 = $value->r2c5;
      $r2c6 = $value->r2c6;
      $r2c7 = $value->r2c7;
      $r2c8 = $value->r2c8;
      $r2c9 = $value->r2c9;
      $r2c10 = $value->r2c10;
      $r2c11 = $value->r2c11;
      $r2c12 = $value->r2c12;
      $r2c13 = $value->r2c13;
      $r2c14 = $value->r2c14;
      $r2c15 = $value->r2c15;
      $r2c16 = $value->r2c16;
      $r2c17 = $value->r2c17;
      $r2c18 = $value->r2c18;
      $r2c19 = $value->r2c19;
      $r2c20 = $value->r2c20;
      $r2c21 = $value->r2c21;
      $r2c22 = $value->r2c22;
      $r3c1 = $value->r3c1;
      $r3c2 = $value->r3c2;
      $r3c3 = $value->r3c3;
      $r3c4 = $value->r3c4;
      $r3c5 = $value->r3c5;
      $r3c6 = $value->r3c6;
      $r3c7 = $value->r3c7;
      $r3c8 = $value->r3c8;
      $r3c9 = $value->r3c9;
      $r3c10 = $value->r3c10;
      $r3c11 = $value->r3c11;
      $r3c12 = $value->r3c12;
      $r3c13 = $value->r3c13;
      $r3c14 = $value->r3c14;
      $r3c15 = $value->r3c15;
      $r3c16 = $value->r3c16;
      $r3c17 = $value->r3c17;
      $r3c18 = $value->r3c18;
      $r3c19 = $value->r3c19;
      $r3c20 = $value->r3c20;
      $r3c21 = $value->r3c21;
      $r3c22 = $value->r3c22;
      $r4c1  = $value->r4c1;
      $r4c2  = $value->r4c2;
      $r4c3  = $value->r4c3;
      $r4c4  = $value->r4c4;
      $r4c5  = $value->r4c5;
      $r4c6  = $value->r4c6;
      $r4c7  = $value->r4c7;
      $r4c8  = $value->r4c8;
      $r4c9  = $value->r4c9;
      $r4c10 = $value->r4c10;
      $r4c11 = $value->r4c11;
      $r4c12 = $value->r4c12;
      $r4c13 = $value->r4c13;
      $r4c14 = $value->r4c14;
      $r4c15 = $value->r4c15;
      $r4c16 = $value->r4c16;
      $r4c17 = $value->r4c17;
      $r4c18 = $value->r4c18;
      $r4c19 = $value->r4c19;
      $r4c20 = $value->r4c20;
      $r4c21 = $value->r4c21;
      $r4c22 = $value->r4c22;
      $r5c1  = $value->r5c1;
      $r5c2  = $value->r5c2;
      $r5c3  = $value->r5c3;
      $r5c4  = $value->r5c4;
      $r5c5  = $value->r5c5;
      $r5c6  = $value->r5c6;
      $r5c7  = $value->r5c7;
      $r5c8  = $value->r5c8;
      $r5c9  = $value->r5c9;
      $r5c10 = $value->r5c10;
      $r5c11 = $value->r5c11;
      $r5c12 = $value->r5c12;
      $r5c13 = $value->r5c13;
      $r5c14 = $value->r5c14;
      $r5c15 = $value->r5c15;
      $r5c16 = $value->r5c16;
      $r5c17 = $value->r5c17;
      $r5c18 = $value->r5c18;
      $r5c19 = $value->r5c19;
      $r5c20 = $value->r5c20;
      $r5c21 = $value->r5c21;
      $r5c22 = $value->r5c22;
      $r6c1 = $value->r6c1;
      $r6c2 = $value->r6c2;
      $r6c3 = $value->r6c3;
      $r6c4 = $value->r6c4;
      $r6c5 = $value->r6c5;
      $r6c6 = $value->r6c6;
      $r6c7 = $value->r6c7;
      $r6c8 = $value->r6c8;
      $r6c9 = $value->r6c9;
      $r6c10 = $value->r6c10;
      $r6c11 = $value->r6c11;
      $r6c12 = $value->r6c12;
      $r6c13 = $value->r6c13;
      $r6c14 = $value->r6c14;
      $r6c15 = $value->r6c15;
      $r6c16 = $value->r6c16;
      $r6c17 = $value->r6c17;
      $r6c18 = $value->r6c18;
      $r6c19 = $value->r6c19;
      $r6c20 = $value->r6c20;
      $r6c21 = $value->r6c21;
      $r6c22 = $value->r6c22;
      $r7c1 = $value->r7c1;
      $r7c2 = $value->r7c2;
      $r7c3 = $value->r7c3;
      $r7c4 = $value->r7c4;
      $r7c5  = $value->r7c5;
      $r7c6  = $value->r7c6;
      $r7c7  = $value->r7c7;
      $r7c8  = $value->r7c8;
      $r7c9  = $value->r7c9;
      $r7c10 = $value->r7c10;
      $r7c11 = $value->r7c11;
      $r7c12 = $value->r7c12;
      $r7c13 = $value->r7c13;
      $r7c14 = $value->r7c14;
      $r7c15 = $value->r7c15;
      $r7c16 = $value->r7c16;
      $r7c17 = $value->r7c17;
      $r7c18 = $value->r7c18;
      $r7c19 = $value->r7c19;
      $r7c20 = $value->r7c20;
      $r7c21 = $value->r7c21;
      $r7c22 = $value->r7c22;
      $r8c1  = $value->r8c1;
      $r8c2  = $value->r8c2;
      $r8c3  = $value->r8c3;
      $r8c4  = $value->r8c4;
      $r8c5  = $value->r8c5;
      $r8c6  = $value->r8c6;
      $r8c7  = $value->r8c7;
      $r8c8  = $value->r8c8;
      $r8c9  = $value->r8c9;
      $r8c10 = $value->r8c10;
      $r8c11 = $value->r8c11;
      $r8c12 = $value->r8c12;
      $r8c13 = $value->r8c13;
      $r8c14 = $value->r8c14;
      $r8c15 = $value->r8c15;
      $r8c16 = $value->r8c16;
      $r8c17 = $value->r8c17;
      $r8c18 = $value->r8c18;
      $r8c19 = $value->r8c19;
      $r8c20 = $value->r8c20;
      $r8c21 = $value->r8c21;
      $r8c22 = $value->r8c22;
      $r9c1  = $value->r9c1;
      $r9c2  = $value->r9c2;
      $r9c3  = $value->r9c3;
      $r9c4  = $value->r9c4;
      $r9c5  = $value->r9c5;
      $r9c6  = $value->r9c6;
      $r9c7  = $value->r9c7;
      $r9c8  = $value->r9c8;
      $r9c9  = $value->r9c9;
      $r9c10 = $value->r9c10;
      $r9c11 = $value->r9c11;
      $r9c12 = $value->r9c12;
      $r9c13 = $value->r9c13;
      $r9c14 = $value->r9c14;
      $r9c15 = $value->r9c15;
      $r9c16 = $value->r9c16;
      $r9c17 = $value->r9c17;
      $r9c18 = $value->r9c18;
      $r9c19 = $value->r9c19;
      $r9c20 = $value->r9c20;
      $r9c21 = $value->r9c21;
      $r9c22 = $value->r9c22;
      $r10c1 = $value->r10c1;
      $r10c2 = $value->r10c2;
      $r10c3 = $value->r10c3;
      $r10c4 = $value->r10c4;
      $r10c5 = $value->r10c5;
      $r10c6 = $value->r10c6;
      $r10c7 = $value->r10c7;
      $r10c8 = $value->r10c8;
      $r10c9 = $value->r10c9;
      $r10c10 = $value->r10c10;
      $r10c11 = $value->r10c11;
      $r10c12 = $value->r10c12;
      $r10c13 = $value->r10c13;
      $r10c14 = $value->r10c14;
      $r10c15 = $value->r10c15;
      $r10c16 = $value->r10c16;
      $r10c17 = $value->r10c17;
      $r10c18 = $value->r10c18;
      $r10c19 = $value->r10c19;
      $r10c20 = $value->r10c20;
      $r10c21 = $value->r10c21;
      $r10c22 = $value->r10c22;
      $r11c1  = $value->r11c1;
      $r11c2  = $value->r11c2;
      $r11c3  = $value->r11c3;
      $r11c4  = $value->r11c4;
      $r11c5  = $value->r11c5;
      $r11c6  = $value->r11c6;
      $r11c7  = $value->r11c7;
      $r11c8  = $value->r11c8;
      $r11c9  = $value->r11c9;
      $r11c10 = $value->r11c10;
      $r11c11 = $value->r11c11;
      $r11c12 = $value->r11c12;
      $r11c13 = $value->r11c13;
      $r11c14 = $value->r11c14;
      $r11c15 = $value->r11c15;
      $r11c16 = $value->r11c16;
      $r11c17 = $value->r11c17;
      $r11c18 = $value->r11c18;
      $r11c19 = $value->r11c19;
      $r11c20 = $value->r11c20;
      $r11c21 = $value->r11c21;
      $r11c22 = $value->r11c22;
      $stock_management_comments = $value->stock_management_comments;
      $score = $value->score;
      $visit_date = $value->visit_date;
      $created_by = $value->created_by;
      $updated_by = $value->updated_by;
      $created_at = $value->created_at;
      $updated_at = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into stock_management (health_facility_id,survey_summary_id,form_id,r1c1,r1c2,r1c3,r1c4,r1c5,r1c6,r1c7,r1c8,r1c9,r1c10,r1c11,r1c12,r1c13,r1c14,r1c15,r1c16,r1c17,r1c18,r1c19,r1c20,r1c21,r1c22,r2c1,r2c2_cd4item,r2c2,r2c3,r2c4,r2c5,r2c6,r2c7,r2c8,r2c9,r2c10,r2c11,r2c12,r2c13,r2c14,r2c15,r2c16,r2c17,r2c18,r2c19,r2c20,r2c21,r2c22,r3c1,r3c2,r3c3,r3c4,r3c5,r3c6,r3c7,r3c8,r3c9,r3c10,r3c11,r3c12,r3c13,r3c14,r3c15,r3c16,r3c17,r3c18,r3c19,r3c20,r3c21,r3c22,r4c1,r4c2,r4c3,r4c4,r4c5,r4c6,r4c7,r4c8,r4c9,r4c10,r4c11,r4c12,r4c13,r4c14,r4c15,r4c16,r4c17,r4c18,r4c19,r4c20,r4c21,r4c22,r5c1,r5c2,r5c3,r5c4,r5c5,r5c6,r5c7,r5c8,r5c9,r5c10,r5c11,r5c12,r5c13,r5c14,r5c15,r5c16,r5c17,r5c18,r5c19,r5c20,r5c21,r5c22,r6c1,r6c2,r6c3,r6c4,r6c5,r6c6,r6c7,r6c8,r6c9,r6c10,r6c11,r6c12,r6c13,r6c14,r6c15,r6c16,r6c17,r6c18,r6c19,r6c20,r6c21,r6c22,r7c1,r7c2,r7c3,r7c4,r7c5,r7c6,r7c7,r7c8,r7c9,r7c10,r7c11,r7c12,r7c13,r7c14,r7c15,r7c16,r7c17,r7c18,r7c19,r7c20,r7c21,r7c22,r8c1,r8c2,r8c3,r8c4,r8c5,r8c6,r8c7,r8c8,r8c9,r8c10,r8c11,r8c12,r8c13,r8c14,r8c15,r8c16,r8c17,r8c18,r8c19,r8c20,r8c21,r8c22,r9c1,r9c2,r9c3,r9c4,r9c5,r9c6,r9c7,r9c8,r9c9,r9c10,r9c11,r9c12,r9c13,r9c14,r9c15,r9c16,r9c17,r9c18,r9c19,r9c20,r9c21,r9c22,r10c1,r10c2,r10c3,r10c4,r10c5,r10c6,r10c7,r10c8,r10c9,r10c10,r10c11,r10c12,r10c13,r10c14,r10c15,r10c16,r10c17,r10c18,r10c19,r10c20,r10c21,r10c22,r11c1,r11c2,r11c3,r11c4,r11c5,r11c6,r11c7,r11c8,r11c9,r11c10,r11c11,r11c12,r11c13,r11c14,r11c15,r11c16,r11c17,r11c18,r11c19,r11c20,r11c21,r11c22,stock_management_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$health_facility_id,$survey_summary_id,$form_id,$r1c1,$r1c2,$r1c3,$r1c4,$r1c5,$r1c6,$r1c7,$r1c8,$r1c9,$r1c10,$r1c11,$r1c12,$r1c13,$r1c14,$r1c15,$r1c16,$r1c17,$r1c18,$r1c19,$r1c20,$r1c21,$r1c22,$r2c1,$r2c2_cd4item,$r2c2,$r2c3,$r2c4,$r2c5,$r2c6,$r2c7,$r2c8,$r2c9,$r2c10,$r2c11,$r2c12,$r2c13,$r2c14,$r2c15,$r2c16,$r2c17,$r2c18,$r2c19,$r2c20,$r2c21,$r2c22,$r3c1,$r3c2,$r3c3,$r3c4,$r3c5,$r3c6,$r3c7,$r3c8,$r3c9,$r3c10,$r3c11,$r3c12,$r3c13,$r3c14,$r3c15,$r3c16,$r3c17,$r3c18,$r3c19,$r3c20,$r3c21,$r3c22,$r4c1,$r4c2,$r4c3,$r4c4,$r4c5,$r4c6,$r4c7,$r4c8,$r4c9,$r4c10,$r4c11,$r4c12,$r4c13,$r4c14,$r4c15,$r4c16,$r4c17,$r4c18,$r4c19,$r4c20,$r4c21,$r4c22,$r5c1,$r5c2,$r5c3,$r5c4,$r5c5,$r5c6,$r5c7,$r5c8,$r5c9,$r5c10,$r5c11,$r5c12,$r5c13,$r5c14,$r5c15,$r5c16,$r5c17,$r5c18,$r5c19,$r5c20,$r5c21,$r5c22,$r6c1,$r6c2,$r6c3,$r6c4,$r6c5,$r6c6,$r6c7,$r6c8,$r6c9,$r6c10,$r6c11,$r6c12,$r6c13,$r6c14,$r6c15,$r6c16,$r6c17,$r6c18,$r6c19,$r6c20,$r6c21,$r6c22,$r7c1,$r7c2,$r7c3,$r7c4,$r7c5,$r7c6,$r7c7,$r7c8,$r7c9,$r7c10,$r7c11,$r7c12,$r7c13,$r7c14,$r7c15,$r7c16,$r7c17,$r7c18,$r7c19,$r7c20,$r7c21,$r7c22,$r8c1,$r8c2,$r8c3,$r8c4,$r8c5,$r8c6,$r8c7,$r8c8,$r8c9,$r8c10,$r8c11,$r8c12,$r8c13,$r8c14,$r8c15,$r8c16,$r8c17,$r8c18,$r8c19,$r8c20,$r8c21,$r8c22,$r9c1,$r9c2,$r9c3,$r9c4,$r9c5,$r9c6,$r9c7,$r9c8,$r9c9,$r9c10,$r9c11,$r9c12,$r9c13,$r9c14,$r9c15,$r9c16,$r9c17,$r9c18,$r9c19,$r9c20,$r9c21,$r9c22,$r10c1,$r10c2,$r10c3,$r10c4,$r10c5,$r10c6,$r10c7,$r10c8,$r10c9,$r10c10,$r10c11,$r10c12,$r10c13,$r10c14,$r10c15,$r10c16,$r10c17,$r10c18,$r10c19,$r10c20,$r10c21,$r10c22,$r11c1,$r11c2,$r11c3,$r11c4,$r11c5,$r11c6,$r11c7,$r11c8,$r11c9,$r11c10,$r11c11,$r11c12,$r11c13,$r11c14,$r11c15,$r11c16,$r11c17,$r11c18,$r11c19,$r11c20,$r11c21,$r11c22,$stock_management_comments,$score,$visit_date,$created_by,$updated_by,$created_at,$updated_at]);
        DB::table('stock_management')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $scoresummary = IndicatorScoreSummary::where('upload_status', '=', 0)->get();
    foreach ($scoresummary as $value ) {
      // code...
      $hfi = $value->health_facility_id;
      $ssi = $value->survey_summary_id;
      $fid = $value->form_id;
      $i1 =  $value->indicator1_score;
      $i2 =  $value->indicator2_score;
      $i3 =  $value->indicator3_score;
      $i4 =  $value->indicator4_score;
      $i5 =  $value->indicator5_score;
      $i6 =  $value->indicator6_score;
      $i7 =  $value->indicator7_score;
      $i8 =  $value->indicator8_score;
      $i9 =  $value->indicator9_score;
      $i10 = $value->indicator10_score;
      $i11 = $value->indicator11_score;
      $i12 = $value->indicator12_score;
      $i13 = $value->indicator13_score;
      $i14 = $value->indicator14_score;
      $i15 = $value->indicator15_score;
      $i16 = $value->indicator16_score;
      $i17 = $value->indicator17_score;
      $i18 = $value->indicator18_score;
      $i19 = $value->indicator19_score;
      $i20 = $value->indicator20_score;
      $i21 = $value->indicator21_score;
      $i22 = $value->indicator22_score;
      $i23 = $value->indicator23_score;
      $i24 = $value->indicator24_score;
      $i25 = $value->indicator25_score;
      $i26 = $value->indicator26_score;
      $i27 = $value->indicator27_score;
      $vn =  $value->visit_number;
      $vd =  $value->visit_date;
      $cb =  $value->created_by;
      $ub =  $value->updated_by;
      $ca =  $value->created_at;
      $ua =  $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_summary_scores(health_facility_id,survey_summary_id,form_id,indicator1_score,indicator2_score,indicator3_score,indicator4_score,indicator5_score,indicator6_score,indicator7_score,indicator8_score,indicator9_score,indicator10_score,indicator11_score,indicator12_score,indicator13_score,indicator14_score,indicator15_score,indicator16_score,indicator17_score,indicator18_score,indicator19_score,indicator20_score,indicator21_score,indicator22_score,indicator23_score,indicator24_score,indicator25_score,indicator26_score,indicator27_score,visit_number,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hfi,$ssi,$fid,$i1,$i2,$i3,$i4,$i5,$i6,$i7,$i8,$i9,$i10,$i11,$i12,$i13,$i14,$i15,$i16,$i17,$i18,$i19,$i20,$i21,$i22,$i23,$i24,$i25,$i26,$i27,$vn,$vd,$cb,$ub,$ca,$ua]);

        DB::table('spars_summary_scores')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $storage10 = StorageManagement10::where('upload_status', '=', 0)->get();
    foreach ($storage10 as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $ssi = $value->survey_summary_id;
      $fi = $value->form_id;
      $s10a = $value->sub_indicator_10a;
      $s10b = $value->sub_indicator_10b;
      $s10c = $value->sub_indicator_10c;
      $s10d = $value->sub_indicator_10d;
      $i10 = $value->indicator_10_comments;
      $sc = $value->score;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_storage_management_10 (health_facility_id,survey_summary_id,form_id,sub_indicator_10a,sub_indicator_10b,sub_indicator_10c,sub_indicator_10d,indicator_10_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$ssi,$fi,$s10a,$s10b,$s10c,$s10d,$i10,$sc,$vd,$cb,$ub,$ca,$ua]);
      DB::table('spars_storage_management_10')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }


    $storage11 = StorageManagement11::where('upload_status', '=', 0)->get();
    foreach ($storage11 as $value ) {
      // code...
      $hi = $value->health_facility_id;
      $ss = $value->survey_summary_id;
      $fi = $value->form_id;
      $s11a = $value->sub_indicator_11a;
      $s11b = $value->sub_indicator_11b;
      $s11c = $value->sub_indicator_11c;
      $s11d = $value->sub_indicator_11d;
      $s11e = $value->sub_indicator_11e;
      $scm = $value->indicator_11_comments;
      $sc = $value->score;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_storage_management_11 (health_facility_id,survey_summary_id,form_id,sub_indicator_11a,sub_indicator_11b,sub_indicator_11c,sub_indicator_11d,sub_indicator_11e,indicator_11_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values (?,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?)', [$hi,$ss,$fi,$s11a,$s11b,$s11c,$s11d,$s11e,$scm,$sc,$vd,$cb,$ub,$ca,$ua]);
      DB::table('spars_storage_management_11')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $storage12 = StorageManagement12::where('upload_status', '=', 0)->get();
    foreach ($storage12 as $value ) {
      // code...
      $hi = $value->health_facility_id;
      $ss = $value->survey_summary_id;
      $fi = $value->form_id;
      $s12a = $value->sub_indicator_12a_main_store;
      $s12b = $value->sub_indicator_12b_main_store;
      $s12c = $value->sub_indicator_12c_main_store;
      $s12d = $value->sub_indicator_12d_main_store;
      $s12e = $value->sub_indicator_12e_main_store;
      $sl12a = $value->sub_indicator_12a_lab_store;
      $sl12b = $value->sub_indicator_12b_lab_store;
      $sl12c = $value->sub_indicator_12c_lab_store;
      $sl12d = $value->sub_indicator_12d_lab_store;
      $sl12e = $value->sub_indicator_12e_lab_store;
      $sc = $value->score;
      $i12cm = $value->indicator_12_comments;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_storage_management_12 (health_facility_id,survey_summary_id,form_id,sub_indicator_12a_main_store,sub_indicator_12b_main_store,sub_indicator_12c_main_store,sub_indicator_12d_main_store,sub_indicator_12e_main_store,sub_indicator_12a_lab_store,sub_indicator_12b_lab_store,sub_indicator_12c_lab_store,sub_indicator_12d_lab_store,sub_indicator_12e_lab_store,score,indicator_12_comments,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hi,$ss,$fi,$s12a,$s12b,$s12c,$s12d,$s12e,$sl12a,$sl12b,$sl12c,$sl12d,$sl12e,$sc,$i12cm,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_storage_management_12')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $storage13 = StorageManagement13::where('upload_status', '=', 0)->get();
    foreach ($storage13 as $value ) {
      // code...
      $hi = $value->health_facility_id;
      $si = $value->survey_summary_id;
      $fi = $value->form_id;
      $i13ma = $value->sub_indicator_13a_main_store;
      $i13mb = $value->sub_indicator_13b_main_store;
      $i13mc = $value->sub_indicator_13c_main_store;
      $i13md = $value->sub_indicator_13d_main_store;
      $i13me = $value->sub_indicator_13e_main_store;
      $i13mf = $value->sub_indicator_13f_main_store;
      $i13mg = $value->sub_indicator_13g_main_store;
      $i13mh = $value->sub_indicator_13h_main_store;
      $i13mi = $value->sub_indicator_13i_main_store;
      $i13mj = $value->sub_indicator_13j_main_store;
      $i13mk = $value->sub_indicator_13k_main_store;
      $i13ml = $value->sub_indicator_13l_main_store;
      $i13la = $value->sub_indicator_13a_lab_store;
      $i13lb = $value->sub_indicator_13b_lab_store;
      $i13lc = $value->sub_indicator_13c_lab_store;
      $i13ld = $value->sub_indicator_13d_lab_store;
      $i13le = $value->sub_indicator_13e_lab_store;
      $i13lf = $value->sub_indicator_13f_lab_store;
      $i13lg = $value->sub_indicator_13g_lab_store;
      $i13lh = $value->sub_indicator_13h_lab_store;
      $i13li = $value->sub_indicator_13i_lab_store;
      $i13lj = $value->sub_indicator_13j_lab_store;
      $i13lk = $value->sub_indicator_13k_lab_store;
      $i13ll = $value->sub_indicator_13l_lab_store;
      $sc = $value->score;
      $i13cm = $value->indicator_13_comments;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_storage_management_13 (health_facility_id,survey_summary_id,form_id,sub_indicator_13a_main_store,sub_indicator_13b_main_store,sub_indicator_13c_main_store,sub_indicator_13d_main_store,sub_indicator_13e_main_store,sub_indicator_13f_main_store,sub_indicator_13g_main_store,sub_indicator_13h_main_store,sub_indicator_13i_main_store,sub_indicator_13j_main_store,sub_indicator_13k_main_store,sub_indicator_13l_main_store,sub_indicator_13a_lab_store,sub_indicator_13b_lab_store,sub_indicator_13c_lab_store,sub_indicator_13d_lab_store,sub_indicator_13e_lab_store,sub_indicator_13f_lab_store,sub_indicator_13g_lab_store,sub_indicator_13h_lab_store,sub_indicator_13i_lab_store,sub_indicator_13j_lab_store,sub_indicator_13k_lab_store,sub_indicator_13l_lab_store,score,indicator_13_comments,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hi,$si,$fi,$i13ma,$i13mb,$i13mc,$i13md,$i13me,$i13mf,$i13mg,$i13mh,$i13mi,$i13mj,$i13mk,$i13ml,$i13la,$i13lb,$i13lc,$i13ld,$i13le,$i13lf,$i13lg,$i13lh,$i13li,$i13lj,$i13lk,$i13ll,$sc,$i13cm,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_storage_management_13')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $storage14 = StorageManagement14::where('upload_status', '=', 0)->get();
    foreach ($storage14 as $value ) {
      // code...

      $hi    = $value->health_facility_id;
      $si    = $value->survey_summary_id;
      $fi    = $value->form_id;
      $i14ma = $value->sub_indicator_14a_main_store;
      $i14mb = $value->sub_indicator_14b_main_store;
      $i14mc = $value->sub_indicator_14c_main_store;
      $i14md = $value->sub_indicator_14d_main_store;
      $i14me = $value->sub_indicator_14e_main_store;
      $i14mf = $value->sub_indicator_14f_main_store;
      $i14mg = $value->sub_indicator_14g_main_store;
      $i14mh = $value->sub_indicator_14h_main_store;
      $i14la = $value->sub_indicator_14a_lab_store;
      $i14lb = $value->sub_indicator_14b_lab_store;
      $i14lc = $value->sub_indicator_14c_lab_store;
      $i14ld = $value->sub_indicator_14d_lab_store;
      $i14le = $value->sub_indicator_14e_lab_store;
      $i14lf = $value->sub_indicator_14f_lab_store;
      $i14lg = $value->sub_indicator_14g_lab_store;
      $i14lh = $value->sub_indicator_14h_lab_store;
      $sc    = $value->score;
      $i14c  = $value->indicator_14_comments;
      $vd    = $value->visit_date;
      $cb    = $value->created_by;
      $ub    = $value->updated_by;
      $ca    = $value->created_at;
      $ua    = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_storage_management_14 (health_facility_id,survey_summary_id,form_id,sub_indicator_14a_main_store,sub_indicator_14b_main_store,sub_indicator_14c_main_store,sub_indicator_14d_main_store,sub_indicator_14e_main_store,sub_indicator_14f_main_store,sub_indicator_14g_main_store,sub_indicator_14h_main_store,sub_indicator_14a_lab_store,sub_indicator_14b_lab_store,sub_indicator_14c_lab_store,sub_indicator_14d_lab_store,sub_indicator_14e_lab_store,sub_indicator_14f_lab_store,sub_indicator_14g_lab_store,sub_indicator_14h_lab_store,score,indicator_14_comments,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hi,$si,$fi,$i14ma,$i14mb,$i14mc,$i14md,$i14me,$i14mf,$i14mg,$i14mh,$i14la,$i14lb,$i14lc,$i14ld,$i14le,$i14lf,$i14lg,$i14lh,$sc,$i14c,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_storage_management_14')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $ordering15 = Ordering15::where('upload_status', '=', 0)->get();
    foreach ($ordering15 as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $si = $value->survey_summary_id;
      $fi = $value->form_id;
      $i15a = $value->sub_indicator_15a;
      $i15asoh = $value->sub_indicator_15a_soh;
      $i15ai = $value->sub_indicator_15a_issued;
      $i15am = $value->sub_indicator_15a_amc;
      $i15b = $value->sub_indicator_15b;
      $i15c = $value->sub_indicator_15c;
      $sc = $value->score;
      $i15cm = $value->indicator_15_comments;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_ordering_15 (health_facility_id,survey_summary_id,form_id,sub_indicator_15a,sub_indicator_15a_soh,sub_indicator_15a_issued,sub_indicator_15a_amc,sub_indicator_15b,sub_indicator_15c,score,indicator_15_comments,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i15a,$i15asoh,$i15ai,$i15am,$i15b,$i15c,$sc,$i15cm,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_ordering_15')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $ordering16 = Ordering16::where('upload_status', '=', 0)->get();
    foreach ($ordering16 as $value ) {
      // code...
      $hf   = $value->health_facility_id;
      $si   = $value->survey_summary_id;
      $fi   = $value->form_id;
      $i16a = $value->sub_indicator_16a;
      $i16b = $value->sub_indicator_16b;
      $i16c = $value->sub_indicator_16c;
      $i16d = $value->sub_indicator_16d;
      $i16e = $value->sub_indicator_16e;
      $i16f = $value->sub_indicator_16f;
      $i16c = $value->indicator_16_comments;
      $sc   = $value->score;
      $vd   = $value->visit_date;
      $cb   = $value->created_by;
      $ub   = $value->updated_by;
      $ca   = $value->created_at;
      $ua   = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_ordering_16 (health_facility_id,survey_summary_id,form_id,sub_indicator_16a,sub_indicator_16b,sub_indicator_16c,sub_indicator_16d,sub_indicator_16e,sub_indicator_16f,indicator_16_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i16a,$i16b,$i16c,$i16d,$i16e,$i16f,$i16c,$sc,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_ordering_16')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $ordering17 = Ordering17::where('upload_status', '=', 0)->get();
    foreach ($ordering17 as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $si = $value->survey_summary_id;
      $fi = $value->form_id;
      $i17a = $value->sub_indicator_17a;
      $i17cm = $value->indicator_17_comments;
      $sc = $value->score;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_ordering_17 (health_facility_id,survey_summary_id,form_id,sub_indicator_17a,indicator_17_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i17a,$i17cm,$sc,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_ordering_17')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $equipment18 = Equipment18::where('upload_status', '=', 0)->get();
    foreach ($equipment18 as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $si = $value->survey_summary_id;
      $fi = $value->form_id;
      $i18a = $value->sub_indicator_18a;
      $i18b = $value->sub_indicator_18b;
      $i18c = $value->sub_indicator_18c;
      $i18d = $value->sub_indicator_18d;
      $i18cm = $value->indicator_18_comments;
      $sc = $value->score;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into equipment_18 (health_facility_id,survey_summary_id,form_id,sub_indicator_18a,sub_indicator_18b,sub_indicator_18c,sub_indicator_18d,indicator_18_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i18a,$i18b,$i18c,$i18d,$i18cm,$sc,$vd,$cb,$ub,$ca,$ua]);

      DB::table('equipment_18')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $equipment19 = Equipment19::where('upload_status', '=', 0)->get();
    foreach ($equipment19 as $value ) {
      // code...
      $hf = $value->health_facility_id;
      $si = $value->survey_summary_id;
      $fi = $value->form_id;
      $i19a = $value->sub_indicator_19a;
      $i19b = $value->sub_indicator_19b;
      $i19c = $value->sub_indicator_19c;
      $i19d = $value->sub_indicator_19d;
      $i19cm = $value->indicator_19_comments;
      $sc = $value->score;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into equipment_19 (health_facility_id,survey_summary_id,form_id,sub_indicator_19a,sub_indicator_19b,sub_indicator_19c,sub_indicator_19d,indicator_19_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i19a,$i19b,$i19c,$i19d,$i19cm,$sc,$vd,$cb,$ub,$ca,$ua]);

      DB::table('equipment_19')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $equipment20 = Equipment20::where('upload_status', '=', 0)->get();
    foreach ($equipment20 as $value ) {
      // code...
      $hi = $value->health_facility_id;
      $si = $value->survey_summary_id;
      $fi = $value->form_id;
      $i20a1 = $value->sub_indicator_20a1;
      $i20a2= $value->sub_indicator_20a2;
      $i20a3 = $value->sub_indicator_20a3;
      $i20a4 = $value->sub_indicator_20a4;
      $i20a5 = $value->sub_indicator_20a5;
      $i20a6 = $value->sub_indicator_20a6;
      $i20b1 = $value->sub_indicator_20b1;
      $i20b2 = $value->sub_indicator_20b2;
      $i20b3 = $value->sub_indicator_20b3;
      $i20b4 = $value->sub_indicator_20b4;
      $i20b5 = $value->sub_indicator_20b5;
      $i20b6 = $value->sub_indicator_20b6;
      $i20c1 = $value->sub_indicator_20c1;
      $i20c2 = $value->sub_indicator_20c2;
      $i20c3 = $value->sub_indicator_20c3;
      $i20c4 = $value->sub_indicator_20c4;
      $i20c5 = $value->sub_indicator_20c5;
      $i20c6 = $value->sub_indicator_20c6;
      $i20d1 = $value->sub_indicator_20d1;
      $i20d2 = $value->sub_indicator_20d2;
      $i20d3 = $value->sub_indicator_20d3;
      $i20d4 = $value->sub_indicator_20d4;
      $i20d5 = $value->sub_indicator_20d5;
      $i20d6 = $value->sub_indicator_20d6;
      $i20e1 = $value->sub_indicator_20e1;
      $i20e2 = $value->sub_indicator_20e2;
      $i20e3 = $value->sub_indicator_20e3;
      $i20e4 = $value->sub_indicator_20e4;
      $i20e5 = $value->sub_indicator_20e5;
      $i20e6 = $value->sub_indicator_20e6;
      $i20f1 = $value->sub_indicator_20f1;
      $i20f2 = $value->sub_indicator_20f2;
      $i20f3 = $value->sub_indicator_20f3;
      $i20f4 = $value->sub_indicator_20f4;
      $i20f5 = $value->sub_indicator_20f5;
      $i20f6 = $value->sub_indicator_20f6;
      $i20cm = $value->indicator_20_comments;
      $sc = $value->score;
      $vd = $value->visit_date;
      $cb = $value->created_by;
      $ub = $value->updated_by;
      $ca = $value->created_at;
      $ua = $value->updated_at;
      $cd4 = $value->cd4_machine;
      $chm = $value->chemistry_machine;
      $hem = $value->heamatology_machine;

      DB::connection('mysql_remote')->insert('insert into equipment_20 (health_facility_id,survey_summary_id,form_id,sub_indicator_20a1,sub_indicator_20a2,sub_indicator_20a3,sub_indicator_20a4,sub_indicator_20a5,sub_indicator_20a6,sub_indicator_20b1,sub_indicator_20b2,sub_indicator_20b3,sub_indicator_20b4,sub_indicator_20b5,sub_indicator_20b6,sub_indicator_20c1,sub_indicator_20c2,sub_indicator_20c3,sub_indicator_20c4,sub_indicator_20c5,sub_indicator_20c6,sub_indicator_20d1,sub_indicator_20d2,sub_indicator_20d3,sub_indicator_20d4,sub_indicator_20d5,sub_indicator_20d6,sub_indicator_20e1,sub_indicator_20e2,sub_indicator_20e3,sub_indicator_20e4,sub_indicator_20e5,sub_indicator_20e6,sub_indicator_20f1,sub_indicator_20f2,sub_indicator_20f3,sub_indicator_20f4,sub_indicator_20f5,sub_indicator_20f6,indicator_20_comments,score,visit_date,created_by,updated_by,created_at,updated_at,cd4_machine,chemistry_machine,heamatology_machine)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$hi,$si,$fi,$i20a1,$i20a2,$i20a3,$i20a4,$i20a5,$i20a6,$i20b1,$i20b2,$i20b3,$i20b4,$i20b5,$i20b6,$i20c1,$i20c2,$i20c3,$i20c4,$i20c5,$i20c6,$i20d1,$i20d2,$i20d3,$i20d4,$i20d5,$i20d6,$i20e1,$i20e2,$i20e3,$i20e4,$i20e5,$i20e6,$i20f1,$i20f2,$i20f3,$i20f4,$i20f5,$i20f6,$i20cm,$sc,$vd,$cb,$ub,$ca,$ua,$cd4,$chm,$hem]);

      DB::table('equipment_20')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $equipment21 = Equipment21::where('upload_status', '=', 0)->get();
    foreach ($equipment21 as $value ) {
      // code...
      $fi      = $value->health_facility_id;
      $si      = $value->survey_summary_id;
      $fi      = $value->form_id;
      $si211ab = $value->sub_indicator_211ab;
      $si211ac = $value->sub_indicator_211ac;
      $si211ad = $value->sub_indicator_211ad;
      $si211ae = $value->sub_indicator_211ae;
      $si211af = $value->sub_indicator_211af;
      $si211ag = $value->sub_indicator_211ag;
      $si211ah = $value->sub_indicator_211ah;
      $si211ai = $value->sub_indicator_211ai;
      $si211bb = $value->sub_indicator_211bb;
      $si211bc = $value->sub_indicator_211bc;
      $si211bd = $value->sub_indicator_211bd;
      $si211be = $value->sub_indicator_211be;
      $si211bf = $value->sub_indicator_211bf;
      $si211bg = $value->sub_indicator_211bg;
      $si211bh = $value->sub_indicator_211bh;
      $si211bi = $value->sub_indicator_211bi;
      $si211cb = $value->sub_indicator_211cb;
      $si211cc = $value->sub_indicator_211cc;
      $si211cd = $value->sub_indicator_211cd;
      $si211ce = $value->sub_indicator_211ce;
      $si211cf = $value->sub_indicator_211cf;
      $si211cg = $value->sub_indicator_211cg;
      $si211ch = $value->sub_indicator_211ch;
      $si211ci = $value->sub_indicator_211ci;
      $si211db = $value->sub_indicator_211db;
      $si211dc = $value->sub_indicator_211dc;
      $si211dd = $value->sub_indicator_211dd;
      $si211de = $value->sub_indicator_211de;
      $si211df = $value->sub_indicator_211df;
      $si211dg = $value->sub_indicator_211dg;
      $si211dh = $value->sub_indicator_211dh;
      $si211di = $value->sub_indicator_211di;
      $si211eb = $value->sub_indicator_211eb;
      $si211ec = $value->sub_indicator_211ec;
      $si211ed = $value->sub_indicator_211ed;
      $si211ee = $value->sub_indicator_211ee;
      $si211ef = $value->sub_indicator_211ef;
      $si211eg = $value->sub_indicator_211eg;
      $si211eh = $value->sub_indicator_211eh;
      $si211ei = $value->sub_indicator_211ei;
      $si212ab = $value->sub_indicator_212ab;
      $si212ac = $value->sub_indicator_212ac;
      $si212ad = $value->sub_indicator_212ad;
      $si212ae = $value->sub_indicator_212ae;
      $si212af = $value->sub_indicator_212af;
      $si212ag = $value->sub_indicator_212ag;
      $si212ah = $value->sub_indicator_212ah;
      $si212ai = $value->sub_indicator_212ai;
      $si212bb = $value->sub_indicator_212bb;
      $si212bc = $value->sub_indicator_212bc;
      $si212bd = $value->sub_indicator_212bd;
      $si212be = $value->sub_indicator_212be;
      $si212bf = $value->sub_indicator_212bf;
      $si212bg = $value->sub_indicator_212bg;
      $si212bh = $value->sub_indicator_212bh;
      $si212bi = $value->sub_indicator_212bi;
      $si213ab = $value->sub_indicator_213ab;
      $si213ac = $value->sub_indicator_213ac;
      $si213ad = $value->sub_indicator_213ad;
      $si213ae = $value->sub_indicator_213ae;
      $si213af = $value->sub_indicator_213af;
      $si213ag = $value->sub_indicator_213ag;
      $si213ah = $value->sub_indicator_213ah;
      $si213ai = $value->sub_indicator_213ai;
      $si213bb = $value->sub_indicator_213bb;
      $si213bc = $value->sub_indicator_213bc;
      $si213bd = $value->sub_indicator_213bd;
      $si213be = $value->sub_indicator_213be;
      $si213bf = $value->sub_indicator_213bf;
      $si213bg = $value->sub_indicator_213bg;
      $si213bh = $value->sub_indicator_213bh;
      $si213bi = $value->sub_indicator_213bi;
      $si213cb = $value->sub_indicator_213cb;
      $si213cc = $value->sub_indicator_213cc;
      $si213cd = $value->sub_indicator_213cd;
      $si213ce = $value->sub_indicator_213ce;
      $si213cf = $value->sub_indicator_213cf;
      $si213cg = $value->sub_indicator_213cg;
      $si213ch = $value->sub_indicator_213ch;
      $si213ci = $value->sub_indicator_213ci;
      $si213db = $value->sub_indicator_213db;
      $si213dc = $value->sub_indicator_213dc;
      $si213dd = $value->sub_indicator_213dd;
      $si213de = $value->sub_indicator_213de;
      $si213df = $value->sub_indicator_213df;
      $si213dg = $value->sub_indicator_213dg;
      $si213dh = $value->sub_indicator_213dh;
      $si213di = $value->sub_indicator_213di;
      $si213eb = $value->sub_indicator_213eb;
      $si213ec = $value->sub_indicator_213ec;
      $si213ed = $value->sub_indicator_213ed;
      $si213ee = $value->sub_indicator_213ee;
      $si213ef = $value->sub_indicator_213ef;
      $si213eg = $value->sub_indicator_213eg;
      $si213eh = $value->sub_indicator_213eh;
      $si213ei = $value->sub_indicator_213ei;
      $si213fb = $value->sub_indicator_213fb;
      $si213fc = $value->sub_indicator_213fc;
      $si213fd = $value->sub_indicator_213fd;
      $si213fe = $value->sub_indicator_213fe;
      $si213ff = $value->sub_indicator_213ff;
      $si213fg = $value->sub_indicator_213fg;
      $si213fh = $value->sub_indicator_213fh;
      $si213fi = $value->sub_indicator_213fi;
      $si213gb = $value->sub_indicator_213gb;
      $si213gc = $value->sub_indicator_213gc;
      $si213gd = $value->sub_indicator_213gd;
      $si213ge = $value->sub_indicator_213ge;
      $si213gf = $value->sub_indicator_213gf;
      $si213gg = $value->sub_indicator_213gg;
      $si213gh = $value->sub_indicator_213gh;
      $si213gi = $value->sub_indicator_213gi;
      $si213hb = $value->sub_indicator_213hb;
      $si213hc = $value->sub_indicator_213hc;
      $si213hd = $value->sub_indicator_213hd;
      $si213he = $value->sub_indicator_213he;
      $si213hf = $value->sub_indicator_213hf;
      $si213hg = $value->sub_indicator_213hg;
      $si213hh = $value->sub_indicator_213hh;
      $si213hi = $value->sub_indicator_213hi;
      $si213ib = $value->sub_indicator_213ib;
      $si213ic = $value->sub_indicator_213ic;
      $si213id = $value->sub_indicator_213id;
      $si213ie = $value->sub_indicator_213ie;
      $si213if = $value->sub_indicator_213if;
      $si213ig = $value->sub_indicator_213ig;
      $si213ih = $value->sub_indicator_213ih;
      $si213ii = $value->sub_indicator_213ii;
      $si213jb = $value->sub_indicator_213jb;
      $si213jc = $value->sub_indicator_213jc;
      $si213jd = $value->sub_indicator_213jd;
      $si213je = $value->sub_indicator_213je;
      $si213jf = $value->sub_indicator_213jf;
      $si213jg = $value->sub_indicator_213jg;
      $si213jh = $value->sub_indicator_213jh;
      $si213ji = $value->sub_indicator_213ji;
      $si21cmt = $value->indicator_21_comments;
      $sc      = $value->score;
      $vd      = $value->visit_date;
      $cb      = $value->created_by;
      $ub      = $value->updated_by;
      $ca      = $value->created_at;
      $ua      = $value->updated_at;
      $si212cb = $value->sub_indicator_212cb;
      $si212cc = $value->sub_indicator_212cc;
      $si212cd = $value->sub_indicator_212cd;
      $si212ce = $value->sub_indicator_212ce;
      $si212cf = $value->sub_indicator_212cf;
      $si212cg = $value->sub_indicator_212cg;
      $si212ch = $value->sub_indicator_212ch;
      $si212ci = $value->sub_indicator_212ci;
      $si212db = $value->sub_indicator_212db;
      $si212dc = $value->sub_indicator_212dc;
      $si212dd = $value->sub_indicator_212dd;
      $si212de = $value->sub_indicator_212de;
      $si212df = $value->sub_indicator_212df;
      $si212dg = $value->sub_indicator_212dg;
      $si212dh = $value->sub_indicator_212dh;
      $si212di = $value->sub_indicator_212di;

      DB::connection('mysql_remote')->insert('insert into equipment_21 (health_facility_id,survey_summary_id,form_id,sub_indicator_211ab,sub_indicator_211ac,sub_indicator_211ad,sub_indicator_211ae,sub_indicator_211af,sub_indicator_211ag,sub_indicator_211ah,sub_indicator_211ai,sub_indicator_211bb,sub_indicator_211bc,sub_indicator_211bd,sub_indicator_211be,sub_indicator_211bf,sub_indicator_211bg,sub_indicator_211bh,sub_indicator_211bi,sub_indicator_211cb,sub_indicator_211cc,sub_indicator_211cd,sub_indicator_211ce,sub_indicator_211cf,sub_indicator_211cg,sub_indicator_211ch,sub_indicator_211ci,sub_indicator_211db,sub_indicator_211dc,sub_indicator_211dd,sub_indicator_211de,sub_indicator_211df,sub_indicator_211dg,sub_indicator_211dh,sub_indicator_211di,sub_indicator_211eb,sub_indicator_211ec,sub_indicator_211ed,sub_indicator_211ee,sub_indicator_211ef,sub_indicator_211eg,sub_indicator_211eh,sub_indicator_211ei,sub_indicator_212ab,sub_indicator_212ac,sub_indicator_212ad,sub_indicator_212ae,sub_indicator_212af,sub_indicator_212ag,sub_indicator_212ah,sub_indicator_212ai,sub_indicator_212bb,sub_indicator_212bc,sub_indicator_212bd,sub_indicator_212be,sub_indicator_212bf,sub_indicator_212bg,sub_indicator_212bh,sub_indicator_212bi,sub_indicator_213ab,sub_indicator_213ac,sub_indicator_213ad,sub_indicator_213ae,sub_indicator_213af,sub_indicator_213ag,sub_indicator_213ah,sub_indicator_213ai,sub_indicator_213bb,sub_indicator_213bc,sub_indicator_213bd,sub_indicator_213be,sub_indicator_213bf,sub_indicator_213bg,sub_indicator_213bh,sub_indicator_213bi,sub_indicator_213cb,sub_indicator_213cc,sub_indicator_213cd,sub_indicator_213ce,sub_indicator_213cf,sub_indicator_213cg,sub_indicator_213ch,sub_indicator_213ci,sub_indicator_213db,sub_indicator_213dc,sub_indicator_213dd,sub_indicator_213de,sub_indicator_213df,sub_indicator_213dg,sub_indicator_213dh,sub_indicator_213di,sub_indicator_213eb,sub_indicator_213ec,sub_indicator_213ed,sub_indicator_213ee,sub_indicator_213ef,sub_indicator_213eg,sub_indicator_213eh,sub_indicator_213ei,sub_indicator_213fb,sub_indicator_213fc,sub_indicator_213fd,sub_indicator_213fe,sub_indicator_213ff,sub_indicator_213fg,sub_indicator_213fh,sub_indicator_213fi,sub_indicator_213gb,sub_indicator_213gc,sub_indicator_213gd,sub_indicator_213ge,sub_indicator_213gf,sub_indicator_213gg,sub_indicator_213gh,sub_indicator_213gi,sub_indicator_213hb,sub_indicator_213hc,sub_indicator_213hd,sub_indicator_213he,sub_indicator_213hf,sub_indicator_213hg,sub_indicator_213hh,sub_indicator_213hi,sub_indicator_213ib,sub_indicator_213ic,sub_indicator_213id,sub_indicator_213ie,sub_indicator_213if,sub_indicator_213ig,sub_indicator_213ih,sub_indicator_213ii,sub_indicator_213jb,sub_indicator_213jc,sub_indicator_213jd,sub_indicator_213je,sub_indicator_213jf,sub_indicator_213jg,sub_indicator_213jh,sub_indicator_213ji,indicator_21_comments,score,visit_date,created_by,updated_by,created_at,updated_at,sub_indicator_212cb,sub_indicator_212cc,sub_indicator_212cd,sub_indicator_212ce,sub_indicator_212cf,sub_indicator_212cg,sub_indicator_212ch,sub_indicator_212ci,sub_indicator_212db,sub_indicator_212dc,sub_indicator_212dd,sub_indicator_212de,sub_indicator_212df,sub_indicator_212dg,sub_indicator_212dh,sub_indicator_212di) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$fi,$si,$fi,$si211ab,$si211ac,$si211ad,$si211ae,$si211af,$si211ag,$si211ah,$si211ai,$si211bb,$si211bc,$si211bd,$si211be,$si211bf,$si211bg,$si211bh,$si211bi,$si211cb,$si211cc,$si211cd,$si211ce,$si211cf,$si211cg,$si211ch,$si211ci,$si211db,$si211dc,$si211dd,$si211de,$si211df,$si211dg,$si211dh,$si211di,$si211eb,$si211ec,$si211ed,$si211ee,$si211ef,$si211eg,$si211eh,$si211ei,$si212ab,$si212ac,$si212ad,$si212ae,$si212af,$si212ag,$si212ah,$si212ai,$si212bb,$si212bc,$si212bd,$si212be,$si212bf,$si212bg,$si212bh,$si212bi,$si213ab,$si213ac,$si213ad,$si213ae,$si213af,$si213ag,$si213ah,$si213ai,$si213bb,$si213bc,$si213bd,$si213be,$si213bf,$si213bg,$si213bh,$si213bi,$si213cb,$si213cc,$si213cd,$si213ce,$si213cf,$si213cg,$si213ch,$si213ci,$si213db,$si213dc,$si213dd,$si213de,$si213df,$si213dg,$si213dh,$si213di,$si213eb,$si213ec,$si213ed,$si213ee,$si213ef,$si213eg,$si213eh,$si213ei,$si213fb,$si213fc,$si213fd,$si213fe,$si213ff,$si213fg,$si213fh,$si213fi,$si213gb,$si213gc,$si213gd,$si213ge,$si213gf,$si213gg,$si213gh,$si213gi,$si213hb,$si213hc,$si213hd,$si213he,$si213hf,$si213hg,$si213hh,$si213hi,$si213ib,$si213ic,$si213id,$si213ie,$si213if,$si213ig,$si213ih,$si213ii,$si213jb,$si213jc,$si213jd,$si213je,$si213jf,$si213jg,$si213jh,$si213ji,$si21cmt,$sc,$vd,$cb,$ub,$ca,$ua,$si212cb,$si212cc,$si212cd,$si212ce,$si212cf,$si212cg,$si212ch,$si212ci,$si212db,$si212dc,$si212dd,$si212de,$si212df,$si212dg,$si212dh,$si212di]);

      DB::table('equipment_21')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }

    $infosys22 = InformationSystem22::where('upload_status', '=', 0)->get();
    foreach ($infosys22 as $value ) {
      // code...
      $hf    = $value->health_facility_id;
      $si    = $value->survey_summary_id;
      $fi    = $value->form_id;
      $si22a = $value->sub_indicator_22a;
      $si22b = $value->sub_indicator_22b;
      $si22c = $value->sub_indicator_22c;
      $si22d = $value->sub_indicator_22d;
      $si22e = $value->sub_indicator_22e;
      $si22f = $value->sub_indicator_22f;
      $si22g = $value->sub_indicator_22g;
      $si22h = $value->sub_indicator_22h;
      $si22i = $value->sub_indicator_22i;
      $si22j = $value->sub_indicator_22j;
      $si22k = $value->sub_indicator_22k;
      $si22l = $value->sub_indicator_22l;
      $si22m = $value->sub_indicator_22m;
      $si22n = $value->sub_indicator_22n;
      $sicmt = $value->indicator_22_comments;
      $sc    = $value->score;
      $vd    = $value->visit_date;
      $cb    = $value->created_by;
      $ub    = $value->updated_by;
      $ca    = $value->created_at;
      $ua    = $value->updated_at;

      DB::connection('mysql_remote')->insert('insert into spars_info_system_22 (health_facility_id,survey_summary_id,form_id,sub_indicator_22a,sub_indicator_22b,sub_indicator_22c,sub_indicator_22d,sub_indicator_22e,sub_indicator_22f,sub_indicator_22g,sub_indicator_22h,sub_indicator_22i,sub_indicator_22j,sub_indicator_22k,sub_indicator_22l,sub_indicator_22m,sub_indicator_22n,indicator_22_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$si22a,$si22b,$si22c,$si22d,$si22e,$si22f,$si22g,$si22h,$si22i,$si22j,$si22k,$si22l,$si22m,$si22n,$sicmt,$sc,$vd,$cb,$ub,$ca,$ua]);

      DB::table('spars_info_system_22')->where('upload_status','=',0)->update(['upload_status' => 1]);
    }


        $infosys23 = InformationSystem23::where('upload_status', '=', 0)->get();
        foreach ($infosys23 as $value ) {
          // code...
          $hf = $value->health_facility_id;
          $si = $value->survey_summary_id;
          $fi = $value->form_id;
          $i23a = $value->sub_indicator_23a;
          $i23b = $value->sub_indicator_23b;
          $i23cm = $value->indicator_23_comments;
          $sc = $value->score;
          $vd = $value->visit_date;
          $cb = $value->created_by;
          $ub = $value->updated_by;
          $ca = $value->created_at;
          $ua = $value->updated_at;

          DB::connection('mysql_remote')->insert('insert into spars_info_system_23 (health_facility_id,survey_summary_id,form_id,sub_indicator_23a,sub_indicator_23b,indicator_23_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i23a,$i23b,$i23cm,$sc,$vd,$cb,$ub,$ca,$ua]);

          DB::table('spars_info_system_23')->where('upload_status','=',0)->update(['upload_status' => 1]);
        }

        $infosys24 = InformationSystem24::where('upload_status', '=', 0)->get();
        foreach ($infosys24 as $value ) {
          // code...
          $hf = $value->health_facility_id;
          $si = $value->survey_summary_id;
          $fi = $value->form_id;
          $i24a = $value->sub_indicator_24a;
          $i24b = $value->sub_indicator_24b;
          $i24c = $value->sub_indicator_24c;
          $i24cm = $value->indicator_24_comments;
          $sc = $value->score;
          $vd = $value->visit_date;
          $cb = $value->created_by;
          $ub = $value->updated_by;
          $ca = $value->created_at;
          $ua = $value->updated_at;

          DB::connection('mysql_remote')->insert('insert into spars_info_system_24 (health_facility_id,survey_summary_id,form_id,sub_indicator_24a,sub_indicator_24b,sub_indicator_24c, indicator_24_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$i24a,$i24b,$i24c,$i24cm,$sc,$vd,$cb,$ub,$ca,$ua]);

          DB::table('spars_info_system_24')->where('upload_status','=',0)->update(['upload_status' => 1]);
        }

        $infosys25 = InformationSystem25::where('upload_status', '=', 0)->get();
        foreach ($infosys25 as $value ) {
          // code...
          $hf = $value->health_facility_id;
          $si = $value->survey_summary_id;
          $fi = $value->form_id;
          $si25aa = $value->sub_indicator_25aa;
          $si25ab = $value->sub_indicator_25ab;
          $si25ac = $value->sub_indicator_25ac;
          $si25ba1 = $value->sub_indicator_25ba1;
          $si25ba2 = $value->sub_indicator_25ba2;
          $si25ba3 = $value->sub_indicator_25ba3;
          $si25ba4 = $value->sub_indicator_25ba4;
          $si25ba5 = $value->sub_indicator_25ba5;
          $si25ba6 = $value->sub_indicator_25ba6;
          $si25ba7 = $value->sub_indicator_25ba7;
          $si25ba8 = $value->sub_indicator_25ba8;
          $si25bb1 = $value->sub_indicator_25bb1;
          $si25bb2 = $value->sub_indicator_25bb2;
          $si25bb3 = $value->sub_indicator_25bb3;
          $si25bb4 = $value->sub_indicator_25bb4;
          $si25bb5 = $value->sub_indicator_25bb5;
          $si25bb6 = $value->sub_indicator_25bb6;
          $si25bb7 = $value->sub_indicator_25bb7;
          $si25bb8 = $value->sub_indicator_25bb8;
          $si25bc1 = $value->sub_indicator_25bc1;
          $si25bc2 = $value->sub_indicator_25bc2;
          $si25bc3 = $value->sub_indicator_25bc3;
          $si25bc4 = $value->sub_indicator_25bc4;
          $si25bc5 = $value->sub_indicator_25bc5;
          $si25bc6 = $value->sub_indicator_25bc6;
          $si25bc7 = $value->sub_indicator_25bc7;
          $si25bc8 = $value->sub_indicator_25bc8;
          $sicd4cd = $value->sub_indicator_cd4item;
          $si25bd1 = $value->sub_indicator_25bd1;
          $si25bd2 = $value->sub_indicator_25bd2;
          $si25bd3 = $value->sub_indicator_25bd3;
          $si25bd4 = $value->sub_indicator_25bd4;
          $si25bd5 = $value->sub_indicator_25bd5;
          $si25bd6 = $value->sub_indicator_25bd6;
          $si25bd7 = $value->sub_indicator_25bd7;
          $si25bd8 = $value->sub_indicator_25bd8;
          $si25be1 = $value->sub_indicator_25be1;
          $si25be2 = $value->sub_indicator_25be2;
          $si25be3 = $value->sub_indicator_25be3;
          $si25be4 = $value->sub_indicator_25be4;
          $si25be5 = $value->sub_indicator_25be5;
          $si25be6 = $value->sub_indicator_25be6;
          $si25be7 = $value->sub_indicator_25be7;
          $si25be8 = $value->sub_indicator_25be8;
          $si25bf1 = $value->sub_indicator_25bf1;
          $si25bf2 = $value->sub_indicator_25bf2;
          $si25bf3 = $value->sub_indicator_25bf3;
          $si25bf4 = $value->sub_indicator_25bf4;
          $si25bf5 = $value->sub_indicator_25bf5;
          $si25bf6 = $value->sub_indicator_25bf6;
          $si25bf7 = $value->sub_indicator_25bf7;
          $si25bf8 = $value->sub_indicator_25bf8;
          $si25bg1 = $value->sub_indicator_25bg1;
          $si25bg2 = $value->sub_indicator_25bg2;
          $si25bg3 = $value->sub_indicator_25bg3;
          $si25bg4 = $value->sub_indicator_25bg4;
          $si25bg5 = $value->sub_indicator_25bg5;
          $si25bg6 = $value->sub_indicator_25bg6;
          $si25bg7 = $value->sub_indicator_25bg7;
          $si25bg8 = $value->sub_indicator_25bg8;
          $si25ca1 = $value->sub_indicator_25ca1;
          $si25ca2 = $value->sub_indicator_25ca2;
          $si25ca3 = $value->sub_indicator_25ca3;
          $si25ca4 = $value->sub_indicator_25ca4;
          $si25cb1 = $value->sub_indicator_25cb1;
          $si25cb2 = $value->sub_indicator_25cb2;
          $si25cb3 = $value->sub_indicator_25cb3;
          $si25cb4 = $value->sub_indicator_25cb4;
          $si25cc1 = $value->sub_indicator_25cc1;
          $si25cc2 = $value->sub_indicator_25cc2;
          $si25cc3 = $value->sub_indicator_25cc3;
          $si25cc4 = $value->sub_indicator_25cc4;
          $si25cd1 = $value->sub_indicator_25cd1;
          $si25cd2 = $value->sub_indicator_25cd2;
          $si25cd3 = $value->sub_indicator_25cd3;
          $si25cd4 = $value->sub_indicator_25cd4;
          $si25ce1 = $value->sub_indicator_25ce1;
          $si25ce2 = $value->sub_indicator_25ce2;
          $si25ce3 = $value->sub_indicator_25ce3;
          $si25ce4 = $value->sub_indicator_25ce4;
          $si25cf1 = $value->sub_indicator_25cf1;
          $si25cf2 = $value->sub_indicator_25cf2;
          $si25cf3 = $value->sub_indicator_25cf3;
          $si25cf4 = $value->sub_indicator_25cf4;
          $i25cmnt = $value->indicator_25_comments;
          $sc = $value->score;
          $vd = $value->visit_date;
          $cb = $value->created_by;
          $ub = $value->updated_by;
          $ca = $value->created_at;
          $ua = $value->updated_at;

          DB::connection('mysql_remote')->insert('insert into spars_info_system_25 (health_facility_id,survey_summary_id,form_id,sub_indicator_25aa,sub_indicator_25ab,sub_indicator_25ac,sub_indicator_25ba1,sub_indicator_25ba2,sub_indicator_25ba3,sub_indicator_25ba4,sub_indicator_25ba5,sub_indicator_25ba6,sub_indicator_25ba7,sub_indicator_25ba8,sub_indicator_25bb1,sub_indicator_25bb2,sub_indicator_25bb3,sub_indicator_25bb4,sub_indicator_25bb5,sub_indicator_25bb6,sub_indicator_25bb7,sub_indicator_25bb8,sub_indicator_25bc1,sub_indicator_25bc2,sub_indicator_25bc3,sub_indicator_25bc4,sub_indicator_25bc5,sub_indicator_25bc6,sub_indicator_25bc7,sub_indicator_25bc8,sub_indicator_cd4item,sub_indicator_25bd1,sub_indicator_25bd2,sub_indicator_25bd3,sub_indicator_25bd4,sub_indicator_25bd5,sub_indicator_25bd6,sub_indicator_25bd7,sub_indicator_25bd8,sub_indicator_25be1,sub_indicator_25be2,sub_indicator_25be3,sub_indicator_25be4,sub_indicator_25be5,sub_indicator_25be6,sub_indicator_25be7,sub_indicator_25be8,sub_indicator_25bf1,sub_indicator_25bf2,sub_indicator_25bf3,sub_indicator_25bf4,sub_indicator_25bf5,sub_indicator_25bf6,sub_indicator_25bf7,sub_indicator_25bf8,sub_indicator_25bg1,sub_indicator_25bg2,sub_indicator_25bg3,sub_indicator_25bg4,sub_indicator_25bg5,sub_indicator_25bg6,sub_indicator_25bg7,sub_indicator_25bg8,sub_indicator_25ca1,sub_indicator_25ca2,sub_indicator_25ca3,sub_indicator_25ca4,sub_indicator_25cb1,sub_indicator_25cb2,sub_indicator_25cb3,sub_indicator_25cb4,sub_indicator_25cc1,sub_indicator_25cc2,sub_indicator_25cc3,sub_indicator_25cc4,sub_indicator_25cd1,sub_indicator_25cd2,sub_indicator_25cd3,sub_indicator_25cd4,sub_indicator_25ce1,sub_indicator_25ce2,sub_indicator_25ce3,sub_indicator_25ce4,sub_indicator_25cf1,sub_indicator_25cf2,sub_indicator_25cf3,sub_indicator_25cf4,indicator_25_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$si25aa,$si25ab,$si25ac,$si25ba1,$si25ba2,$si25ba3,$si25ba4,$si25ba5,$si25ba6,$si25ba7,$si25ba8,$si25bb1,$si25bb2,$si25bb3,$si25bb4,$si25bb5,$si25bb6,$si25bb7,$si25bb8,$si25bc1,$si25bc2,$si25bc3,$si25bc4,$si25bc5,$si25bc6,$si25bc7,$si25bc8,$sicd4cd,$si25bd1,$si25bd2,$si25bd3,$si25bd4,$si25bd5,$si25bd6,$si25bd7,$si25bd8,$si25be1,$si25be2,$si25be3,$si25be4,$si25be5,$si25be6,$si25be7,$si25be8,$si25bf1,$si25bf2,$si25bf3,$si25bf4,$si25bf5,$si25bf6,$si25bf7,$si25bf8,$si25bg1,$si25bg2,$si25bg3,$si25bg4,$si25bg5,$si25bg6,$si25bg7,$si25bg8,$si25ca1,$si25ca2,$si25ca3,$si25ca4,$si25cb1,$si25cb2,$si25cb3,$si25cb4,$si25cc1,$si25cc2,$si25cc3,$si25cc4,$si25cd1,$si25cd2,$si25cd3,$si25cd4,$si25ce1,$si25ce2,$si25ce3,$si25ce4,$si25cf1,$si25cf2,$si25cf3,$si25cf4,$i25cmnt,$sc,$vd,$cb,$ub,$ca,$ua]);

          DB::table('spars_info_system_25')->where('upload_status','=',0)->update(['upload_status' => 1]);
        }

        $infosys26 = InformationSystem26::where('upload_status', '=', 0)->get();
        foreach ($infosys26 as $value ) {
          // code...
          $hf = $value->health_facility_id;
          $si = $value->survey_summary_id;
          $fi = $value->form_id;
          $si26a = $value->sub_indicator_26a;
          $si26b = $value->sub_indicator_26b;
          $si26cm = $value->indicator_26_comments;
          $sc = $value->score;
          $vd = $value->visit_date;
          $cb = $value->created_by;
          $ub = $value->updated_by;
          $ca = $value->created_at;
          $ua = $value->updated_at;

          DB::connection('mysql_remote')->insert('insert into spars_info_system_26 (health_facility_id,survey_summary_id,form_id,sub_indicator_26a,sub_indicator_26b,indicator_26_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$si26a,$si26b,$si26cm,$sc,$vd,$cb,$ub,$ca,$ua]);

          DB::table('spars_info_system_26')->where('upload_status','=',0)->update(['upload_status' => 1]);
        }

        $infosys27 = InformationSystem27::where('upload_status', '=', 0)->get();
        foreach ($infosys27 as $value ) {
          // code...
          $hf = $value->health_facility_id;
          $si = $value->survey_summary_id;
          $fi = $value->form_id;
          $si27a = $value->sub_indicator_27a;
          $si27b = $value->sub_indicator_27b;
          $si27c = $value->sub_indicator_27c;
          $si27d = $value->sub_indicator_27d;
          $i27cm = $value->indicator_27_comments;
          $sc = $value->score;
          $vd = $value->visit_date;
          $cb = $value->created_by;
          $ub = $value->updated_by;
          $ca = $value->created_at;
          $ua = $value->updated_at;

          DB::connection('mysql_remote')->insert('insert into spars_info_system_27 (health_facility_id,survey_summary_id,form_id,sub_indicator_27a,sub_indicator_27b,sub_indicator_27c,sub_indicator_27d,indicator_27_comments,score,visit_date,created_by,updated_by,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$hf,$si,$fi,$si27a,$si27b,$si27c,$si27d,$i27cm,$sc,$vd,$cb,$ub,$ca,$ua]);

          DB::table('spars_info_system_27')->where('upload_status','=',0)->update(['upload_status' => 1]);
        }

return view('thanks');

  }
}
