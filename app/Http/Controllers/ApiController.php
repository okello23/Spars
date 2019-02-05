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

                            $supervisor->save();  

                        }

                        //update visit_number for facility
                        $facility = HealthFacility::find($request->facility_id);
                        $facility->visit_number = $request->visit_number;
                        $facility->in_charge_fname = $request->in_charge_name;
                        $facility->in_charge_contact = $request->in_charge_telephone;
                        $facility->lss_fname = $request->responsible_lss;
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



}
