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

use Session;

use DateTime;

use Auth;

use Illuminate\Support\Facades\Redirect;

class SurveyController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list of districts
        $district_list = HealthFacility::groupby('district')->orderBy('district', 'asc')
               ->lists('district','district');
        $district_list->prepend("","");

        //list of cadres
        $cadre_list = Cadre::orderBy('name', 'asc')
               ->lists('name','id');

        $cadre_list->prepend("","");

        //list of personnel
        $person = Personnel::get();
        $personnel_list = $person->lists('PersonFullName', 'id');
        $personnel_list->prepend("","");

        return view('survey.create')
                    ->with('cadre_list',$cadre_list)
                    ->with('personnel_list',$personnel_list)
                    ->with('district_list',$district_list);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //validate data 
        $validation=$this->validate($request, [
            'district_id' => 'required',
            'facility_id' => 'required',            
            'visit_date' => 'required|date' ,
            'next_visit_date'=> 'required|date'
        ]);   


            $form_id = uniqid();

            //save visit summary information
            $summary = new SurveySummary;
            $summary->health_facility_id = $request->facility_id;
            $summary->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
            $summary->next_visit_date = DateTime::createFromFormat('d F Y', $request->next_visit_date);
            $summary->form_id = $form_id;        
            $summary->visit_number = $request->visit_number;
            $summary->created_by = Auth::user()->id;

            $summary->save();    


            //update visit_number for facility
            $facility = HealthFacility::find($request->facility_id);
            $facility->visit_number = $request->visit_number;
            $facility->timestamps = false;

            $facility->save();


        //save supervised persons
        for($i=0;$i<$request->supervised_counter;$i++)
        {
            $name = 'name'.$i;
            $gender = 'supervised_gender'.$i;
            $cadre = 'profession'.$i;
            $telephone = 'mobile'.$i;

            $supervised_person = new SupervisedPerson;

            $supervised_person->name = $request->$name;
            $supervised_person->gender = $request->$gender;
            $supervised_person->cadre_id = $request->$cadre;
            $supervised_person->phone_number = $request->$telephone;

            $supervised_person->health_facility_id = $request->facility_id;
            $supervised_person->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
            $supervised_person->form_id = $form_id;
            $supervised_person->created_by = Auth::user()->id;

            $supervised_person->save();      
                   
        }

        //save supervisors
        for($i=0;$i<$request->supervisor_counter;$i++)
        {
            $person = 'supervisor_name'.$i;

            $supervisor = new Supervisor;

            $supervisor->person_id = $request->$person;
            $supervisor->health_facility_id = $request->facility_id;
            $supervisor->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
            $supervisor->form_id = $form_id;
            $supervisor->created_by = Auth::user()->id;

            $supervisor->save();  

        }


        //save general information for visit
        $general = new General;

        $general->d1 = $request->store_type;

        $general->d2a = $request->general_d21!=null?true:false;
        $general->d2b = $request->general_d22!=null?true:false;
        $general->d2c = $request->general_d23!=null?true:false;
        $general->d2d = $request->general_d24!=null?true:false;
        $general->d2e = $request->general_d25!=null?true:false;
        $general->d2f = $request->general_d26!=null?true:false;
        $general->d2comment = $request->general_d2;

        $general->d3 = $request->general_d31=='true'?true:false;
        $general->d3comment = $request->general_d3;

        $general->d4a = $request->general_d41!=null?true:false;
        $general->d4b = $request->general_d42!=null?true:false;
        $general->d4c = $request->general_d43!=null?true:false;
        $general->d4d = $request->general_d44!=null?true:false;
        $general->d4e = $request->general_d45!=null?true:false;
        $general->d4f = $request->general_d46!=null?true:false;
        $general->d4comment = $request->general_d4;


        $general->d5 = $request->general_d5;
                        
        $general->health_facility_id = $request->facility_id;
        $general->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $general->form_id = $form_id;
        $general->created_by = Auth::user()->id;

        $general->save();  

        
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
        $storage10->form_id = $form_id;
        $storage10->created_by = Auth::user()->id;
        $storage10->updated_by = Auth::user()->id;
        $storage10->save();  


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
        $storage11->form_id = $form_id;
        $storage11->created_by = Auth::user()->id;
        $storage11->updated_by = Auth::user()->id;
        $storage11->save();  


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
        $storage12->form_id = $form_id;
        $storage12->created_by = Auth::user()->id;
        $storage12->updated_by = Auth::user()->id;
        $storage12->save();  
        

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
        $storage13->form_id = $form_id;
        $storage13->created_by = Auth::user()->id;
        $storage13->updated_by = Auth::user()->id;
        $storage13->save();  
        

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
        $storage14->form_id = $form_id;
        $storage14->created_by = Auth::user()->id;
        $storage14->updated_by = Auth::user()->id;
        $storage14->save();  


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
        $ordering15->form_id = $form_id;
        $ordering15->created_by = Auth::user()->id;
        $ordering15->updated_by = Auth::user()->id;
        $ordering15->save();  



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
        $ordering16->form_id = $form_id;
        $ordering16->created_by = Auth::user()->id;
        $ordering16->updated_by = Auth::user()->id;
        $ordering16->save();  



        //save ordering 17 
        $ordering17 = new Ordering17;

        $ordering17->sub_indicator_17a = $request->ordering_17a=='NA'?-1:$request->ordering_17a;

        $ordering17->indicator_17_comments  = $request->ordering_17_comments;

        $ordering17->health_facility_id = $request->facility_id;
        $ordering17->survey_summary_id = $summary->id;
        $ordering17->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $ordering17->form_id = $form_id;
        $ordering17->created_by = Auth::user()->id;
        $ordering17->updated_by = Auth::user()->id;
        $ordering17->save();  


        //save information system 22 
        $information_system22 = new InformationSystem22;

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

        $information_system22->health_facility_id = $request->facility_id;
        $information_system22->survey_summary_id = $summary->id;
        $information_system22->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $information_system22->form_id = $form_id;
        $information_system22->created_by = Auth::user()->id;
        $information_system22->updated_by = Auth::user()->id;
        $information_system22->save(); 


        //save information system 23 
        $information_system23 = new InformationSystem23;

        $information_system23->sub_indicator_23a = $request->lab_info_system_23a=='NA'?-1:$request->lab_info_system_23a;
        $information_system23->sub_indicator_23b = $request->lab_info_system_23b=='NA'?-1:$request->lab_info_system_23b;

        $information_system23->indicator_23_comments  = $request->lab_info_system_23_comments;

        $information_system23->health_facility_id = $request->facility_id;
        $information_system23->survey_summary_id = $summary->id;
        $information_system23->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $information_system23->form_id = $form_id;
        $information_system23->created_by = Auth::user()->id;
        $information_system23->updated_by = Auth::user()->id;
        $information_system23->save(); 


        //save information system 24 
        $information_system24 = new InformationSystem24;

        $information_system24->sub_indicator_24a = DateTime::createFromFormat('d F Y', $request->lab_info_system_24a);
        $information_system24->sub_indicator_24b = DateTime::createFromFormat('d F Y', $request->lab_info_system_24b);
        $information_system24->sub_indicator_24c = $request->lab_info_system_24c=='NA'?-1:$request->lab_info_system_24c;

        $information_system24->indicator_24_comments  = $request->lab_info_system_24_comments;

        $information_system24->health_facility_id = $request->facility_id;
        $information_system24->survey_summary_id = $summary->id;
        $information_system24->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $information_system24->form_id = $form_id;
        $information_system24->created_by = Auth::user()->id;
        $information_system24->updated_by = Auth::user()->id;
        $information_system24->save(); 


        //save information system 25 
        $information_system25 = new InformationSystem25;

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

        $information_system25->health_facility_id = $request->facility_id;
        $information_system25->survey_summary_id = $summary->id;
        $information_system25->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
        $information_system25->form_id = $form_id;
        $information_system25->created_by = Auth::user()->id;
        $information_system25->updated_by = Auth::user()->id;
        $information_system25->save();  


        //save information system 26 
        $information_system26 = new InformationSystem26;

        $information_system26->sub_indicator_26a = $request->lab_info_system_26a=='NA'?-1:$request->lab_info_system_26a;
        $information_system26->sub_indicator_26b = $request->lab_info_system_26b=='NA'?-1:$request->lab_info_system_26b;

        $information_system26->indicator_26_comments  = $request->lab_info_system_26_comments;

        $information_system26->health_facility_id = $request->facility_id;
        $information_system26->survey_summary_id = $summary->id;
        $information_system26->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $information_system26->form_id = $form_id;
        $information_system26->created_by = Auth::user()->id;
        $information_system26->updated_by = Auth::user()->id;
        $information_system26->save(); 


        //save information system 27 
        $information_system27 = new InformationSystem27;

        $information_system27->sub_indicator_27a = $request->lab_info_system_27a=='NA'?-1:$request->lab_info_system_27a;
        $information_system27->sub_indicator_27b = $request->lab_info_system_27b=='NA'?-1:$request->lab_info_system_27b;
        $information_system27->sub_indicator_27c = $request->lab_info_system_27c=='NA'?-1:$request->lab_info_system_27c;
        $information_system27->sub_indicator_27d = $request->lab_info_system_27d=='NA'?-1:$request->lab_info_system_27d;

        $information_system27->indicator_27_comments  = $request->lab_info_system_27_comments;

        $information_system27->health_facility_id = $request->facility_id;
        $information_system27->survey_summary_id = $summary->id;
        $information_system27->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $information_system27->form_id = $form_id;
        $information_system27->created_by = Auth::user()->id;
        $information_system27->updated_by = Auth::user()->id;
        $information_system27->save(); 


        //save indicator summary scores
        $indicator_score = new IndicatorScoreSummary;

        $indicator_score->indicator1_score = $request->stock_management_1_score;
        $indicator_score->indicator2_score = $request->stock_management_2_score;        
        $indicator_score->indicator3_score = $request->stock_management_3_score;
        $indicator_score->indicator4_score = $request->stock_management_4_score;
        $indicator_score->indicator5_score = $request->stock_management_5_score;        
        $indicator_score->indicator6_score = $request->stock_management_6_score;
        $indicator_score->indicator7_score = $request->stock_management_7_score;
        $indicator_score->indicator8_score = $request->stock_management_8_score;        
        $indicator_score->indicator9_score = $request->stock_management_9_score;
        $indicator_score->indicator10_score = $request->storage_management_10_score;
        $indicator_score->indicator11_score = $request->storage_management_11_score;
        $indicator_score->indicator12_score = $request->storage_management_12_score;
        $indicator_score->indicator13_score = $request->storage_management_13_score;
        $indicator_score->indicator14_score = $request->storage_management_14_score;
        $indicator_score->indicator15_score = $request->ordering_15_score;
        $indicator_score->indicator16_score = $request->ordering_16_score;
        $indicator_score->indicator17_score = $request->ordering_17_score;        
        $indicator_score->indicator18_score = $request->lab_equipment_18_score;
        $indicator_score->indicator19_score = $request->lab_equipment_19_score;
        $indicator_score->indicator20_score = $request->lab_equipment_20_score;        
        $indicator_score->indicator21_score = $request->lab_equipment_21_score;
        $indicator_score->indicator22_score = $request->lab_info_system_22_score;
        $indicator_score->indicator23_score = $request->lab_info_system_23_score;        
        $indicator_score->indicator24_score = $request->lab_info_system_24_score;
        $indicator_score->indicator25_score = $request->lab_info_system_25_score;
        $indicator_score->indicator26_score = $request->lab_info_system_26_score;        
        $indicator_score->indicator27_score = $request->lab_info_system_27_score;

        $indicator_score->health_facility_id = $request->facility_id;
        $indicator_score->survey_summary_id = $summary->id;
        $indicator_score->visit_number = $request->visit_number;
        $indicator_score->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $indicator_score->form_id = $form_id;
        $indicator_score->created_by = Auth::user()->id;
        $indicator_score->updated_by = Auth::user()->id;
        $indicator_score->save();  


        //save equipment 18 
        $equipment18 = new Equipment18;

        $equipment18->sub_indicator_18a = $request->lab_equipment_18a; 
        $equipment18->sub_indicator_18b = $request->lab_equipment_18b;
        $equipment18->sub_indicator_18c = $request->lab_equipment_18c;
        $equipment18->sub_indicator_18d = $request->lab_equipment_18d;
        

        $equipment18->indicator_18_comments  = $request->lab_equipment_18_comments;

        $equipment18->health_facility_id = $request->facility_id;
        $equipment18->survey_summary_id = $summary->id;
        $equipment18->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $equipment18->form_id = $form_id;
        $equipment18->created_by = Auth::user()->id;
        $equipment18->updated_by = Auth::user()->id;
        $equipment18->save();  


        //save equipment 19 
        $equipment19 = new Equipment19;

        $equipment19->sub_indicator_19a = $request->lab_equipment_19a=='NA'?-1:$request->lab_equipment_19a; 
        $equipment19->sub_indicator_19b = $request->lab_equipment_19b=='NA'?-1:$request->lab_equipment_19b;
        $equipment19->sub_indicator_19c = $request->lab_equipment_19c=='NA'?-1:$request->lab_equipment_19c;
        $equipment19->sub_indicator_19d = $request->lab_equipment_19d=='NA'?-1:$request->lab_equipment_19d;        

        $equipment19->indicator_19_comments  = $request->lab_equipment_19_comments;

        $equipment19->health_facility_id = $request->facility_id;
        $equipment19->survey_summary_id = $summary->id;
        $equipment19->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
        $equipment19->form_id = $form_id;
        $equipment19->created_by = Auth::user()->id;
        $equipment19->updated_by = Auth::user()->id;
        $equipment19->save();  


        //save equipment 20 
        $equipment20 = new Equipment20;

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

        $equipment20->health_facility_id = $request->facility_id;
        $equipment20->survey_summary_id = $summary->id;
        $equipment20->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
        $equipment20->form_id = $form_id;
        $equipment20->created_by = Auth::user()->id;
        $equipment20->updated_by = Auth::user()->id;
        $equipment20->save(); 


        //save equipment 21 
        $equipment21 = new Equipment21;

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

        $equipment21->sub_indicator_212cc = $request->chemistry_cobas6000_21a2=='NA'?-1:$request->chemistry_cobas6000_21a2; 
        $equipment21->sub_indicator_212cd = $request->chemistry_cobas6000_21a3=='NA'?-1:$request->chemistry_cobas6000_21a3;
        $equipment21->sub_indicator_212ch = $request->chemistry_cobas6000_21a7=='NA'?-1:$request->chemistry_cobas6000_21a7;       

        $equipment21->sub_indicator_212dc = $request->chemistry_huma80_21a2=='NA'?-1:$request->chemistry_huma80_21a2; 
        $equipment21->sub_indicator_212dd = $request->chemistry_huma80_21a3=='NA'?-1:$request->chemistry_huma80_21a3;
        $equipment21->sub_indicator_212dh = $request->chemistry_huma80_21a7=='NA'?-1:$request->chemistry_huma80_21a7;               
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

        $equipment21->health_facility_id = $request->facility_id;
        $equipment21->survey_summary_id = $summary->id;
        $equipment21->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
        $equipment21->form_id = $form_id;
        $equipment21->created_by = Auth::user()->id;
        $equipment21->updated_by = Auth::user()->id;
        $equipment21->save(); 
        

        //save stock management 
        $stock_management = new StockManagement;

        $stock_management->r1c1 = $request->r1_c1=='NA'?-1:$request->r1_c1;       
        $stock_management->r1c2 = $request->r1_c2=='NA'?-1:($request->r1_c2=='E'?-3:$request->r1_c2);       
        $stock_management->r1c3 = $request->r1_c3=='NA'?-1:$request->r1_c3;       
        $stock_management->r1c4 = $request->r1_c4=='NA'?-1:$request->r1_c4;       
        $stock_management->r1c5 = $request->r1_c5=='NA'?-1:$request->r1_c5;       
        $stock_management->r1c6 = $request->r1_c6=='NA'?-1:$request->r1_c6;       
        $stock_management->r1c7 = $request->r1_c7=='NA'?-1:$request->r1_c7;       
        $stock_management->r1c8 = $request->r1_c8=='NA'?-1:$request->r1_c8;       
        $stock_management->r1c9 = $request->r1_c9=='NA'?-1:$request->r1_c9;       
        $stock_management->r1c10 = $request->r1_c10=='NA'?-1:$request->r1_c10;       
        $stock_management->r1c11 = $request->r1_c11=='NA'?-1:($request->r1_c11=='NR'?-2:$request->r1_c11);       
        $stock_management->r1c12 = $request->r1_c12=='NA'?-1:($request->r1_c12=='NR'?-2:$request->r1_c12);       
        $stock_management->r1c13 = $request->r1_c13=='NA'?-1:($request->r1_c13=='NR'?-2:$request->r1_c13);       
        $stock_management->r1c14 = $request->r1_c14=='NA'?-1:$request->r1_c14;       
        $stock_management->r1c15 = $request->r1_c15=='NA'?-1:$request->r1_c15;       
        $stock_management->r1c16 = $request->r1_c16=='NA'?-1:($request->r1_c16=='NR'?-2:$request->r1_c16);       
        $stock_management->r1c17 = $request->r1_c17=='NA'?-1:($request->r1_c17=='NR'?-2:$request->r1_c17);       
        $stock_management->r1c18 = $request->r1_c18=='NA'?-1:$request->r1_c18;       
        $stock_management->r1c19 = $request->r1_c19=='NA'?-1:$request->r1_c19;       
        $stock_management->r1c20 = $request->r1_c20=='NA'?-1:$request->r1_c20;       
        $stock_management->r1c21 = $request->r1_c21=='NA'?:($request->r1_c21=='NR'?-2:$request->r1_c21);       
        $stock_management->r1c22 = $request->r1_c22=='NA'?:($request->r1_c22=='PS'?-4:($request->r1_c22=='NR'?-2:$request->r1_c22));       


        $stock_management->r2c2_cd4item = $request->cd4_testing;  
        $stock_management->r2c1 = $request->r2_c1=='NA'?-1:$request->r2_c1;       
        $stock_management->r2c2 = $request->r2_c2=='NA'?-1:($request->r2_c2=='E'?-3:$request->r2_c2);       
        $stock_management->r2c3 = $request->r2_c3=='NA'?-1:$request->r2_c3;       
        $stock_management->r2c4 = $request->r2_c4=='NA'?-1:$request->r2_c4;       
        $stock_management->r2c5 = $request->r2_c5=='NA'?-1:$request->r2_c5;       
        $stock_management->r2c6 = $request->r2_c6=='NA'?-1:$request->r2_c6;       
        $stock_management->r2c7 = $request->r2_c7=='NA'?-1:$request->r2_c7;       
        $stock_management->r2c8 = $request->r2_c8=='NA'?-1:$request->r2_c8;       
        $stock_management->r2c9 = $request->r2_c9=='NA'?-1:$request->r2_c9;       
        $stock_management->r2c10 = $request->r2_c10=='NA'?-1:$request->r2_c10;       
        $stock_management->r2c11 = $request->r2_c11=='NA'?-1:($request->r2_c11=='NR'?-2:$request->r2_c11);       
        $stock_management->r2c12 = $request->r2_c12=='NA'?-1:($request->r2_c12=='NR'?-2:$request->r2_c12);       
        $stock_management->r2c13 = $request->r2_c13=='NA'?-1:($request->r2_c13=='NR'?-2:$request->r2_c13);       
        $stock_management->r2c14 = $request->r2_c14=='NA'?-1:$request->r2_c14;       
        $stock_management->r2c15 = $request->r2_c15=='NA'?-1:$request->r2_c15;       
        $stock_management->r2c16 = $request->r2_c16=='NA'?-1:($request->r2_c16=='NR'?-2:$request->r2_c16);       
        $stock_management->r2c17 = $request->r2_c17=='NA'?-1:($request->r2_c17=='NR'?-2:$request->r2_c17);       
        $stock_management->r2c18 = $request->r2_c18=='NA'?-1:$request->r2_c18;       
        $stock_management->r2c19 = $request->r2_c19=='NA'?-1:$request->r2_c19;       
        $stock_management->r2c20 = $request->r2_c20=='NA'?-1:$request->r2_c20;       
        $stock_management->r2c21 = $request->r2_c21=='NA'?:($request->r2_c21=='NR'?-2:$request->r2_c21);       
        $stock_management->r2c22 = $request->r2_c22=='NA'?:($request->r2_c22=='PS'?-4:($request->r2_c22=='NR'?-2:$request->r2_c22));       


        $stock_management->r3c1 = $request->r3_c1=='NA'?-1:$request->r3_c1;       
        $stock_management->r3c2 = $request->r3_c2=='NA'?-1:($request->r3_c2=='E'?-3:$request->r3_c2);       
        $stock_management->r3c3 = $request->r3_c3=='NA'?-1:$request->r3_c3;       
        $stock_management->r3c4 = $request->r3_c4=='NA'?-1:$request->r3_c4;       
        $stock_management->r3c5 = $request->r3_c5=='NA'?-1:$request->r3_c5;       
        $stock_management->r3c6 = $request->r3_c6=='NA'?-1:$request->r3_c6;       
        $stock_management->r3c7 = $request->r3_c7=='NA'?-1:$request->r3_c7;       
        $stock_management->r3c8 = $request->r3_c8=='NA'?-1:$request->r3_c8;       
        $stock_management->r3c9 = $request->r3_c9=='NA'?-1:$request->r3_c9;       
        $stock_management->r3c10 = $request->r3_c10=='NA'?-1:$request->r3_c10;       
        $stock_management->r3c11 = $request->r3_c11=='NA'?-1:($request->r3_c11=='NR'?-2:$request->r3_c11);       
        $stock_management->r3c12 = $request->r3_c12=='NA'?-1:($request->r3_c12=='NR'?-2:$request->r3_c12);       
        $stock_management->r3c13 = $request->r3_c13=='NA'?-1:($request->r3_c13=='NR'?-2:$request->r3_c13);       
        $stock_management->r3c14 = $request->r3_c14=='NA'?-1:$request->r3_c14;       
        $stock_management->r3c15 = $request->r3_c15=='NA'?-1:$request->r3_c15;       
        $stock_management->r3c16 = $request->r3_c16=='NA'?-1:($request->r3_c16=='NR'?-2:$request->r3_c16);       
        $stock_management->r3c17 = $request->r3_c17=='NA'?-1:($request->r3_c17=='NR'?-2:$request->r3_c17);       
        $stock_management->r3c18 = $request->r3_c18=='NA'?-1:$request->r3_c18;       
        $stock_management->r3c19 = $request->r3_c19=='NA'?-1:$request->r3_c19;       
        $stock_management->r3c20 = $request->r3_c20=='NA'?-1:$request->r3_c20;       
        $stock_management->r3c21 = $request->r3_c21=='NA'?:($request->r3_c21=='NR'?-2:$request->r3_c21);       
        $stock_management->r3c22 = $request->r3_c22=='NA'?:($request->r3_c22=='PS'?-4:($request->r3_c22=='NR'?-2:$request->r3_c22));       


        $stock_management->r11c1 = $request->r3b_c1=='NA'?-1:$request->r3b_c1;       
        $stock_management->r11c2 = $request->r3b_c2=='NA'?-1:($request->r3b_c2=='E'?-3:$request->r3b_c2);       
        $stock_management->r11c3 = $request->r3b_c3=='NA'?-1:$request->r3b_c3;       
        $stock_management->r11c4 = $request->r3b_c4=='NA'?-1:$request->r3b_c4;       
        $stock_management->r11c5 = $request->r3b_c5=='NA'?-1:$request->r3b_c5;       
        $stock_management->r11c6 = $request->r3b_c6=='NA'?-1:$request->r3b_c6;       
        $stock_management->r11c7 = $request->r3b_c7=='NA'?-1:$request->r3b_c7;       
        $stock_management->r11c8 = $request->r3b_c8=='NA'?-1:$request->r3b_c8;       
        $stock_management->r11c9 = $request->r3b_c9=='NA'?-1:$request->r3b_c9;       
        $stock_management->r11c10 = $request->r3b_c10=='NA'?-1:$request->r3b_c10;       
        $stock_management->r11c11 = $request->r3b_c11=='NA'?-1:($request->r3b_c11=='NR'?-2:$request->r3b_c11);       
        $stock_management->r11c12 = $request->r3b_c12=='NA'?-1:($request->r3b_c12=='NR'?-2:$request->r3b_c12);       
        $stock_management->r11c13 = $request->r3b_c13=='NA'?-1:($request->r3b_c13=='NR'?-2:$request->r3b_c13);       
        $stock_management->r11c14 = $request->r3b_c14=='NA'?-1:$request->r3b_c14;       
        $stock_management->r11c15 = $request->r3b_c15=='NA'?-1:$request->r3b_c15;       
        $stock_management->r11c16 = $request->r3b_c16=='NA'?-1:($request->r3b_c16=='NR'?-2:$request->r3b_c16);       
        $stock_management->r11c17 = $request->r3b_c17=='NA'?-1:($request->r3b_c17=='NR'?-2:$request->r3b_c17);       
        $stock_management->r11c18 = $request->r3b_c18=='NA'?-1:$request->r3b_c18;       
        $stock_management->r11c19 = $request->r3b_c19=='NA'?-1:$request->r3b_c19;       
        $stock_management->r11c20 = $request->r3b_c20=='NA'?-1:$request->r3b_c20;       
        $stock_management->r11c21 = $request->r3b_c21=='NA'?:($request->r3b_c21=='NR'?-2:$request->r3b_c21);       
        $stock_management->r11c22 = $request->r3b_c22=='NA'?:($request->r3b_c22=='PS'?-4:($request->r3b_c22=='NR'?-2:$request->r3b_c22));       


        $stock_management->r4c1 = $request->r4_c1=='NA'?-1:$request->r4_c1;       
        $stock_management->r4c2 = $request->r4_c2=='NA'?-1:($request->r4_c2=='E'?-3:$request->r4_c2);       
        $stock_management->r4c3 = $request->r4_c3=='NA'?-1:$request->r4_c3;       
        $stock_management->r4c4 = $request->r4_c4=='NA'?-1:$request->r4_c4;       
        $stock_management->r4c5 = $request->r4_c5=='NA'?-1:$request->r4_c5;       
        $stock_management->r4c6 = $request->r4_c6=='NA'?-1:$request->r4_c6;       
        $stock_management->r4c7 = $request->r4_c7=='NA'?-1:$request->r4_c7;       
        $stock_management->r4c8 = $request->r4_c8=='NA'?-1:$request->r4_c8;       
        $stock_management->r4c9 = $request->r4_c9=='NA'?-1:$request->r4_c9;       
        $stock_management->r4c10 = $request->r4_c10=='NA'?-1:$request->r4_c10;       
        $stock_management->r4c11 = $request->r4_c11=='NA'?-1:($request->r4_c11=='NR'?-2:$request->r4_c11);       
        $stock_management->r4c12 = $request->r4_c12=='NA'?-1:($request->r4_c12=='NR'?-2:$request->r4_c12);       
        $stock_management->r4c13 = $request->r4_c13=='NA'?-1:($request->r4_c13=='NR'?-2:$request->r4_c13);       
        $stock_management->r4c14 = $request->r4_c14=='NA'?-1:$request->r4_c14;       
        $stock_management->r4c15 = $request->r4_c15=='NA'?-1:$request->r4_c15;       
        $stock_management->r4c16 = $request->r4_c16=='NA'?-1:($request->r4_c16=='NR'?-2:$request->r4_c16);       
        $stock_management->r4c17 = $request->r4_c17=='NA'?-1:($request->r4_c17=='NR'?-2:$request->r4_c17);       
        $stock_management->r4c18 = $request->r4_c18=='NA'?-1:$request->r4_c18;       
        $stock_management->r4c19 = $request->r4_c19=='NA'?-1:$request->r4_c19;       
        $stock_management->r4c20 = $request->r4_c20=='NA'?-1:$request->r4_c20;       
        $stock_management->r4c21 = $request->r4_c21=='NA'?:($request->r4_c21=='NR'?-2:$request->r4_c21);       
        $stock_management->r4c22 = $request->r4_c22=='NA'?:($request->r4_c22=='PS'?-4:($request->r4_c22=='NR'?-2:$request->r4_c22));       


        $stock_management->r10c1 = $request->r4b_c1=='NA'?-1:$request->r4b_c1;       
        $stock_management->r10c2 = $request->r4b_c2=='NA'?-1:($request->r4b_c2=='E'?-3:$request->r4b_c2);       
        $stock_management->r10c3 = $request->r4b_c3=='NA'?-1:$request->r4b_c3;       
        $stock_management->r10c4 = $request->r4b_c4=='NA'?-1:$request->r4b_c4;       
        $stock_management->r10c5 = $request->r4b_c5=='NA'?-1:$request->r4b_c5;       
        $stock_management->r10c6 = $request->r4b_c6=='NA'?-1:$request->r4b_c6;       
        $stock_management->r10c7 = $request->r4b_c7=='NA'?-1:$request->r4b_c7;       
        $stock_management->r10c8 = $request->r4b_c8=='NA'?-1:$request->r4b_c8;       
        $stock_management->r10c9 = $request->r4b_c9=='NA'?-1:$request->r4b_c9;       
        $stock_management->r10c10 = $request->r4b_c10=='NA'?-1:$request->r4b_c10;       
        $stock_management->r10c11 = $request->r4b_c11=='NA'?-1:($request->r4b_c11=='NR'?-2:$request->r4b_c11);       
        $stock_management->r10c12 = $request->r4b_c12=='NA'?-1:($request->r4b_c12=='NR'?-2:$request->r4b_c12);       
        $stock_management->r10c13 = $request->r4b_c13=='NA'?-1:($request->r4b_c13=='NR'?-2:$request->r4b_c13);       
        $stock_management->r10c14 = $request->r4b_c14=='NA'?-1:$request->r4b_c14;       
        $stock_management->r10c15 = $request->r4b_c15=='NA'?-1:$request->r4b_c15;       
        $stock_management->r10c16 = $request->r4b_c16=='NA'?-1:($request->r4b_c16=='NR'?-2:$request->r4b_c16);       
        $stock_management->r10c17 = $request->r4b_c17=='NA'?-1:($request->r4b_c17=='NR'?-2:$request->r4b_c17);       
        $stock_management->r10c18 = $request->r4b_c18=='NA'?-1:$request->r4b_c18;       
        $stock_management->r10c19 = $request->r4b_c19=='NA'?-1:$request->r4b_c19;       
        $stock_management->r10c20 = $request->r4b_c20=='NA'?-1:$request->r4b_c20;       
        $stock_management->r10c21 = $request->r4b_c21=='NA'?:($request->r4b_c21=='NR'?-2:$request->r4b_c21);       
        $stock_management->r10c22 = $request->r4b_c22=='NA'?:($request->r4b_c22=='PS'?-4:($request->r4b_c22=='NR'?-2:$request->r4b_c22));       


        $stock_management->r5c1 = $request->r5_c1=='NA'?-1:$request->r5_c1;       
        $stock_management->r5c2 = $request->r5_c2=='NA'?-1:($request->r5_c2=='E'?-3:$request->r5_c2);       
        $stock_management->r5c3 = $request->r5_c3=='NA'?-1:$request->r5_c3;       
        $stock_management->r5c4 = $request->r5_c4=='NA'?-1:$request->r5_c4;       
        $stock_management->r5c5 = $request->r5_c5=='NA'?-1:$request->r5_c5;       
        $stock_management->r5c6 = $request->r5_c6=='NA'?-1:$request->r5_c6;       
        $stock_management->r5c7 = $request->r5_c7=='NA'?-1:$request->r5_c7;       
        $stock_management->r5c8 = $request->r5_c8=='NA'?-1:$request->r5_c8;       
        $stock_management->r5c9 = $request->r5_c9=='NA'?-1:$request->r5_c9;       
        $stock_management->r5c10 = $request->r5_c10=='NA'?-1:$request->r5_c10;       
        $stock_management->r5c11 = $request->r5_c11=='NA'?-1:($request->r5_c11=='NR'?-2:$request->r5_c11);       
        $stock_management->r5c12 = $request->r5_c12=='NA'?-1:($request->r5_c12=='NR'?-2:$request->r5_c12);       
        $stock_management->r5c13 = $request->r5_c13=='NA'?-1:($request->r5_c13=='NR'?-2:$request->r5_c13);       
        $stock_management->r5c14 = $request->r5_c14=='NA'?-1:$request->r5_c14;       
        $stock_management->r5c15 = $request->r5_c15=='NA'?-1:$request->r5_c15;       
        $stock_management->r5c16 = $request->r5_c16=='NA'?-1:($request->r5_c16=='NR'?-2:$request->r5_c16);       
        $stock_management->r5c17 = $request->r5_c17=='NA'?-1:($request->r5_c17=='NR'?-2:$request->r5_c17);       
        $stock_management->r5c18 = $request->r5_c18=='NA'?-1:$request->r5_c18;       
        $stock_management->r5c19 = $request->r5_c19=='NA'?-1:$request->r5_c19;       
        $stock_management->r5c20 = $request->r5_c20=='NA'?-1:$request->r5_c20;       
        $stock_management->r5c21 = $request->r5_c21=='NA'?:($request->r5_c21=='NR'?-2:$request->r5_c21);       
        $stock_management->r5c22 = $request->r5_c22=='NA'?:($request->r5_c22=='PS'?-4:($request->r5_c22=='NR'?-2:$request->r5_c22));       


        $stock_management->r6c1 = $request->r6_c1=='NA'?-1:$request->r6_c1;       
        $stock_management->r6c2 = $request->r6_c2=='NA'?-1:($request->r6_c2=='E'?-3:$request->r6_c2);       
        $stock_management->r6c3 = $request->r6_c3=='NA'?-1:$request->r6_c3;       
        $stock_management->r6c4 = $request->r6_c4=='NA'?-1:$request->r6_c4;       
        $stock_management->r6c5 = $request->r6_c5=='NA'?-1:$request->r6_c5;       
        $stock_management->r6c6 = $request->r6_c6=='NA'?-1:$request->r6_c6;       
        $stock_management->r6c7 = $request->r6_c7=='NA'?-1:$request->r6_c7;       
        $stock_management->r6c8 = $request->r6_c8=='NA'?-1:$request->r6_c8;       
        $stock_management->r6c9 = $request->r6_c9=='NA'?-1:$request->r6_c9;       
        $stock_management->r6c10 = $request->r6_c10=='NA'?-1:$request->r6_c10;       
        $stock_management->r6c11 = $request->r6_c11=='NA'?-1:($request->r6_c11=='NR'?-2:$request->r6_c11);       
        $stock_management->r6c12 = $request->r6_c12=='NA'?-1:($request->r6_c12=='NR'?-2:$request->r6_c12);       
        $stock_management->r6c13 = $request->r6_c13=='NA'?-1:($request->r6_c13=='NR'?-2:$request->r6_c13);       
        $stock_management->r6c14 = $request->r6_c14=='NA'?-1:$request->r6_c14;       
        $stock_management->r6c15 = $request->r6_c15=='NA'?-1:$request->r6_c15;       
        $stock_management->r6c16 = $request->r6_c16=='NA'?-1:($request->r6_c16=='NR'?-2:$request->r6_c16);       
        $stock_management->r6c17 = $request->r6_c17=='NA'?-1:($request->r6_c17=='NR'?-2:$request->r6_c17);       
        $stock_management->r6c18 = $request->r6_c18=='NA'?-1:$request->r6_c18;       
        $stock_management->r6c19 = $request->r6_c19=='NA'?-1:$request->r6_c19;       
        $stock_management->r6c20 = $request->r6_c20=='NA'?-1:$request->r6_c20;       
        $stock_management->r6c21 = $request->r6_c21=='NA'?:($request->r6_c21=='NR'?-2:$request->r6_c21);       
        $stock_management->r6c22 = $request->r6_c22=='NA'?:($request->r6_c22=='PS'?-4:($request->r6_c22=='NR'?-2:$request->r6_c22));       


        $stock_management->r7c1 = $request->r7_c1=='NA'?-1:$request->r7_c1;       
        $stock_management->r7c2 = $request->r7_c2=='NA'?-1:($request->r7_c2=='E'?-3:$request->r7_c2);       
        $stock_management->r7c3 = $request->r7_c3=='NA'?-1:$request->r7_c3;       
        $stock_management->r7c4 = $request->r7_c4=='NA'?-1:$request->r7_c4;       
        $stock_management->r7c5 = $request->r7_c5=='NA'?-1:$request->r7_c5;       
        $stock_management->r7c6 = $request->r7_c6=='NA'?-1:$request->r7_c6;       
        $stock_management->r7c7 = $request->r7_c7=='NA'?-1:$request->r7_c7;       
        $stock_management->r7c8 = $request->r7_c8=='NA'?-1:$request->r7_c8;       
        $stock_management->r7c9 = $request->r7_c9=='NA'?-1:$request->r7_c9;       
        $stock_management->r7c10 = $request->r7_c10=='NA'?-1:$request->r7_c10;       
        $stock_management->r7c11 = $request->r7_c11=='NA'?-1:($request->r7_c11=='NR'?-2:$request->r7_c11);       
        $stock_management->r7c12 = $request->r7_c12=='NA'?-1:($request->r7_c12=='NR'?-2:$request->r7_c12);       
        $stock_management->r7c13 = $request->r7_c13=='NA'?-1:($request->r7_c13=='NR'?-2:$request->r7_c13);       
        $stock_management->r7c14 = $request->r7_c14=='NA'?-1:$request->r7_c14;       
        $stock_management->r7c15 = $request->r7_c15=='NA'?-1:$request->r7_c15;       
        $stock_management->r7c16 = $request->r7_c16=='NA'?-1:($request->r7_c16=='NR'?-2:$request->r7_c16);       
        $stock_management->r7c17 = $request->r7_c17=='NA'?-1:($request->r7_c17=='NR'?-2:$request->r7_c17);       
        $stock_management->r7c18 = $request->r7_c18=='NA'?-1:$request->r7_c18;       
        $stock_management->r7c19 = $request->r7_c19=='NA'?-1:$request->r7_c19;       
        $stock_management->r7c20 = $request->r7_c20=='NA'?-1:$request->r7_c20;       
        $stock_management->r7c21 = $request->r7_c21=='NA'?:($request->r7_c21=='NR'?-2:$request->r7_c21);       
        $stock_management->r7c22 = $request->r7_c22=='NA'?:($request->r7_c22=='PS'?-4:($request->r7_c22=='NR'?-2:$request->r7_c22));       


        $stock_management->r8c1 = $request->r8_c1=='NA'?-1:$request->r8_c1;       
        $stock_management->r8c2 = $request->r8_c2=='NA'?-1:($request->r8_c2=='E'?-3:$request->r8_c2);       
        $stock_management->r8c3 = $request->r8_c3=='NA'?-1:$request->r8_c3;       
        $stock_management->r8c4 = $request->r8_c4=='NA'?-1:$request->r8_c4;       
        $stock_management->r8c5 = $request->r8_c5=='NA'?-1:$request->r8_c5;       
        $stock_management->r8c6 = $request->r8_c6=='NA'?-1:$request->r8_c6;       
        $stock_management->r8c7 = $request->r8_c7=='NA'?-1:$request->r8_c7;       
        $stock_management->r8c8 = $request->r8_c8=='NA'?-1:$request->r8_c8;       
        $stock_management->r8c9 = $request->r8_c9=='NA'?-1:$request->r8_c9;       
        $stock_management->r8c10 = $request->r8_c10=='NA'?-1:$request->r8_c10;       
        $stock_management->r8c11 = $request->r8_c11=='NA'?-1:($request->r8_c11=='NR'?-2:$request->r8_c11);       
        $stock_management->r8c12 = $request->r8_c12=='NA'?-1:($request->r8_c12=='NR'?-2:$request->r8_c12);       
        $stock_management->r8c13 = $request->r8_c13=='NA'?-1:($request->r8_c13=='NR'?-2:$request->r8_c13);       
        $stock_management->r8c14 = $request->r8_c14=='NA'?-1:$request->r8_c14;       
        $stock_management->r8c15 = $request->r8_c15=='NA'?-1:$request->r8_c15;       
        $stock_management->r8c16 = $request->r8_c16=='NA'?-1:($request->r8_c16=='NR'?-2:$request->r8_c16);       
        $stock_management->r8c17 = $request->r8_c17=='NA'?-1:($request->r8_c17=='NR'?-2:$request->r8_c17);       
        $stock_management->r8c18 = $request->r8_c18=='NA'?-1:$request->r8_c18;       
        $stock_management->r8c19 = $request->r8_c19=='NA'?-1:$request->r8_c19;       
        $stock_management->r8c20 = $request->r8_c20=='NA'?-1:$request->r8_c20;       
        $stock_management->r8c21 = $request->r8_c21=='NA'?:($request->r8_c21=='NR'?-2:$request->r8_c21);       
        $stock_management->r8c22 = $request->r8_c22=='NA'?:($request->r8_c22=='PS'?-4:($request->r8_c22=='NR'?-2:$request->r8_c22));       


        $stock_management->r9c1 = $request->r9_c1=='NA'?-1:$request->r9_c1;       
        $stock_management->r9c2 = $request->r9_c2=='NA'?-1:($request->r9_c2=='E'?-3:$request->r9_c2);       
        $stock_management->r9c3 = $request->r9_c3=='NA'?-1:$request->r9_c3;       
        $stock_management->r9c4 = $request->r9_c4=='NA'?-1:$request->r9_c4;       
        $stock_management->r9c5 = $request->r9_c5=='NA'?-1:$request->r9_c5;       
        $stock_management->r9c6 = $request->r9_c6=='NA'?-1:$request->r9_c6;       
        $stock_management->r9c7 = $request->r9_c7=='NA'?-1:$request->r9_c7;       
        $stock_management->r9c8 = $request->r9_c8=='NA'?-1:$request->r9_c8;       
        $stock_management->r9c9 = $request->r9_c9=='NA'?-1:$request->r9_c9;       
        $stock_management->r9c10 = $request->r9_c10=='NA'?-1:$request->r9_c10;       
        $stock_management->r9c11 = $request->r9_c11=='NA'?-1:($request->r9_c11=='NR'?-2:$request->r9_c11);       
        $stock_management->r9c12 = $request->r9_c12=='NA'?-1:($request->r9_c12=='NR'?-2:$request->r9_c12);       
        $stock_management->r9c13 = $request->r9_c13=='NA'?-1:($request->r9_c13=='NR'?-2:$request->r9_c13);       
        $stock_management->r9c14 = $request->r9_c14=='NA'?-1:$request->r9_c14;       
        $stock_management->r9c15 = $request->r9_c15=='NA'?-1:$request->r9_c15;       
        $stock_management->r9c16 = $request->r9_c16=='NA'?-1:($request->r9_c16=='NR'?-2:$request->r9_c16);       
        $stock_management->r9c17 = $request->r9_c17=='NA'?-1:($request->r9_c17=='NR'?-2:$request->r9_c17);       
        $stock_management->r9c18 = $request->r9_c18=='NA'?-1:$request->r9_c18;       
        $stock_management->r9c19 = $request->r9_c19=='NA'?-1:$request->r9_c19;       
        $stock_management->r9c20 = $request->r9_c20=='NA'?-1:$request->r9_c20;       
        $stock_management->r9c21 = $request->r9_c21=='NA'?:($request->r9_c21=='NR'?-2:$request->r9_c21);       
        $stock_management->r9c22 = $request->r9_c22=='NA'?:($request->r9_c22=='PS'?-4:($request->r9_c22=='NR'?-2:$request->r9_c22));       



        $stock_management->stock_management_comments  = $request->stock_management_comments;

        $stock_management->health_facility_id = $request->facility_id;
        $stock_management->survey_summary_id = $summary->id;
        $stock_management->visit_date = DateTime::createFromFormat('d F Y',$request->visit_date);
        $stock_management->form_id = $form_id;
        $stock_management->created_by = Auth::user()->id;
        $stock_management->updated_by = Auth::user()->id;
        $stock_management->save();  

        // redirect
        Session::flash('message', 'Form saved successfully. Form id is '.$form_id);
        Session::flash('alert-type', 'success');
            
        return Redirect::to('survey');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPartial($id)
    {

        $record = SurveySummary::find($id);

        $facility = HealthFacility::find($record->health_facility_id); 

        $general = General::where('form_id',$record->form_id)->first();


        $d2_array = [];
        $d4_array = [];


        //d2 array
        if($general->d2a)
        {
            array_push($d2_array, 1);
        }                        
                        
        if($general->d2b)
        {
            array_push($d2_array, 2);
        }                                

        if($general->d2c)
        {
            array_push($d2_array, 3);
        }                        
                        
        if($general->d2d)
        {
            array_push($d2_array, 4);
        }               

        if($general->d2e)
        {
            array_push($d2_array, 5);
        }                        
                        
        if($general->d2f)
        {
            array_push($d2_array, 6);
        }                           

        //d4 array
        if($general->d4a)
        {
            array_push($d4_array, 1);
        }                        
                        
        if($general->d4b)
        {
            array_push($d4_array, 2);
        }                                

        if($general->d4c)
        {
            array_push($d4_array, 3);
        }                        
                        
        if($general->d4d)
        {
            array_push($d4_array, 4);
        }               

        if($general->d4e)
        {
            array_push($d4_array, 5);
        }                        
                        
        if($general->d4f)
        {
            array_push($d4_array, 6);
        }                           

        //list of districts
        $district_list = HealthFacility::groupby('district')->orderBy('district', 'asc')
               ->lists('district','district');
        $district_list->prepend("","");

        //list of sub districts
        $sub_district_list = HealthFacility::where('district',$facility->district)->groupby('hsd')->orderBy('hsd', 'asc')
               ->lists('hsd','hsd');
        $sub_district_list->prepend("","");

        //list of facilities
        $facility_list = HealthFacility::where('hsd',$facility->hsd)->groupby('facility')->orderBy('facility', 'asc')
               ->lists('facility','id');
        $facility_list->prepend("","");

        //list of cadres
        $cadre_list = Cadre::orderBy('name', 'asc')
               ->lists('name','id');

        $cadre_list->prepend("","");

        //list of personnel
        $person = Personnel::get();
        $personnel_list = $person->lists('PersonFullName', 'id');
        $personnel_list->prepend("","");

        //get scores
        $scores = IndicatorScoreSummary::where('survey_summary_id',$id)->first();

        //get storage management 10
        $storage10 = StorageManagement10::where('survey_summary_id',$id)->first();
        //get storage management 11
        $storage11 = StorageManagement11::where('survey_summary_id',$id)->first();
        //get storage management 12
        $storage12 = StorageManagement12::where('survey_summary_id',$id)->first();
        //get storage management 13
        $storage13 = StorageManagement13::where('survey_summary_id',$id)->first();
        //get storage management 14
        $storage14 = StorageManagement14::where('survey_summary_id',$id)->first();

        //get ordering 15
        $ordering15 = Ordering15::where('survey_summary_id',$id)->first();
        //get ordering 16
        $ordering16 = Ordering16::where('survey_summary_id',$id)->first();
        //get ordering 17
        $ordering17 = Ordering17::where('survey_summary_id',$id)->first();

        //get ordering 16
        $equipment18 = Equipment18::where('survey_summary_id',$id)->first();
        //get ordering 17
        $equipment19 = Equipment19::where('survey_summary_id',$id)->first();
        //get ordering 15
        $equipment20 = Equipment20::where('survey_summary_id',$id)->first();
        //get ordering 15
        $equipment21 = Equipment21::where('survey_summary_id',$id)->first();


        //get info system 22
        $info_system22 = InformationSystem22::where('survey_summary_id',$id)->first();
        //get info system 23
        $info_system23 = InformationSystem23::where('survey_summary_id',$id)->first();
        //get info system 24
        $info_system24 = InformationSystem24::where('survey_summary_id',$id)->first();
        //get info system 25
        $info_system25 = InformationSystem25::where('survey_summary_id',$id)->first();
        //get info system 26
        $info_system26 = InformationSystem26::where('survey_summary_id',$id)->first();
        //get info system 27
        $info_system27 = InformationSystem27::where('survey_summary_id',$id)->first();

        //get stock management

        $stock_management = StockManagement::where('survey_summary_id',$id)->first();


        return view('survey.edit')
                    ->with('scores',$scores)
                    ->with('d2_array',$d2_array)
                    ->with('d4_array',$d4_array)
                    ->with('stock_management',$stock_management)
                    ->with('storage10',$storage10)
                    ->with('storage11',$storage11)
                    ->with('storage12',$storage12)
                    ->with('storage13',$storage13)
                    ->with('storage14',$storage14)
                    ->with('ordering15',$ordering15)
                    ->with('ordering16',$ordering16)
                    ->with('ordering17',$ordering17)
                    ->with('equipment18',$equipment18)
                    ->with('equipment19',$equipment19)
                    ->with('equipment20',$equipment20)
                    ->with('equipment21',$equipment21)
                    ->with('info_system22',$info_system22)
                    ->with('info_system23',$info_system23)
                    ->with('info_system24',$info_system24)
                    ->with('info_system25',$info_system25)
                    ->with('info_system26',$info_system26)
                    ->with('info_system27',$info_system27)
                    ->with('facility',$facility)
                    ->with('cadre_list',$cadre_list)
                    ->with('general',$general)
                    ->with('personnel_list',$personnel_list)
                    ->with('district_list',$district_list)  
                    ->with('sub_district_list',$sub_district_list)  
                    ->with('facility_list',$facility_list)                    
                    ->with('record',$record); 

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTransfer($id)
    {
        
        $record = SurveySummary::find($id);
        $facility = HealthFacility::find($record->health_facility_id); 

        //list of districts
        $district_list = HealthFacility::groupby('district')->orderBy('district', 'asc')
               ->lists('district','district');
        $district_list->prepend("","");


        $sub_district_list = HealthFacility::groupby('hsd')->orderBy('hsd', 'asc')
               ->lists('hsd','hsd');
        $sub_district_list->prepend("","");

        $facility_list = HealthFacility::groupby('facility')->orderBy('facility', 'asc')
               ->lists('facility','id');
        $facility_list->prepend("","");


        return view('survey.transfer')
                    ->with('facility',$facility)
                    ->with('district_list',$district_list)
                    ->with('sub_district_list',$sub_district_list)
                    ->with('facility_list',$facility_list)
                    ->with('record',$record); 

    }


    public function saveTransfer(Request $request)
    {

        $record = SurveySummary::find($request->id);

        SurveySummary::where('id','=',$request->id)
                    ->update(['health_facility_id'=>$request->facility_id_to,
                                'visit_number'=>$request->visit_number_to]);

        HealthFacility::where('id','=',$request->facility_id_to)
                    ->update([ 'visit_number'=>$request->visit_number_to ]);

        General::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        IndicatorScoreSummary::where('form_id','=',$record->form_id)
                    ->update(['health_facility_id'=>$request->facility_id_to,
                                'visit_number'=>$request->visit_number_to]);

        StockManagement::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        StorageManagement10::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        StorageManagement11::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        StorageManagement12::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        StorageManagement13::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        StorageManagement14::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        Ordering15::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        Ordering16::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        Ordering17::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        Equipment18::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);
        
        Equipment19::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);
        
        Equipment20::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        Equipment21::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        InformationSystem22::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        InformationSystem23::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        InformationSystem24::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        InformationSystem25::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        InformationSystem26::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        InformationSystem27::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        SupervisedPerson::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

        Supervisor::where('form_id','=',$record->form_id)
                    ->update([ 'health_facility_id'=>$request->facility_id_to ]);

            // redirect
                Session::flash('message', 'Visit transferred successfully');
                Session::flash('alert-type', 'success');
                            
                return Redirect::to('reports/visit/summary');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $record = SurveySummary::find($id);
        $facility = HealthFacility::find($record->health_facility_id); 


        //get scores
        $scores = IndicatorScoreSummary::where('survey_summary_id',$id)->first();

        //get storage management 10
        $storage10 = StorageManagement10::where('survey_summary_id',$id)->first();
        //get storage management 11
        $storage11 = StorageManagement11::where('survey_summary_id',$id)->first();
        //get storage management 12
        $storage12 = StorageManagement12::where('survey_summary_id',$id)->first();
        //get storage management 13
        $storage13 = StorageManagement13::where('survey_summary_id',$id)->first();
        //get storage management 14
        $storage14 = StorageManagement14::where('survey_summary_id',$id)->first();

        //get ordering 15
        $ordering15 = Ordering15::where('survey_summary_id',$id)->first();
        //get ordering 16
        $ordering16 = Ordering16::where('survey_summary_id',$id)->first();
        //get ordering 17
        $ordering17 = Ordering17::where('survey_summary_id',$id)->first();

        //get ordering 16
        $equipment18 = Equipment18::where('survey_summary_id',$id)->first();
        //get ordering 17
        $equipment19 = Equipment19::where('survey_summary_id',$id)->first();
        //get ordering 15
        $equipment20 = Equipment20::where('survey_summary_id',$id)->first();
        //get ordering 15
        $equipment21 = Equipment21::where('survey_summary_id',$id)->first();


        //get info system 22
        $info_system22 = InformationSystem22::where('survey_summary_id',$id)->first();
        //get info system 23
        $info_system23 = InformationSystem23::where('survey_summary_id',$id)->first();
        //get info system 24
        $info_system24 = InformationSystem24::where('survey_summary_id',$id)->first();
        //get info system 25
        $info_system25 = InformationSystem25::where('survey_summary_id',$id)->first();
        //get info system 26
        $info_system26 = InformationSystem26::where('survey_summary_id',$id)->first();
        //get info system 27
        $info_system27 = InformationSystem27::where('survey_summary_id',$id)->first();

        //get stock management
        $stock_management = StockManagement::where('survey_summary_id',$id)->first();

        return view('survey.edit2')
                    ->with('scores',$scores)
                    ->with('stock_management',$stock_management)
                    ->with('storage10',$storage10)
                    ->with('storage11',$storage11)
                    ->with('storage12',$storage12)
                    ->with('storage13',$storage13)
                    ->with('storage14',$storage14)
                    ->with('ordering15',$ordering15)
                    ->with('ordering16',$ordering16)
                    ->with('ordering17',$ordering17)
                    ->with('equipment18',$equipment18)
                    ->with('equipment19',$equipment19)
                    ->with('equipment20',$equipment20)
                    ->with('equipment21',$equipment21)
                    ->with('info_system22',$info_system22)
                    ->with('info_system23',$info_system23)
                    ->with('info_system24',$info_system24)
                    ->with('info_system25',$info_system25)
                    ->with('info_system26',$info_system26)
                    ->with('info_system27',$info_system27)
                    ->with('facility',$facility)
                    ->with('record',$record); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $summary = SurveySummary::find($id);


        //save visit summary information
        $summary->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $summary->next_visit_date = DateTime::createFromFormat('d F Y', $request->next_visit_date);    
        $summary->visit_number = $request->visit_number;
        $summary->updated_by = Auth::user()->id;

        $summary->save();    

        $facility = HealthFacility::find($summary->health_facility_id);
        $facility->visit_number = $request->visit_number;        
        $facility->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $facility->next_visit_date = DateTime::createFromFormat('d F Y', $request->next_visit_date);    

        $facility->timestamps = false;
        $facility->save();
        

        //save storage management 10
        $storage10 = StorageManagement10::where('survey_summary_id',$id)->first();
        if($storage10 == null )
        {

            $storage10 = new StorageManagement10;

            $storage10->health_facility_id = $summary->health_facility_id;
            $storage10->survey_summary_id = $summary->id;
            $storage10->visit_date = $summary->visit_date;
            $storage10->form_id = $summary->form_id;
            $storage10->created_by = Auth::user()->id;             
        }


        $storage10->sub_indicator_10a = $request->storage_management_10a=='NA'?-1:$request->storage_management_10a;
        $storage10->sub_indicator_10b = $request->storage_management_10b=='NA'?-1:$request->storage_management_10b;
        $storage10->sub_indicator_10c = $request->storage_management_10c=='NA'?-1:$request->storage_management_10c;
        $storage10->sub_indicator_10d = $request->storage_management_10d=='NA'?-1:$request->storage_management_10d;
                                                
        $storage10->indicator_10_comments  = $request->storage_management_10_comments;

        $storage10->updated_by = Auth::user()->id;
        $storage10->save();  


        //save storage management 11
        $storage11 = StorageManagement11::where('survey_summary_id',$id)->first();
        if($storage11 == null )
        {

            $storage11 = new StorageManagement11;

            $storage11->health_facility_id = $summary->health_facility_id;
            $storage11->survey_summary_id = $summary->id;
            $storage11->visit_date = $summary->visit_date;
            $storage11->form_id = $summary->form_id;
            $storage11->created_by = Auth::user()->id;             
        }


        $storage11->sub_indicator_11a = $request->storage_management_11a=='NA'?-1:$request->storage_management_11a;
        $storage11->sub_indicator_11b = $request->storage_management_11b=='NA'?-1:$request->storage_management_11b;
        $storage11->sub_indicator_11c = $request->storage_management_11c=='NA'?-1:$request->storage_management_11c;
        $storage11->sub_indicator_11d = $request->storage_management_11d=='NA'?-1:$request->storage_management_11d;
        $storage11->sub_indicator_11e = $request->storage_management_11e=='NA'?-1:$request->storage_management_11e;
                                
        $storage11->indicator_11_comments  = $request->storage_management_11_comments;
              
        $storage11->updated_by = Auth::user()->id;
        $storage11->save();  


        //save storage management 12
        $storage12 = StorageManagement12::where('survey_summary_id',$id)->first();
        if($storage12 == null )
        {

            $storage12 = new StorageManagement12;

            $storage12->health_facility_id = $summary->health_facility_id;
            $storage12->survey_summary_id = $summary->id;
            $storage12->visit_date = $summary->visit_date;
            $storage12->form_id = $summary->form_id;
            $storage12->created_by = Auth::user()->id;             
        }


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


        $storage12->updated_by = Auth::user()->id;
        $storage12->save();  
        


        //save storage management 13        
        $storage13 = StorageManagement13::where('survey_summary_id',$id)->first();
        if($storage13 == null )
        {

            $storage13 = new StorageManagement13;

            $storage13->health_facility_id = $summary->health_facility_id;
            $storage13->survey_summary_id = $summary->id;
            $storage13->visit_date = $summary->visit_date;
            $storage13->form_id = $summary->form_id;
            $storage13->created_by = Auth::user()->id;             
        }


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

        $storage13->updated_by = Auth::user()->id;
        $storage13->save();  
        


        //save storage management 14
        $storage14 = StorageManagement14::where('survey_summary_id',$id)->first();
        if($storage14 == null )
        {

            $storage14 = new StorageManagement14;

            $storage14->health_facility_id = $summary->health_facility_id;
            $storage14->survey_summary_id = $summary->id;
            $storage14->visit_date = $summary->visit_date;
            $storage14->form_id = $summary->form_id;
            $storage14->created_by = Auth::user()->id;              
        }


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

        $storage14->updated_by = Auth::user()->id;
        $storage14->save();  

        //save ordering 15 
        $ordering15 = Ordering15::where('survey_summary_id',$id)->first();
        if($ordering15 == null )
        {
            $ordering15 = new Ordering15;

            $ordering15->health_facility_id = $summary->health_facility_id;
            $ordering15->survey_summary_id = $summary->id;
            $ordering15->visit_date = $summary->visit_date;
            $ordering15->form_id = $summary->form_id;
            $ordering15->created_by = Auth::user()->id;              
        }

        $ordering15->sub_indicator_15a = $request->ordering_15a=='NR'?-1:$request->ordering_15a;
        $ordering15->sub_indicator_15a_soh = $request->ordering_15a1;
        $ordering15->sub_indicator_15a_issued = $request->ordering_15a2;
        $ordering15->sub_indicator_15a_amc = $request->ordering_15a3;
        $ordering15->sub_indicator_15b = $request->ordering_15b=='NR'?-1:$request->ordering_15b;
        $ordering15->sub_indicator_15c = $request->ordering_15c=='NR'?-1:$request->ordering_15c;

        $ordering15->indicator_15_comments  = $request->ordering_15_comments;

        $ordering15->updated_by = Auth::user()->id;
        $ordering15->save();  



        //save ordering 16 
        $ordering16 = Ordering16::where('survey_summary_id',$id)->first();
        if($ordering16 == null )
        {
            $ordering16 = new Ordering16;

            $ordering16->health_facility_id = $summary->health_facility_id;
            $ordering16->survey_summary_id = $summary->id;
            $ordering16->visit_date = $summary->visit_date;
            $ordering16->form_id = $summary->form_id;
            $ordering16->created_by = Auth::user()->id;              
        }


        $ordering16->sub_indicator_16c = $request->ordering_16c=='NR'?-1:$request->ordering_16c;        
        $ordering16->sub_indicator_16f = $request->ordering_16f=='NR'?-1:$request->ordering_16f;
        $ordering16->indicator_16_comments  = $request->ordering_16_comments;

        $ordering16->updated_by = Auth::user()->id;
        $ordering16->save();  


        //save ordering 17 
        $ordering17 = Ordering17::where('survey_summary_id',$id)->first();
        if($ordering17 == null )
        {
            $ordering17 = new Ordering17;
            $ordering17->health_facility_id = $summary->health_facility_id;
            $ordering17->survey_summary_id = $summary->id;
            $ordering17->visit_date = $summary->visit_date;
            $ordering17->form_id = $summary->form_id;
            $ordering17->created_by = Auth::user()->id;            
        }

        
        $ordering17->sub_indicator_17a = $request->ordering_17a=='NA'?-1:$request->ordering_17a;
        $ordering17->indicator_17_comments  = $request->ordering_17_comments;

        $ordering17->updated_by = Auth::user()->id;
        $ordering17->save();  



        //save equipment 18 
        $equipment18 = Equipment18::where('survey_summary_id',$id)->first();
        if($equipment18 == null )
        {

            $equipment18 = new Equipment18;
            $equipment18->health_facility_id = $summary->health_facility_id;
            $equipment18->survey_summary_id = $summary->id;
            $equipment18->visit_date = $summary->visit_date;
            $equipment18->form_id = $summary->form_id;
            $equipment18->created_by = Auth::user()->id;            
        }

        $equipment18->sub_indicator_18a = $request->lab_equipment_18a; 
        $equipment18->sub_indicator_18b = $request->lab_equipment_18b;
        $equipment18->sub_indicator_18c = $request->lab_equipment_18c;
        $equipment18->sub_indicator_18d = $request->lab_equipment_18d;
        

        $equipment18->indicator_18_comments  = $request->lab_equipment_18_comments;

        $equipment18->updated_by = Auth::user()->id;
        $equipment18->save();  
  


        //save equipment 19 
        $equipment19 = Equipment19::where('survey_summary_id',$id)->first();
        if($equipment19 == null )
        {

            $equipment19 = new Equipment19;
            $equipment19->health_facility_id = $summary->health_facility_id;
            $equipment19->survey_summary_id = $summary->id;
            $equipment19->visit_date = $summary->visit_date;
            $equipment19->form_id = $summary->form_id;
            $equipment19->created_by = Auth::user()->id;

        }

        $equipment19->sub_indicator_19a = $request->lab_equipment_19a=='NA'?-1:$request->lab_equipment_19a; 
        $equipment19->sub_indicator_19b = $request->lab_equipment_19b=='NA'?-1:$request->lab_equipment_19b;
        $equipment19->sub_indicator_19c = $request->lab_equipment_19c=='NA'?-1:$request->lab_equipment_19c;
        $equipment19->sub_indicator_19d = $request->lab_equipment_19d=='NA'?-1:$request->lab_equipment_19d;        

        $equipment19->indicator_19_comments  = $request->lab_equipment_19_comments;

        $equipment19->updated_by = Auth::user()->id;
        $equipment19->save();  



        //save equipment 20 
        $equipment20 = Equipment20::where('survey_summary_id',$id)->first();
        if($equipment20 == null )
        {

            $equipment20 = new Equipment20;
        
            $equipment20->health_facility_id = $summary->health_facility_id;
            $equipment20->survey_summary_id = $summary->id;
            $equipment20->visit_date = $summary->visit_date;
            $equipment20->form_id = $summary->form_id;
            $equipment20->created_by = Auth::user()->id;

        }

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

        $equipment20->updated_by = Auth::user()->id;
        $equipment20->save();  



        //save equipment 21 
        $equipment21 = Equipment21::where('survey_summary_id',$id)->first();
        if($equipment21 == null )
        {

            $equipment21 = new Equipment21;
            $equipment21->health_facility_id = $summary->health_facility_id;
            $equipment21->survey_summary_id = $summary->id;
            $equipment21->visit_date = $summary->visit_date;
            $equipment21->form_id = $summary->form_id;
            $equipment21->created_by = Auth::user()->id;

        }

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

        $equipment21->updated_by = Auth::user()->id;
        $equipment21->save();  



        //save information system 22 
        $information_system22 = InformationSystem22::where('survey_summary_id',$id)->first();
        if($information_system22 == null )
        {

            $information_system22 = new InformationSystem22;
            $information_system22->health_facility_id = $summary->health_facility_id;
            $information_system22->survey_summary_id = $summary->id;
            $information_system22->visit_date = $summary->visit_date;
            $information_system22->form_id = $summary->form_id;
            $information_system22->created_by = Auth::user()->id;        

        }

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


        $information_system22->updated_by = Auth::user()->id;
        $information_system22->save();  



        //save information system 23 
        $information_system23 = InformationSystem23::where('survey_summary_id',$id)->first();
        if($information_system23 == null )
        {

            $information_system23 = new InformationSystem23;
            $information_system23->health_facility_id = $summary->health_facility_id;
            $information_system23->survey_summary_id = $summary->id;
            $information_system23->visit_date = $summary->visit_date;
            $information_system23->form_id = $summary->form_id;
            $information_system23->created_by = Auth::user()->id;

        }


        $information_system23->sub_indicator_23a = $request->lab_info_system_23a=='NA'?-1:$request->lab_info_system_23a;
        $information_system23->sub_indicator_23b = $request->lab_info_system_23b=='NA'?-1:$request->lab_info_system_23b;

        $information_system23->indicator_23_comments  = $request->lab_info_system_23_comments;



        $information_system23->updated_by = Auth::user()->id;
        $information_system23->save();  



        //save information system 24 
        $information_system24 = InformationSystem24::where('survey_summary_id',$id)->first();
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
        }


        $information_system24->sub_indicator_24c = $request->lab_info_system_24c=='NA'?-1:$request->lab_info_system_24c;

        $information_system24->indicator_24_comments  = $request->lab_info_system_24_comments;

        $information_system24->updated_by = Auth::user()->id;
        $information_system24->save();  




        //save information system 25 
        $information_system25 = InformationSystem25::where('survey_summary_id',$id)->first();
        if($information_system25 == null )
        {

            $information_system25 = new InformationSystem25;
            $information_system25->health_facility_id = $summary->health_facility_id;
            $information_system25->survey_summary_id = $summary->id;
            $information_system25->visit_date = $summary->visit_date;
            $information_system25->form_id = $summary->form_id;
            $information_system25->created_by = Auth::user()->id;

        }

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

        $information_system25->updated_by = Auth::user()->id;
        $information_system25->save();  


        //save information system 26 
        $information_system26 = InformationSystem26::where('survey_summary_id',$id)->first();
        if($information_system26 == null )
        {

            $information_system26 = new InformationSystem26;
            $information_system26->health_facility_id = $summary->health_facility_id;
            $information_system26->survey_summary_id = $summary->id;
            $information_system26->visit_date = $summary->visit_date;
            $information_system26->form_id = $summary->form_id;
            $information_system26->created_by = Auth::user()->id;

        }


        $information_system26->sub_indicator_26a = $request->lab_info_system_26a=='NA'?-1:$request->lab_info_system_26a;
        $information_system26->sub_indicator_26b = $request->lab_info_system_26b=='NA'?-1:$request->lab_info_system_26b;

        $information_system26->indicator_26_comments  = $request->lab_info_system_26_comments;

        $information_system26->updated_by = Auth::user()->id;
        $information_system26->save();  




        //save information system 27 
        $information_system27 = InformationSystem27::where('survey_summary_id',$id)->first();
        if($information_system27 == null )
        {

            $information_system27 = new InformationSystem27;

            $information_system27->health_facility_id = $summary->health_facility_id;
            $information_system27->survey_summary_id = $summary->id;
            $information_system27->visit_date = $summary->visit_date;
            $information_system27->form_id = $summary->form_id;
            $information_system27->created_by = Auth::user()->id;
        }


        $information_system27->sub_indicator_27a = $request->lab_info_system_27a=='NA'?-1:$request->lab_info_system_27a;
        $information_system27->sub_indicator_27b = $request->lab_info_system_27b=='NA'?-1:$request->lab_info_system_27b;
        $information_system27->sub_indicator_27c = $request->lab_info_system_27c=='NA'?-1:$request->lab_info_system_27c;
        $information_system27->sub_indicator_27d = $request->lab_info_system_27d=='NA'?-1:$request->lab_info_system_27d;

        $information_system27->indicator_27_comments  = $request->lab_info_system_27_comments;

        $information_system27->updated_by = Auth::user()->id;
        $information_system27->save();  


        //save stock management 
        $stock_management = StockManagement::where('survey_summary_id',$id)->first();
        if($stock_management == null )
        {

                $stock_management = new StockManagement;
                $stock_management->health_facility_id = $summary->health_facility_id;
                $stock_management->survey_summary_id = $summary->id;
                $stock_management->visit_date = $summary->visit_date;
                $stock_management->form_id = $summary->form_id;
                $stock_management->created_by = Auth::user()->id;
        }

        $stock_management->r1c1 = $request->r1_c1=='NA'?-1:$request->r1_c1;       
        $stock_management->r1c2 = $request->r1_c2=='NA'?-1:($request->r1_c2=='E'?-3:$request->r1_c2);       
        $stock_management->r1c3 = $request->r1_c3=='NA'?-1:$request->r1_c3;       
        $stock_management->r1c4 = $request->r1_c4=='NA'?-1:$request->r1_c4;       
        $stock_management->r1c5 = $request->r1_c5=='NA'?-1:$request->r1_c5;       
        $stock_management->r1c6 = $request->r1_c6=='NA'?-1:$request->r1_c6;       
        $stock_management->r1c7 = $request->r1_c7=='NA'?-1:$request->r1_c7;       
        $stock_management->r1c8 = $request->r1_c8=='NA'?-1:$request->r1_c8;       
        $stock_management->r1c9 = $request->r1_c9=='NA'?-1:$request->r1_c9;       
        $stock_management->r1c10 = $request->r1_c10=='NA'?-1:$request->r1_c10;       
        $stock_management->r1c11 = $request->r1_c11=='NA'?-1:($request->r1_c11=='NR'?-2:$request->r1_c11);       
        $stock_management->r1c12 = $request->r1_c12=='NA'?-1:($request->r1_c12=='NR'?-2:$request->r1_c12);       
        $stock_management->r1c13 = $request->r1_c13=='NA'?-1:($request->r1_c13=='NR'?-2:$request->r1_c13);       
        $stock_management->r1c14 = $request->r1_c14=='NA'?-1:$request->r1_c14;       
        $stock_management->r1c15 = $request->r1_c15=='NA'?-1:$request->r1_c15;       
        $stock_management->r1c16 = $request->r1_c16=='NA'?-1:($request->r1_c16=='NR'?-2:$request->r1_c16);       
        $stock_management->r1c17 = $request->r1_c17=='NA'?-1:($request->r1_c17=='NR'?-2:$request->r1_c17);       
        $stock_management->r1c18 = $request->r1_c18=='NA'?-1:$request->r1_c18;       
        $stock_management->r1c19 = $request->r1_c19=='NA'?-1:$request->r1_c19;       
        $stock_management->r1c20 = $request->r1_c20=='NA'?-1:$request->r1_c20;       
        $stock_management->r1c21 = $request->r1_c21=='NA'?:($request->r1_c21=='NR'?-2:$request->r1_c21);       
        $stock_management->r1c22 = $request->r1_c22=='NA'?:($request->r1_c22=='PS'?-4:($request->r1_c22=='NR'?-2:$request->r1_c22));       


        $stock_management->r2c2_cd4item = $request->cd4_testing;  
        $stock_management->r2c1 = $request->r2_c1=='NA'?-1:$request->r2_c1;       
        $stock_management->r2c2 = $request->r2_c2=='NA'?-1:($request->r2_c2=='E'?-3:$request->r2_c2);       
        $stock_management->r2c3 = $request->r2_c3=='NA'?-1:$request->r2_c3;       
        $stock_management->r2c4 = $request->r2_c4=='NA'?-1:$request->r2_c4;       
        $stock_management->r2c5 = $request->r2_c5=='NA'?-1:$request->r2_c5;       
        $stock_management->r2c6 = $request->r2_c6=='NA'?-1:$request->r2_c6;       
        $stock_management->r2c7 = $request->r2_c7=='NA'?-1:$request->r2_c7;       
        $stock_management->r2c8 = $request->r2_c8=='NA'?-1:$request->r2_c8;       
        $stock_management->r2c9 = $request->r2_c9=='NA'?-1:$request->r2_c9;       
        $stock_management->r2c10 = $request->r2_c10=='NA'?-1:$request->r2_c10;       
        $stock_management->r2c11 = $request->r2_c11=='NA'?-1:($request->r2_c11=='NR'?-2:$request->r2_c11);       
        $stock_management->r2c12 = $request->r2_c12=='NA'?-1:($request->r2_c12=='NR'?-2:$request->r2_c12);       
        $stock_management->r2c13 = $request->r2_c13=='NA'?-1:($request->r2_c13=='NR'?-2:$request->r2_c13);       
        $stock_management->r2c14 = $request->r2_c14=='NA'?-1:$request->r2_c14;       
        $stock_management->r2c15 = $request->r2_c15=='NA'?-1:$request->r2_c15;       
        $stock_management->r2c16 = $request->r2_c16=='NA'?-1:($request->r2_c16=='NR'?-2:$request->r2_c16);       
        $stock_management->r2c17 = $request->r2_c17=='NA'?-1:($request->r2_c17=='NR'?-2:$request->r2_c17);       
        $stock_management->r2c18 = $request->r2_c18=='NA'?-1:$request->r2_c18;       
        $stock_management->r2c19 = $request->r2_c19=='NA'?-1:$request->r2_c19;       
        $stock_management->r2c20 = $request->r2_c20=='NA'?-1:$request->r2_c20;       
        $stock_management->r2c21 = $request->r2_c21=='NA'?:($request->r2_c21=='NR'?-2:$request->r2_c21);       
        $stock_management->r2c22 = $request->r2_c22=='NA'?:($request->r2_c22=='PS'?-4:($request->r2_c22=='NR'?-2:$request->r2_c22));       


        $stock_management->r3c1 = $request->r3_c1=='NA'?-1:$request->r3_c1;       
        $stock_management->r3c2 = $request->r3_c2=='NA'?-1:($request->r3_c2=='E'?-3:$request->r3_c2);       
        $stock_management->r3c3 = $request->r3_c3=='NA'?-1:$request->r3_c3;       
        $stock_management->r3c4 = $request->r3_c4=='NA'?-1:$request->r3_c4;       
        $stock_management->r3c5 = $request->r3_c5=='NA'?-1:$request->r3_c5;       
        $stock_management->r3c6 = $request->r3_c6=='NA'?-1:$request->r3_c6;       
        $stock_management->r3c7 = $request->r3_c7=='NA'?-1:$request->r3_c7;       
        $stock_management->r3c8 = $request->r3_c8=='NA'?-1:$request->r3_c8;       
        $stock_management->r3c9 = $request->r3_c9=='NA'?-1:$request->r3_c9;       
        $stock_management->r3c10 = $request->r3_c10=='NA'?-1:$request->r3_c10;       
        $stock_management->r3c11 = $request->r3_c11=='NA'?-1:($request->r3_c11=='NR'?-2:$request->r3_c11);       
        $stock_management->r3c12 = $request->r3_c12=='NA'?-1:($request->r3_c12=='NR'?-2:$request->r3_c12);       
        $stock_management->r3c13 = $request->r3_c13=='NA'?-1:($request->r3_c13=='NR'?-2:$request->r3_c13);       
        $stock_management->r3c14 = $request->r3_c14=='NA'?-1:$request->r3_c14;       
        $stock_management->r3c15 = $request->r3_c15=='NA'?-1:$request->r3_c15;       
        $stock_management->r3c16 = $request->r3_c16=='NA'?-1:($request->r3_c16=='NR'?-2:$request->r3_c16);       
        $stock_management->r3c17 = $request->r3_c17=='NA'?-1:($request->r3_c17=='NR'?-2:$request->r3_c17);       
        $stock_management->r3c18 = $request->r3_c18=='NA'?-1:$request->r3_c18;       
        $stock_management->r3c19 = $request->r3_c19=='NA'?-1:$request->r3_c19;       
        $stock_management->r3c20 = $request->r3_c20=='NA'?-1:$request->r3_c20;       
        $stock_management->r3c21 = $request->r3_c21=='NA'?:($request->r3_c21=='NR'?-2:$request->r3_c21);       
        $stock_management->r3c22 = $request->r3_c22=='NA'?:($request->r3_c22=='PS'?-4:($request->r3_c22=='NR'?-2:$request->r3_c22));       


        $stock_management->r11c1 = $request->r3b_c1=='NA'?-1:$request->r3b_c1;       
        $stock_management->r11c2 = $request->r3b_c2=='NA'?-1:($request->r3b_c2=='E'?-3:$request->r3b_c2);       
        $stock_management->r11c3 = $request->r3b_c3=='NA'?-1:$request->r3b_c3;       
        $stock_management->r11c4 = $request->r3b_c4=='NA'?-1:$request->r3b_c4;       
        $stock_management->r11c5 = $request->r3b_c5=='NA'?-1:$request->r3b_c5;       
        $stock_management->r11c6 = $request->r3b_c6=='NA'?-1:$request->r3b_c6;       
        $stock_management->r11c7 = $request->r3b_c7=='NA'?-1:$request->r3b_c7;       
        $stock_management->r11c8 = $request->r3b_c8=='NA'?-1:$request->r3b_c8;       
        $stock_management->r11c9 = $request->r3b_c9=='NA'?-1:$request->r3b_c9;       
        $stock_management->r11c10 = $request->r3b_c10=='NA'?-1:$request->r3b_c10;       
        $stock_management->r11c11 = $request->r3b_c11=='NA'?-1:($request->r3b_c11=='NR'?-2:$request->r3b_c11);       
        $stock_management->r11c12 = $request->r3b_c12=='NA'?-1:($request->r3b_c12=='NR'?-2:$request->r3b_c12);       
        $stock_management->r11c13 = $request->r3b_c13=='NA'?-1:($request->r3b_c13=='NR'?-2:$request->r3b_c13);       
        $stock_management->r11c14 = $request->r3b_c14=='NA'?-1:$request->r3b_c14;       
        $stock_management->r11c15 = $request->r3b_c15=='NA'?-1:$request->r3b_c15;       
        $stock_management->r11c16 = $request->r3b_c16=='NA'?-1:($request->r3b_c16=='NR'?-2:$request->r3b_c16);       
        $stock_management->r11c17 = $request->r3b_c17=='NA'?-1:($request->r3b_c17=='NR'?-2:$request->r3b_c17);       
        $stock_management->r11c18 = $request->r3b_c18=='NA'?-1:$request->r3b_c18;       
        $stock_management->r11c19 = $request->r3b_c19=='NA'?-1:$request->r3b_c19;       
        $stock_management->r11c20 = $request->r3b_c20=='NA'?-1:$request->r3b_c20;       
        $stock_management->r11c21 = $request->r3b_c21=='NA'?:($request->r3b_c21=='NR'?-2:$request->r3b_c21);       
        $stock_management->r11c22 = $request->r3b_c22=='NA'?:($request->r3b_c22=='PS'?-4:($request->r3b_c22=='NR'?-2:$request->r3b_c22));       


        $stock_management->r4c1 = $request->r4_c1=='NA'?-1:$request->r4_c1;       
        $stock_management->r4c2 = $request->r4_c2=='NA'?-1:($request->r4_c2=='E'?-3:$request->r4_c2);       
        $stock_management->r4c3 = $request->r4_c3=='NA'?-1:$request->r4_c3;       
        $stock_management->r4c4 = $request->r4_c4=='NA'?-1:$request->r4_c4;       
        $stock_management->r4c5 = $request->r4_c5=='NA'?-1:$request->r4_c5;       
        $stock_management->r4c6 = $request->r4_c6=='NA'?-1:$request->r4_c6;       
        $stock_management->r4c7 = $request->r4_c7=='NA'?-1:$request->r4_c7;       
        $stock_management->r4c8 = $request->r4_c8=='NA'?-1:$request->r4_c8;       
        $stock_management->r4c9 = $request->r4_c9=='NA'?-1:$request->r4_c9;       
        $stock_management->r4c10 = $request->r4_c10=='NA'?-1:$request->r4_c10;       
        $stock_management->r4c11 = $request->r4_c11=='NA'?-1:($request->r4_c11=='NR'?-2:$request->r4_c11);       
        $stock_management->r4c12 = $request->r4_c12=='NA'?-1:($request->r4_c12=='NR'?-2:$request->r4_c12);       
        $stock_management->r4c13 = $request->r4_c13=='NA'?-1:($request->r4_c13=='NR'?-2:$request->r4_c13);       
        $stock_management->r4c14 = $request->r4_c14=='NA'?-1:$request->r4_c14;       
        $stock_management->r4c15 = $request->r4_c15=='NA'?-1:$request->r4_c15;       
        $stock_management->r4c16 = $request->r4_c16=='NA'?-1:($request->r4_c16=='NR'?-2:$request->r4_c16);       
        $stock_management->r4c17 = $request->r4_c17=='NA'?-1:($request->r4_c17=='NR'?-2:$request->r4_c17);       
        $stock_management->r4c18 = $request->r4_c18=='NA'?-1:$request->r4_c18;       
        $stock_management->r4c19 = $request->r4_c19=='NA'?-1:$request->r4_c19;       
        $stock_management->r4c20 = $request->r4_c20=='NA'?-1:$request->r4_c20;       
        $stock_management->r4c21 = $request->r4_c21=='NA'?:($request->r4_c21=='NR'?-2:$request->r4_c21);       
        $stock_management->r4c22 = $request->r4_c22=='NA'?:($request->r4_c22=='PS'?-4:($request->r4_c22=='NR'?-2:$request->r4_c22));       


        $stock_management->r10c1 = $request->r4b_c1=='NA'?-1:$request->r4b_c1;       
        $stock_management->r10c2 = $request->r4b_c2=='NA'?-1:($request->r4b_c2=='E'?-3:$request->r4b_c2);       
        $stock_management->r10c3 = $request->r4b_c3=='NA'?-1:$request->r4b_c3;       
        $stock_management->r10c4 = $request->r4b_c4=='NA'?-1:$request->r4b_c4;       
        $stock_management->r10c5 = $request->r4b_c5=='NA'?-1:$request->r4b_c5;       
        $stock_management->r10c6 = $request->r4b_c6=='NA'?-1:$request->r4b_c6;       
        $stock_management->r10c7 = $request->r4b_c7=='NA'?-1:$request->r4b_c7;       
        $stock_management->r10c8 = $request->r4b_c8=='NA'?-1:$request->r4b_c8;       
        $stock_management->r10c9 = $request->r4b_c9=='NA'?-1:$request->r4b_c9;       
        $stock_management->r10c10 = $request->r4b_c10=='NA'?-1:$request->r4b_c10;       
        $stock_management->r10c11 = $request->r4b_c11=='NA'?-1:($request->r4b_c11=='NR'?-2:$request->r4b_c11);       
        $stock_management->r10c12 = $request->r4b_c12=='NA'?-1:($request->r4b_c12=='NR'?-2:$request->r4b_c12);       
        $stock_management->r10c13 = $request->r4b_c13=='NA'?-1:($request->r4b_c13=='NR'?-2:$request->r4b_c13);       
        $stock_management->r10c14 = $request->r4b_c14=='NA'?-1:$request->r4b_c14;       
        $stock_management->r10c15 = $request->r4b_c15=='NA'?-1:$request->r4b_c15;       
        $stock_management->r10c16 = $request->r4b_c16=='NA'?-1:($request->r4b_c16=='NR'?-2:$request->r4b_c16);       
        $stock_management->r10c17 = $request->r4b_c17=='NA'?-1:($request->r4b_c17=='NR'?-2:$request->r4b_c17);       
        $stock_management->r10c18 = $request->r4b_c18=='NA'?-1:$request->r4b_c18;       
        $stock_management->r10c19 = $request->r4b_c19=='NA'?-1:$request->r4b_c19;       
        $stock_management->r10c20 = $request->r4b_c20=='NA'?-1:$request->r4b_c20;       
        $stock_management->r10c21 = $request->r4b_c21=='NA'?:($request->r4b_c21=='NR'?-2:$request->r4b_c21);       
        $stock_management->r10c22 = $request->r4b_c22=='NA'?:($request->r4b_c22=='PS'?-4:($request->r4b_c22=='NR'?-2:$request->r4b_c22));       


        $stock_management->r5c1 = $request->r5_c1=='NA'?-1:$request->r5_c1;       
        $stock_management->r5c2 = $request->r5_c2=='NA'?-1:($request->r5_c2=='E'?-3:$request->r5_c2);       
        $stock_management->r5c3 = $request->r5_c3=='NA'?-1:$request->r5_c3;       
        $stock_management->r5c4 = $request->r5_c4=='NA'?-1:$request->r5_c4;       
        $stock_management->r5c5 = $request->r5_c5=='NA'?-1:$request->r5_c5;       
        $stock_management->r5c6 = $request->r5_c6=='NA'?-1:$request->r5_c6;       
        $stock_management->r5c7 = $request->r5_c7=='NA'?-1:$request->r5_c7;       
        $stock_management->r5c8 = $request->r5_c8=='NA'?-1:$request->r5_c8;       
        $stock_management->r5c9 = $request->r5_c9=='NA'?-1:$request->r5_c9;       
        $stock_management->r5c10 = $request->r5_c10=='NA'?-1:$request->r5_c10;       
        $stock_management->r5c11 = $request->r5_c11=='NA'?-1:($request->r5_c11=='NR'?-2:$request->r5_c11);       
        $stock_management->r5c12 = $request->r5_c12=='NA'?-1:($request->r5_c12=='NR'?-2:$request->r5_c12);       
        $stock_management->r5c13 = $request->r5_c13=='NA'?-1:($request->r5_c13=='NR'?-2:$request->r5_c13);       
        $stock_management->r5c14 = $request->r5_c14=='NA'?-1:$request->r5_c14;       
        $stock_management->r5c15 = $request->r5_c15=='NA'?-1:$request->r5_c15;       
        $stock_management->r5c16 = $request->r5_c16=='NA'?-1:($request->r5_c16=='NR'?-2:$request->r5_c16);       
        $stock_management->r5c17 = $request->r5_c17=='NA'?-1:($request->r5_c17=='NR'?-2:$request->r5_c17);       
        $stock_management->r5c18 = $request->r5_c18=='NA'?-1:$request->r5_c18;       
        $stock_management->r5c19 = $request->r5_c19=='NA'?-1:$request->r5_c19;       
        $stock_management->r5c20 = $request->r5_c20=='NA'?-1:$request->r5_c20;       
        $stock_management->r5c21 = $request->r5_c21=='NA'?:($request->r5_c21=='NR'?-2:$request->r5_c21);       
        $stock_management->r5c22 = $request->r5_c22=='NA'?:($request->r5_c22=='PS'?-4:($request->r5_c22=='NR'?-2:$request->r5_c22));       


        $stock_management->r6c1 = $request->r6_c1=='NA'?-1:$request->r6_c1;       
        $stock_management->r6c2 = $request->r6_c2=='NA'?-1:($request->r6_c2=='E'?-3:$request->r6_c2);       
        $stock_management->r6c3 = $request->r6_c3=='NA'?-1:$request->r6_c3;       
        $stock_management->r6c4 = $request->r6_c4=='NA'?-1:$request->r6_c4;       
        $stock_management->r6c5 = $request->r6_c5=='NA'?-1:$request->r6_c5;       
        $stock_management->r6c6 = $request->r6_c6=='NA'?-1:$request->r6_c6;       
        $stock_management->r6c7 = $request->r6_c7=='NA'?-1:$request->r6_c7;       
        $stock_management->r6c8 = $request->r6_c8=='NA'?-1:$request->r6_c8;       
        $stock_management->r6c9 = $request->r6_c9=='NA'?-1:$request->r6_c9;       
        $stock_management->r6c10 = $request->r6_c10=='NA'?-1:$request->r6_c10;       
        $stock_management->r6c11 = $request->r6_c11=='NA'?-1:($request->r6_c11=='NR'?-2:$request->r6_c11);       
        $stock_management->r6c12 = $request->r6_c12=='NA'?-1:($request->r6_c12=='NR'?-2:$request->r6_c12);       
        $stock_management->r6c13 = $request->r6_c13=='NA'?-1:($request->r6_c13=='NR'?-2:$request->r6_c13);       
        $stock_management->r6c14 = $request->r6_c14=='NA'?-1:$request->r6_c14;       
        $stock_management->r6c15 = $request->r6_c15=='NA'?-1:$request->r6_c15;       
        $stock_management->r6c16 = $request->r6_c16=='NA'?-1:($request->r6_c16=='NR'?-2:$request->r6_c16);       
        $stock_management->r6c17 = $request->r6_c17=='NA'?-1:($request->r6_c17=='NR'?-2:$request->r6_c17);       
        $stock_management->r6c18 = $request->r6_c18=='NA'?-1:$request->r6_c18;       
        $stock_management->r6c19 = $request->r6_c19=='NA'?-1:$request->r6_c19;       
        $stock_management->r6c20 = $request->r6_c20=='NA'?-1:$request->r6_c20;       
        $stock_management->r6c21 = $request->r6_c21=='NA'?:($request->r6_c21=='NR'?-2:$request->r6_c21);       
        $stock_management->r6c22 = $request->r6_c22=='NA'?:($request->r6_c22=='PS'?-4:($request->r6_c22=='NR'?-2:$request->r6_c22));       


        $stock_management->r7c1 = $request->r7_c1=='NA'?-1:$request->r7_c1;       
        $stock_management->r7c2 = $request->r7_c2=='NA'?-1:($request->r7_c2=='E'?-3:$request->r7_c2);       
        $stock_management->r7c3 = $request->r7_c3=='NA'?-1:$request->r7_c3;       
        $stock_management->r7c4 = $request->r7_c4=='NA'?-1:$request->r7_c4;       
        $stock_management->r7c5 = $request->r7_c5=='NA'?-1:$request->r7_c5;       
        $stock_management->r7c6 = $request->r7_c6=='NA'?-1:$request->r7_c6;       
        $stock_management->r7c7 = $request->r7_c7=='NA'?-1:$request->r7_c7;       
        $stock_management->r7c8 = $request->r7_c8=='NA'?-1:$request->r7_c8;       
        $stock_management->r7c9 = $request->r7_c9=='NA'?-1:$request->r7_c9;       
        $stock_management->r7c10 = $request->r7_c10=='NA'?-1:$request->r7_c10;       
        $stock_management->r7c11 = $request->r7_c11=='NA'?-1:($request->r7_c11=='NR'?-2:$request->r7_c11);       
        $stock_management->r7c12 = $request->r7_c12=='NA'?-1:($request->r7_c12=='NR'?-2:$request->r7_c12);       
        $stock_management->r7c13 = $request->r7_c13=='NA'?-1:($request->r7_c13=='NR'?-2:$request->r7_c13);       
        $stock_management->r7c14 = $request->r7_c14=='NA'?-1:$request->r7_c14;       
        $stock_management->r7c15 = $request->r7_c15=='NA'?-1:$request->r7_c15;       
        $stock_management->r7c16 = $request->r7_c16=='NA'?-1:($request->r7_c16=='NR'?-2:$request->r7_c16);       
        $stock_management->r7c17 = $request->r7_c17=='NA'?-1:($request->r7_c17=='NR'?-2:$request->r7_c17);       
        $stock_management->r7c18 = $request->r7_c18=='NA'?-1:$request->r7_c18;       
        $stock_management->r7c19 = $request->r7_c19=='NA'?-1:$request->r7_c19;       
        $stock_management->r7c20 = $request->r7_c20=='NA'?-1:$request->r7_c20;       
        $stock_management->r7c21 = $request->r7_c21=='NA'?:($request->r7_c21=='NR'?-2:$request->r7_c21);       
        $stock_management->r7c22 = $request->r7_c22=='NA'?:($request->r7_c22=='PS'?-4:($request->r7_c22=='NR'?-2:$request->r7_c22));       


        $stock_management->r8c1 = $request->r8_c1=='NA'?-1:$request->r8_c1;       
        $stock_management->r8c2 = $request->r8_c2=='NA'?-1:($request->r8_c2=='E'?-3:$request->r8_c2);       
        $stock_management->r8c3 = $request->r8_c3=='NA'?-1:$request->r8_c3;       
        $stock_management->r8c4 = $request->r8_c4=='NA'?-1:$request->r8_c4;       
        $stock_management->r8c5 = $request->r8_c5=='NA'?-1:$request->r8_c5;       
        $stock_management->r8c6 = $request->r8_c6=='NA'?-1:$request->r8_c6;       
        $stock_management->r8c7 = $request->r8_c7=='NA'?-1:$request->r8_c7;       
        $stock_management->r8c8 = $request->r8_c8=='NA'?-1:$request->r8_c8;       
        $stock_management->r8c9 = $request->r8_c9=='NA'?-1:$request->r8_c9;       
        $stock_management->r8c10 = $request->r8_c10=='NA'?-1:$request->r8_c10;       
        $stock_management->r8c11 = $request->r8_c11=='NA'?-1:($request->r8_c11=='NR'?-2:$request->r8_c11);       
        $stock_management->r8c12 = $request->r8_c12=='NA'?-1:($request->r8_c12=='NR'?-2:$request->r8_c12);       
        $stock_management->r8c13 = $request->r8_c13=='NA'?-1:($request->r8_c13=='NR'?-2:$request->r8_c13);       
        $stock_management->r8c14 = $request->r8_c14=='NA'?-1:$request->r8_c14;       
        $stock_management->r8c15 = $request->r8_c15=='NA'?-1:$request->r8_c15;       
        $stock_management->r8c16 = $request->r8_c16=='NA'?-1:($request->r8_c16=='NR'?-2:$request->r8_c16);       
        $stock_management->r8c17 = $request->r8_c17=='NA'?-1:($request->r8_c17=='NR'?-2:$request->r8_c17);       
        $stock_management->r8c18 = $request->r8_c18=='NA'?-1:$request->r8_c18;       
        $stock_management->r8c19 = $request->r8_c19=='NA'?-1:$request->r8_c19;       
        $stock_management->r8c20 = $request->r8_c20=='NA'?-1:$request->r8_c20;       
        $stock_management->r8c21 = $request->r8_c21=='NA'?:($request->r8_c21=='NR'?-2:$request->r8_c21);       
        $stock_management->r8c22 = $request->r8_c22=='NA'?:($request->r8_c22=='PS'?-4:($request->r8_c22=='NR'?-2:$request->r8_c22));       


        $stock_management->r9c1 = $request->r9_c1=='NA'?-1:$request->r9_c1;       
        $stock_management->r9c2 = $request->r9_c2=='NA'?-1:($request->r9_c2=='E'?-3:$request->r9_c2);       
        $stock_management->r9c3 = $request->r9_c3=='NA'?-1:$request->r9_c3;       
        $stock_management->r9c4 = $request->r9_c4=='NA'?-1:$request->r9_c4;       
        $stock_management->r9c5 = $request->r9_c5=='NA'?-1:$request->r9_c5;       
        $stock_management->r9c6 = $request->r9_c6=='NA'?-1:$request->r9_c6;       
        $stock_management->r9c7 = $request->r9_c7=='NA'?-1:$request->r9_c7;       
        $stock_management->r9c8 = $request->r9_c8=='NA'?-1:$request->r9_c8;       
        $stock_management->r9c9 = $request->r9_c9=='NA'?-1:$request->r9_c9;       
        $stock_management->r9c10 = $request->r9_c10=='NA'?-1:$request->r9_c10;       
        $stock_management->r9c11 = $request->r9_c11=='NA'?-1:($request->r9_c11=='NR'?-2:$request->r9_c11);       
        $stock_management->r9c12 = $request->r9_c12=='NA'?-1:($request->r9_c12=='NR'?-2:$request->r9_c12);       
        $stock_management->r9c13 = $request->r9_c13=='NA'?-1:($request->r9_c13=='NR'?-2:$request->r9_c13);       
        $stock_management->r9c14 = $request->r9_c14=='NA'?-1:$request->r9_c14;       
        $stock_management->r9c15 = $request->r9_c15=='NA'?-1:$request->r9_c15;       
        $stock_management->r9c16 = $request->r9_c16=='NA'?-1:($request->r9_c16=='NR'?-2:$request->r9_c16);       
        $stock_management->r9c17 = $request->r9_c17=='NA'?-1:($request->r9_c17=='NR'?-2:$request->r9_c17);       
        $stock_management->r9c18 = $request->r9_c18=='NA'?-1:$request->r9_c18;       
        $stock_management->r9c19 = $request->r9_c19=='NA'?-1:$request->r9_c19;       
        $stock_management->r9c20 = $request->r9_c20=='NA'?-1:$request->r9_c20;       
        $stock_management->r9c21 = $request->r9_c21=='NA'?:($request->r9_c21=='NR'?-2:$request->r9_c21);       
        $stock_management->r9c22 = $request->r9_c22=='NA'?:($request->r9_c22=='PS'?-4:($request->r9_c22=='NR'?-2:$request->r9_c22));       



        $stock_management->stock_management_comments  = $request->stock_management_comments;

        $stock_management->updated_by = Auth::user()->id;
        $stock_management->save();  


        //save indicator summary scores
        $indicator_score = IndicatorScoreSummary::where('survey_summary_id',$id)->first();

        $indicator_score->indicator1_score = $request->stock_management_1_score;
        $indicator_score->indicator2_score = $request->stock_management_2_score;        
        $indicator_score->indicator3_score = $request->stock_management_3_score;
        $indicator_score->indicator4_score = $request->stock_management_4_score;
        $indicator_score->indicator5_score = $request->stock_management_5_score;        
        $indicator_score->indicator6_score = $request->stock_management_6_score;
        $indicator_score->indicator7_score = $request->stock_management_7_score;
        $indicator_score->indicator8_score = $request->stock_management_8_score;        
        $indicator_score->indicator9_score = $request->stock_management_9_score;
        $indicator_score->indicator10_score = $request->storage_management_10_score;
        $indicator_score->indicator11_score = $request->storage_management_11_score;
        $indicator_score->indicator12_score = $request->storage_management_12_score;
        $indicator_score->indicator13_score = $request->storage_management_13_score;
        $indicator_score->indicator14_score = $request->storage_management_14_score;
        $indicator_score->indicator15_score = $request->ordering_15_score;
        $indicator_score->indicator16_score = $request->ordering_16_score;
        $indicator_score->indicator17_score = $request->ordering_17_score;        
        $indicator_score->indicator18_score = $request->lab_equipment_18_score;
        $indicator_score->indicator19_score = $request->lab_equipment_19_score;
        $indicator_score->indicator20_score = $request->lab_equipment_20_score;        
        $indicator_score->indicator21_score = $request->lab_equipment_21_score;
        $indicator_score->indicator22_score = $request->lab_info_system_22_score;
        $indicator_score->indicator23_score = $request->lab_info_system_23_score;        
        $indicator_score->indicator24_score = $request->lab_info_system_24_score;
        $indicator_score->indicator25_score = $request->lab_info_system_25_score;
        $indicator_score->indicator26_score = $request->lab_info_system_26_score;        
        $indicator_score->indicator27_score = $request->lab_info_system_27_score;

        $indicator_score->updated_by = Auth::user()->id;
        $indicator_score->save();  


        // redirect
        Session::flash('message', 'Form edited successfully.');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('reports/visit/summary');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
