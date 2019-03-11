<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\District;

use App\Models\Cadre;

use App\Models\Indicator;

use App\Models\Personnel;

use App\Models\SurveySummary;

use App\Models\HealthFacility;

use App\Models\Supervisor;

use App\Models\SupervisedPerson;

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

use App\User;

use App\Audit;

use App\VuSummaryScore;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

use Session;

use DateTime;

use Excel;

use DB;

use Illuminate\Support\Collection;

use Yajra\Datatables\Facades\Datatables;


class ReportsController extends Controller
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

    public function getSurveySummary()
    {

        //List survey summaries
        $summaries = SurveySummary::orderBy('created_at', 'desc')->get();


        //dd($summaries->form_id);

        //Load the view and pass the personnel list
        return view('reports.survey.summary')->with('summaries',$summaries);
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function surveyDTable(Request $request)
    {


        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $summaries = SurveySummary::orderBy('created_at', 'asc')
                        ->whereBetween('created_at', array($start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59')))
                        ->get()->all();
            $i=0;

        $formatted_list = new Collection;

        foreach ($summaries as $record) {

            $attributes = [];
            $facility = HealthFacility::where('id','=',$record->health_facility_id)->get()->all();


        /*populate supervisors*/
            $supervisors = Supervisor::where('form_id','=',$record->form_id)->with('Person')->get()->all();

            $supervisor_list = "";

            foreach($supervisors as $supervisor)
            {

                $supervisor_list = $supervisor_list.$supervisor->person->first_name. ' '.$supervisor->person->last_name.' ('.$supervisor->person->telephone.')'  ."\n";

            }
        /*end supervisor populations*/


        /*populate supervisees*/
            $supervisees = SupervisedPerson::where('form_id','=',$record->form_id)->get()->all();

            $supervisee_list = "";

            foreach($supervisees as $supervisee)
            {

                $supervisee_list=$supervisee_list.$supervisee->name. ' ('.$supervisee->phone_number.')' ."\n";

            }
        /*end supervisees populations*/


        /*find user*/
            $user = User::find($record->created_by);
        /*end find user*/

            $edit_user = null;

            if($record->updated_by != null)
            {

                $edit_user = User::find($record->updated_by);

            }

            $attributes=$summaries[$i]['attributes'];

            $created_at = DateTime::createFromFormat( 'Y-m-d H:i:s', $attributes['created_at'] )->format('d F Y') ;
            $visit_date = DateTime::createFromFormat( 'Y-m-d', $attributes['visit_date'] )->format('d F Y') ;
            $next_visit_date = DateTime::createFromFormat( 'Y-m-d', $attributes['next_visit_date'] )->format('d F Y') ;

            $x = array_merge( array($attributes), array($facility[0]['attributes']), array($supervisor_list), array($supervisee_list), array($user->name), $edit_user!=null?array($user->name):array(null), array($created_at), array($visit_date), array($next_visit_date) );


            $formatted_list->push($x);

            $i++;

        }

        return DataTables::of( $formatted_list )
        ->addIndexColumn()
        ->addColumn('action', function($row) {
            return '<a href="' . route("survey.edit",  $row['0']['id']  ) . '" class="btn btn-sm btn-link"><i class="ion-edit"></i> </a>'.'<a href="' . route("survey.destroy",  $row['0']['id']  ) . '" class="btn btn-sm btn-link"><i class="ion-trash-a"></i> </a>';
        })
        ->make(true);

    }



    public function surveySummaryReport(Request $request)
    {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $summaries = SurveySummary::orderBy('created_at', 'asc')
                        ->whereBetween('created_at', array($start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59')))
                        ->get()->all();
            $i=0;
            $formatted_list = array( );
        foreach ($summaries as $record) {

            $attributes = [];
            $facility = HealthFacility::where('id','=',$record->health_facility_id)->get()->all();


        /*populate supervisors*/
            $supervisors = Supervisor::where('form_id','=',$record->form_id)->with('Person')->get()->all();

            $supervisor_list = "";

            foreach($supervisors as $supervisor)
            {

                $supervisor_list = $supervisor_list.$supervisor->person->first_name. ' '.$supervisor->person->last_name.' ('.$supervisor->person->telephone.')'  ."\n";

            }
        /*end supervisor populations*/


        /*populate supervisees*/
            $supervisees = SupervisedPerson::where('form_id','=',$record->form_id)->get()->all();

            $supervisee_list = "";

            foreach($supervisees as $supervisee)
            {

                $supervisee_list=$supervisee_list.$supervisee->name. ' ('.$supervisee->phone_number.')' ."\n";

            }
        /*end supervisees populations*/


        /*find user*/
            $user = User::find($record->created_by);
        /*end find user*/

            $edit_user = null;

            if($record->updated_by != null)
            {

                $edit_user = User::find($record->updated_by);

            }

            $attributes=$summaries[$i]['attributes'];

            $x = array_merge( array($attributes), array($facility[0]['attributes']), array($supervisor_list), array($supervisee_list), array($user->name), $edit_user!=null?array($user->name):array(null) );

            array_push($formatted_list,$x);

            $i++;

        }

        return $formatted_list;

    }

    public function surveySummaryReportToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('SPARS Visit Summary', function($excel) use ($request)  {


        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $summaries = SurveySummary::orderBy('created_at', 'asc')
                        ->whereBetween('created_at', array($start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59')))
                        ->get()->all();
            $i=0;
            $formatted_list = array( );
        foreach ($summaries as $record) {

            $attributes = [];
            $facility = HealthFacility::where('id','=',$record->health_facility_id)->get()->all();


        /*populate supervisors*/
            $supervisors = Supervisor::where('form_id','=',$record->form_id)->with('Person')->get()->all();

            $supervisor_list = "";

            foreach($supervisors as $supervisor)
            {

                $supervisor_list = $supervisor_list.$supervisor->person->first_name. ' '.$supervisor->person->last_name.' ('.$supervisor->person->telephone.')'  ."\n";

            }
        /*end supervisor populations*/


        /*populate supervisees*/
            $supervisees = SupervisedPerson::where('form_id','=',$record->form_id)->get()->all();

            $supervisee_list = "";

            foreach($supervisees as $supervisee)
            {

                $supervisee_list=$supervisee_list.$supervisee->name. ' ('.$supervisee->phone_number.')' ."\n";

            }
        /*end supervisees populations*/


        /*find user*/
            $user = User::find($record->created_by);
        /*end find user*/


            $attributes=$summaries[$i]['attributes'];

            $x = array_merge( array($attributes), array($facility[0]['attributes']), array($supervisor_list), array($supervisee_list), array($user->name) );

            array_push($formatted_list,$x);

            $i++;

        }


        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Region', 'District','Facility','Level','Ownership','Visit number','Visit date','Next visit date','Submission date','Submitted by','Superviors','Persons supervised'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($formatted_list as $row) {

                $visit_date = DateTime::createFromFormat('Y-m-d', $row[0]['visit_date']);
                $next_visit_date = DateTime::createFromFormat('Y-m-d', $row[0]['next_visit_date']);
                $submission_date = new DateTime($row[0]['created_at']);

                //dd(number_format($row[1],2));
                $par_array[] = [$row[1]['region'],$row[1]['district'],$row[1]['facility'],$row[1]['level'],$row[1]['ownership'],$row[0]['visit_number'],$visit_date->format('d F Y'),$next_visit_date->format('d F Y'),$submission_date->format('d F Y'),$row[4],$row[2],$row[3]];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Visits summary');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Lab SPARS visit summary');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:K1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Lab SPARS visit summary", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);


    }



    public function getScoreSummary()
    {

        //Load the view
        return view('reports.survey.score');

    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function scoresDTable(Request $request)
    {


        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        return DataTables::of( VuSummaryScore::orderBy('visit_date', 'desc')
                        ->whereBetween('visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
                        ->get() )
        ->addIndexColumn()
        ->make(true);

    }

    public function scoreSummaryReport(Request $request)
    {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $summaries = VuSummaryScore::orderBy('visit_date', 'desc')
                        ->whereBetween('visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
                        ->get()->all();

        return $summaries;

    }

    public function scoreSummaryReportToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('SPARS Score Summary', function($excel) use ($request)  {


        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $summaries = VuSummaryScore::orderBy('visit_date', 'desc')
                        ->whereBetween('visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
                        ->get()->all();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Indicator 1','Indicator 2','Indicator 3','Indicator 4','Indicator 5','Indicator 6','Indicator 7','Indicator 8','Indicator 9','Indicator 10','Indicator 11','Indicator 12','Indicator 13','Indicator 14','Indicator 15','Indicator 16','Indicator 17','Indicator 18','Indicator 19','Indicator 20','Indicator 21','Indicator 22','Indicator 23','Indicator 24','Indicator 25','Indicator 26','Indicator 27'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($summaries as $row) {

                $visit_date = DateTime::createFromFormat('Y-m-d', $row->visit_date);
                $facility = HealthFacility::find($row->health_facility_id);

                //dd(number_format($row[1],2));
                $par_array[] = [$row->health_facility_id,$row->district,$row->facility,$facility->level,$facility->ownership,$visit_date->format('d F Y'),$row->visit_number,
                $row->indicator1_score!=-1?sprintf("%.2f",$row->indicator1_score):'NA',
                $row->indicator2_score!=-1?number_format($row->indicator2_score,2):'NA',
                $row->indicator3_score!=-1?number_format($row->indicator3_score,2):'NA',
                $row->indicator4_score!=-1?number_format($row->indicator4_score,2):'NA',
                $row->indicator5_score!=-1?number_format($row->indicator5_score,2):'NA',
                $row->indicator6_score!=-1?number_format($row->indicator6_score,2):'NA',
                $row->indicator7_score!=-1?number_format($row->indicator7_score,2):'NA',
                $row->indicator8_score!=-1?number_format($row->indicator8_score,2):'NA',
                $row->indicator9_score!=-1?number_format($row->indicator9_score,2):'NA',
                $row->indicator10_score!=-1?number_format($row->indicator10_score,2):'NA',
                $row->indicator11_score!=-1?number_format($row->indicator11_score,2):'NA',
                $row->indicator12_score!=-1?number_format($row->indicator12_score,2):'NA',
                $row->indicator13_score!=-1?number_format($row->indicator13_score,2):'NA',
                $row->indicator14_score!=-1?number_format($row->indicator14_score,2):'NA',
                $row->indicator15_score!=-1?number_format($row->indicator15_score,2):'NA',
                $row->indicator16_score!=-1?number_format($row->indicator16_score,2):'NA',
                $row->indicator17_score!=-1?number_format($row->indicator17_score,2):'NA',
                $row->indicator18_score!=-1?number_format($row->indicator18_score,2):'NA',
                $row->indicator19_score!=-1?number_format($row->indicator19_score,2):'NA',
                $row->indicator20_score!=-1?number_format($row->indicator20_score,2):'NA',
                $row->indicator21_score!=-1?number_format($row->indicator21_score,2):'NA',
                $row->indicator22_score!=-1?number_format($row->indicator22_score,2):'NA',
                $row->indicator23_score!=-1?number_format($row->indicator23_score,2):'NA',
                $row->indicator24_score!=-1?number_format($row->indicator24_score,2):'NA',
                $row->indicator25_score!=-1?number_format($row->indicator25_score,2):'NA',
                $row->indicator26_score!=-1?number_format($row->indicator26_score,2):'NA',
                $row->indicator27_score!=-1?number_format($row->indicator27_score,2):'NA'];

            }

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Scores summary');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Lab SPARS score summary');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:AF1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Lab SPARS score summary", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function individualSurveySummaryReport(Request $request)
    {

        $summaries = SurveySummary::orderBy('created_at', 'desc')
                            ->where('created_by','=',Auth::user()->id)
                            ->get()->all();

            $i=0;
            $formatted_list = array( );
        foreach ($summaries as $record) {

            $attributes = [];
            $facility = HealthFacility::where('id','=',$record->health_facility_id)->get()->all();


        /*populate supervisors*/
            $supervisors = Supervisor::where('form_id','=',$record->form_id)->with('Person')->get()->all();

            $supervisor_list = "";

            foreach($supervisors as $supervisor)
            {

                $supervisor_list = $supervisor_list.$supervisor->person->first_name. ' '.$supervisor->person->last_name.' ('.$supervisor->person->telephone.')'  ."\n";

            }
        /*end supervisor populations*/


        /*populate supervisees*/
            $supervisees = SupervisedPerson::where('form_id','=',$record->form_id)->get()->all();

            $supervisee_list = "";

            foreach($supervisees as $supervisee)
            {

                $supervisee_list=$supervisee_list.$supervisee->name. ' ('.$supervisee->phone_number.')' ."\n";

            }
        /*end supervisees populations*/


        /*find user*/
            $user = User::find($record->created_by);
        /*end find user*/


            $attributes=$summaries[$i]['attributes'];

            $x = array_merge( array($attributes), array($facility[0]['attributes']), array($supervisor_list), array($supervisee_list), array($user->name) );

            array_push($formatted_list,$x);

            $i++;

        }


        return view('reports.survey.soloSummary')->with('items',$formatted_list);      
        //dd($formatted_list[0]);
        //return $formatted_list;

    }


   public function editVisit(Request $request)
    {

        //List survey summaries
        $record = SurveySummary::find($request->id);
        $facility = HealthFacility::find($record->health_facility_id);

        //Load the view and pass the parameters
        return view('reports.survey.editVisit')->with('facility',$facility)->with('record',$record);
    }

   public function updateSummary(Request $request)
    {

        //Find survey summary
        $record = SurveySummary::find($request->visit_id);

        $record->visit_number = $request->visit_number;
        $record->visit_date = DateTime::createFromFormat('d F Y', $request->visit_date);
        $record->next_visit_date = DateTime::createFromFormat('d F Y', $request->next_visit_date);

        $record->save();

        // redirect
        Session::flash('message', 'Successfully edited the record!');
        Session::flash('alert-type', 'success');

        //List survey summaries
        $summaries = SurveySummary::orderBy('created_at', 'desc')->get();

        //Load the view and pass the personnel list
        return view('reports.survey.summary')->with('summaries',$summaries);

    }

   public function deleteVisit(Request $request)
    {

        //Find survey summary
        $record = SurveySummary::find($request->id);

        $supervised_delete = SupervisedPerson::where('form_id',$record->form_id)->delete();
        $supervisor_delete = Supervisor::where('form_id',$record->form_id)->delete();
        $general_delete = General::where('form_id',$record->form_id)->delete();
        $stock_management_delete = StockManagement::where('form_id',$record->form_id)->delete();
        $storage10_delete = StorageManagement10::where('form_id',$record->form_id)->delete();
        $storage11_delete = StorageManagement11::where('form_id',$record->form_id)->delete();
        $storage12_delete = StorageManagement12::where('form_id',$record->form_id)->delete();
        $storage13_delete = StorageManagement13::where('form_id',$record->form_id)->delete();
        $storage14_delete = StorageManagement14::where('form_id',$record->form_id)->delete();


        $ordering15_delete = Ordering15::where('form_id',$record->form_id)->delete();
        $ordering16_delete = Ordering16::where('form_id',$record->form_id)->delete();
        $ordering17_delete = Ordering17::where('form_id',$record->form_id)->delete();


        $equipment18_delete = Equipment18::where('form_id',$record->form_id)->delete();
        $equipment19_delete = Equipment19::where('form_id',$record->form_id)->delete();
        $equipment20_delete = Equipment20::where('form_id',$record->form_id)->delete();
        $equipment22_delete = Equipment21::where('form_id',$record->form_id)->delete();


        $info_system22_delete = InformationSystem22::where('form_id',$record->form_id)->delete();
        $info_system23_delete = InformationSystem23::where('form_id',$record->form_id)->delete();
        $info_system24_delete = InformationSystem24::where('form_id',$record->form_id)->delete();
        $info_system25_delete = InformationSystem25::where('form_id',$record->form_id)->delete();
        $info_system26_delete = InformationSystem26::where('form_id',$record->form_id)->delete();
        $info_system27_delete = InformationSystem27::where('form_id',$record->form_id)->delete();

        $score_summary_delete = IndicatorScoreSummary::where('form_id',$record->form_id)->delete();
        $summary_delete = SurveySummary::where('form_id',$record->form_id)->delete();


        // redirect
        Session::flash('message', 'Successfully deleted the record!');
        Session::flash('alert-type', 'success');

        //List survey summaries
        $summaries = SurveySummary::orderBy('created_at', 'desc')->get();

        //Load the view and pass the personnel list
        return view('reports.survey.summary')->with('summaries',$summaries);

    }


    public function extractIndicatorReport(Request $data)
    {
            $indicator_list = Indicator::orderBy('id','asc')->get()->lists('indicator','id');
            $indicator_list->prepend("","");

            return view('reports.extract.indicator')->with('indicator_list',$indicator_list);

    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function auditDTable(Request $request)
    {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        return DataTables::of( Audit::orderBy('created_at', 'desc')
                        ->whereBetween('created_at', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
                        ->get() )
        ->addIndexColumn()
        ->addColumn('user', function($row) {

            $user = User::find($row->user_id);
            return $user->name;

        })
        ->addColumn('created_at_formatted', function($row) {

            $created_at = DateTime::createFromFormat( 'Y-m-d H:i:s', $row->created_at )->format('d M Y') ;
            return $created_at;

        })
        ->make(true);

        /*return DataTables::of(Audit::orderBy('created_at','desc')->get())
        ->addColumn('user', function($row) {

            $user = User::find($row->user_id);
            return $user->name;

        })
        ->addIndexColumn()
        ->make(true);*/

    }


    public function extractAuditTrailReport(Request $data)
    {
            $audits = Audit::with('User')->orderBy('created_at','desc')->get();

           //dd($audits->user->user);

            return view('reports.extract.audit')->with('audits',$audits);

    }


    public function extractIndicatorToExcelReport(Request $data)
    {
            $run="extractIndicator".$data->indicator_id."ToExcel";

            return $this->$run($data);

    }

    public function extractIndicator1ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 1-9 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('stock_management', 'survey_summary.id', '=', 'stock_management.survey_summary_id')
            ->select('survey_summary.*',
                'stock_management.r1c1',
                'stock_management.r1c2',
                'stock_management.r1c3',
                'stock_management.r1c4',
                'stock_management.r1c5',
                'stock_management.r1c6',
                'stock_management.r1c7',
                'stock_management.r1c8',
                'stock_management.r1c9',
                'stock_management.r1c10',
                'stock_management.r1c11',
                'stock_management.r1c12',
                'stock_management.r1c13',
                'stock_management.r1c14',
                'stock_management.r1c15',
                'stock_management.r1c16',
                'stock_management.r1c17',
                'stock_management.r1c18',
                'stock_management.r1c19',
                'stock_management.r1c20',
                'stock_management.r1c21',
                'stock_management.r1c22',

                'stock_management.r2c1',
                'stock_management.r2c2',
                'stock_management.r2c3',
                'stock_management.r2c4',
                'stock_management.r2c5',
                'stock_management.r2c6',
                'stock_management.r2c7',
                'stock_management.r2c8',
                'stock_management.r2c9',
                'stock_management.r2c10',
                'stock_management.r2c11',
                'stock_management.r2c12',
                'stock_management.r2c13',
                'stock_management.r2c14',
                'stock_management.r2c15',
                'stock_management.r2c16',
                'stock_management.r2c17',
                'stock_management.r2c18',
                'stock_management.r2c19',
                'stock_management.r2c20',
                'stock_management.r2c21',
                'stock_management.r2c22',

                'stock_management.r3c1',
                'stock_management.r3c2',
                'stock_management.r3c3',
                'stock_management.r3c4',
                'stock_management.r3c5',
                'stock_management.r3c6',
                'stock_management.r3c7',
                'stock_management.r3c8',
                'stock_management.r3c9',
                'stock_management.r3c10',
                'stock_management.r3c11',
                'stock_management.r3c12',
                'stock_management.r3c13',
                'stock_management.r3c14',
                'stock_management.r3c15',
                'stock_management.r3c16',
                'stock_management.r3c17',
                'stock_management.r3c18',
                'stock_management.r3c19',
                'stock_management.r3c20',
                'stock_management.r3c21',
                'stock_management.r3c22',

                'stock_management.r4c1',
                'stock_management.r4c2',
                'stock_management.r4c3',
                'stock_management.r4c4',
                'stock_management.r4c5',
                'stock_management.r4c6',
                'stock_management.r4c7',
                'stock_management.r4c8',
                'stock_management.r4c9',
                'stock_management.r4c10',
                'stock_management.r4c11',
                'stock_management.r4c12',
                'stock_management.r4c13',
                'stock_management.r4c14',
                'stock_management.r4c15',
                'stock_management.r4c16',
                'stock_management.r4c17',
                'stock_management.r4c18',
                'stock_management.r4c19',
                'stock_management.r4c20',
                'stock_management.r4c21',
                'stock_management.r4c22',

                'stock_management.r5c1',
                'stock_management.r5c2',
                'stock_management.r5c3',
                'stock_management.r5c4',
                'stock_management.r5c5',
                'stock_management.r5c6',
                'stock_management.r5c7',
                'stock_management.r5c8',
                'stock_management.r5c9',
                'stock_management.r5c10',
                'stock_management.r5c11',
                'stock_management.r5c12',
                'stock_management.r5c13',
                'stock_management.r5c14',
                'stock_management.r5c15',
                'stock_management.r5c16',
                'stock_management.r5c17',
                'stock_management.r5c18',
                'stock_management.r5c19',
                'stock_management.r5c20',
                'stock_management.r5c21',
                'stock_management.r5c22',

                'stock_management.r6c1',
                'stock_management.r6c2',
                'stock_management.r6c3',
                'stock_management.r6c4',
                'stock_management.r6c5',
                'stock_management.r6c6',
                'stock_management.r6c7',
                'stock_management.r6c8',
                'stock_management.r6c9',
                'stock_management.r6c10',
                'stock_management.r6c11',
                'stock_management.r6c12',
                'stock_management.r6c13',
                'stock_management.r6c14',
                'stock_management.r6c15',
                'stock_management.r6c16',
                'stock_management.r6c17',
                'stock_management.r6c18',
                'stock_management.r6c19',
                'stock_management.r6c20',
                'stock_management.r6c21',
                'stock_management.r6c22',

                'stock_management.r7c1',
                'stock_management.r7c2',
                'stock_management.r7c3',
                'stock_management.r7c4',
                'stock_management.r7c5',
                'stock_management.r7c6',
                'stock_management.r7c7',
                'stock_management.r7c8',
                'stock_management.r7c9',
                'stock_management.r7c10',
                'stock_management.r7c11',
                'stock_management.r7c12',
                'stock_management.r7c13',
                'stock_management.r7c14',
                'stock_management.r7c15',
                'stock_management.r7c16',
                'stock_management.r7c17',
                'stock_management.r7c18',
                'stock_management.r7c19',
                'stock_management.r7c20',
                'stock_management.r7c21',
                'stock_management.r7c22',

                'stock_management.r8c1',
                'stock_management.r8c2',
                'stock_management.r8c3',
                'stock_management.r8c4',
                'stock_management.r8c5',
                'stock_management.r8c6',
                'stock_management.r8c7',
                'stock_management.r8c8',
                'stock_management.r8c9',
                'stock_management.r8c10',
                'stock_management.r8c11',
                'stock_management.r8c12',
                'stock_management.r8c13',
                'stock_management.r8c14',
                'stock_management.r8c15',
                'stock_management.r8c16',
                'stock_management.r8c17',
                'stock_management.r8c18',
                'stock_management.r8c19',
                'stock_management.r8c20',
                'stock_management.r8c21',
                'stock_management.r8c22',

                'stock_management.r9c1',
                'stock_management.r9c2',
                'stock_management.r9c3',
                'stock_management.r9c4',
                'stock_management.r9c5',
                'stock_management.r9c6',
                'stock_management.r9c7',
                'stock_management.r9c8',
                'stock_management.r9c9',
                'stock_management.r9c10',
                'stock_management.r9c11',
                'stock_management.r9c12',
                'stock_management.r9c13',
                'stock_management.r9c14',
                'stock_management.r9c15',
                'stock_management.r9c16',
                'stock_management.r9c17',
                'stock_management.r9c18',
                'stock_management.r9c19',
                'stock_management.r9c20',
                'stock_management.r9c21',
                'stock_management.r9c22',

                'stock_management.r10c1',
                'stock_management.r10c2',
                'stock_management.r10c3',
                'stock_management.r10c4',
                'stock_management.r10c5',
                'stock_management.r10c6',
                'stock_management.r10c7',
                'stock_management.r10c8',
                'stock_management.r10c9',
                'stock_management.r10c10',
                'stock_management.r10c11',
                'stock_management.r10c12',
                'stock_management.r10c13',
                'stock_management.r10c14',
                'stock_management.r10c15',
                'stock_management.r10c16',
                'stock_management.r10c17',
                'stock_management.r10c18',
                'stock_management.r10c19',
                'stock_management.r10c20',
                'stock_management.r10c21',
                'stock_management.r10c22',

                'stock_management.r11c1',
                'stock_management.r11c2',
                'stock_management.r11c3',
                'stock_management.r11c4',
                'stock_management.r11c5',
                'stock_management.r11c6',
                'stock_management.r11c7',
                'stock_management.r11c8',
                'stock_management.r11c9',
                'stock_management.r11c10',
                'stock_management.r11c11',
                'stock_management.r11c12',
                'stock_management.r11c13',
                'stock_management.r11c14',
                'stock_management.r11c15',
                'stock_management.r11c16',
                'stock_management.r11c17',
                'stock_management.r11c18',
                'stock_management.r11c19',
                'stock_management.r11c20',
                'stock_management.r11c21',
                'stock_management.r11c22',

                'stock_management.stock_management_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District',
        'Facility','Level','Ownership','Visit date','Visit number','Form ID',
        'r1c1','r1c2','r1c3','r1c4','r1c5','r1c6','r1c7','r1c8','r1c9','r1c10','r1c11','r1c12','r1c13','r1c14','r1c15','r1c16','r1c17','r1c18','r1c19','r1c20','r1c21','r1c22',
        'r2c1','r2c2','r2c3','r2c4','r2c5','r2c6','r2c7','r2c8','r2c9','r2c10','r2c11','r2c12','r2c13','r2c14','r2c15','r2c16','r2c17','r2c18','r2c19','r2c20','r2c21','r2c22',
        'r3c1','r3c2','r3c3','r3c4','r3c5','r3c6','r3c7','r3c8','r3c9','r3c10','r3c11','r3c12','r3c13','r3c14','r3c15','r3c16','r3c17','r3c18','r3c19','r3c20','r3c21','r3c22',
        'r4c1','r4c2','r4c3','r4c4','r4c5','r4c6','r4c7','r4c8','r4c9','r4c10','r4c11','r4c12','r4c13','r4c14','r4c15','r4c16','r4c17','r4c18','r4c19','r4c20','r4c21','r4c22',
        'r5c1','r5c2','r5c3','r5c4','r5c5','r5c6','r5c7','r5c8','r5c9','r5c10','r5c11','r5c12','r5c13','r5c14','r5c15','r5c16','r5c17','r5c18','r5c19','r5c20','r5c21','r5c22',
        'r6c1','r6c2','r6c3','r6c4','r6c5','r6c6','r6c7','r6c8','r6c9','r6c10','r6c11','r6c12','r6c13','r6c14','r6c15','r6c16','r6c17','r6c18','r6c19','r6c20','r6c21','r6c22',
        'r7c1','r7c2','r7c3','r7c4','r7c5','r7c6','r7c7','r7c8','r7c9','r7c10','r7c11','r7c12','r7c13','r7c14','r7c15','r7c16','r7c17','r7c18','r7c19','r7c20','r7c21','r7c22',
        'r8c1','r8c2','r8c3','r8c4','r8c5','r8c6','r8c7','r8c8','r8c9','r8c10','r8c11','r8c12','r8c13','r8c14','r8c15','r8c16','r8c17','r8c18','r8c19','r8c20','r8c21','r8c22',
        'r9c1','r9c2','r9c3','r9c4','r9c5','r9c6','r9c7','r9c8','r9c9','r9c10','r9c11','r9c12','r9c13','r9c14','r9c15','r9c16','r9c17','r9c18','r9c19','r9c20','r9c21','r9c22',
        'r10c1','r10c2','r10c3','r10c4','r10c5','r10c6','r10c7','r10c8','r10c9','r10c10','r10c11','r10c12','r10c13','r10c14','r10c15','r10c16','r10c17','r10c18','r10c19','r10c20','r10c21','r10c22',
        'r11c1','r11c2','r11c3','r11c4','r11c5','r11c6','r11c7','r11c8','r11c9','r11c10','r11c11','r11c12','r11c13','r11c14','r11c15','r11c16','r11c17','r11c18','r11c19','r11c20','r11c21','r11c22','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,

                    $row->r1c1==-1?"NA":sprintf("%d",$row->r1c1),
                    $row->r1c2==-1?"NA":($row->r1c2==-3?"E":sprintf("%d",$row->r1c2)),
                    $row->r1c3==-1?"NA":sprintf("%d",$row->r1c3),
                    $row->r1c4==-1?"NA":sprintf("%d",$row->r1c4),
                    $row->r1c5==-1?"NA":sprintf("%d",$row->r1c5),
                    $row->r1c6==-1?"NA":sprintf("%d",$row->r1c6),
                    $row->r1c7==-1?"NA":sprintf("%d",$row->r1c7),
                    $row->r1c8==-1?"NA":sprintf("%d",$row->r1c8),
                    $row->r1c9==-1?"NA":sprintf("%d",$row->r1c9),
                    $row->r1c10==-1?"NA":sprintf("%d",$row->r1c10),
                    $row->r1c11==-1?"NA":($row->r1c11==-2?"NR":sprintf("%d",$row->r1c11)),
                    $row->r1c12==-1?"NA":($row->r1c12==-2?"NR":sprintf("%d",$row->r1c12)),
                    $row->r1c13==-1?"NA":($row->r1c13==-2?"NR":sprintf("%d",$row->r1c13)),
                    $row->r1c14==-1?"NA":sprintf("%d",$row->r1c14),
                    $row->r1c15==-1?"NA":sprintf("%d",$row->r1c15),
                    $row->r1c16==-1?"NA":($row->r1c16==-2?"NR":sprintf("%d",$row->r1c16)),
                    $row->r1c17==-1?"NA":($row->r1c17==-2?"NR":sprintf("%d",$row->r1c17)),
                    $row->r1c18==-1?"NA":sprintf("%d",$row->r1c18),
                    $row->r1c19==-1?"NA":sprintf("%d",$row->r1c19),
                    $row->r1c20==-1?"NA":sprintf("%d",$row->r1c20),
                    $row->r1c21==-1?"NA":($row->r1c21==-2?"NR":sprintf("%d",$row->r1c21)),
                    $row->r1c22==-1?"NA":($row->r1c22==-4?'PS':($row->r1c22==-2?'NR':sprintf("%d",$row->r1c22))),

                    $row->r2c1==-1?"NA":sprintf("%d",$row->r2c1),
                    $row->r2c2==-1?"NA":($row->r2c2==-3?"E":sprintf("%d",$row->r2c2)),
                    $row->r2c3==-1?"NA":sprintf("%d",$row->r2c3),
                    $row->r2c4==-1?"NA":sprintf("%d",$row->r2c4),
                    $row->r2c5==-1?"NA":sprintf("%d",$row->r2c5),
                    $row->r2c6==-1?"NA":sprintf("%d",$row->r2c6),
                    $row->r2c7==-1?"NA":sprintf("%d",$row->r2c7),
                    $row->r2c8==-1?"NA":sprintf("%d",$row->r2c8),
                    $row->r2c9==-1?"NA":sprintf("%d",$row->r2c9),
                    $row->r2c10==-1?"NA":sprintf("%d",$row->r2c10),
                    $row->r2c11==-1?"NA":($row->r2c11==-2?"NR":sprintf("%d",$row->r2c11)),
                    $row->r2c12==-1?"NA":($row->r2c12==-2?"NR":sprintf("%d",$row->r2c12)),
                    $row->r2c13==-1?"NA":($row->r2c13==-2?"NR":sprintf("%d",$row->r2c13)),
                    $row->r2c14==-1?"NA":sprintf("%d",$row->r2c14),
                    $row->r2c15==-1?"NA":sprintf("%d",$row->r2c15),
                    $row->r2c16==-1?"NA":($row->r2c16==-2?"NR":sprintf("%d",$row->r2c16)),
                    $row->r2c17==-1?"NA":($row->r2c17==-2?"NR":sprintf("%d",$row->r2c17)),
                    $row->r2c18==-1?"NA":sprintf("%d",$row->r2c18),
                    $row->r2c19==-1?"NA":sprintf("%d",$row->r2c19),
                    $row->r2c20==-1?"NA":sprintf("%d",$row->r2c20),
                    $row->r2c21==-1?"NA":($row->r2c21==-2?"NR":sprintf("%d",$row->r2c21)),
                    $row->r2c22==-1?"NA":($row->r2c22==-4?'PS':($row->r2c22==-2?'NR':sprintf("%d",$row->r2c22))),

                    $row->r3c1==-1?"NA":sprintf("%d",$row->r3c1),
                    $row->r3c2==-1?"NA":($row->r3c2==-3?"E":sprintf("%d",$row->r3c2)),
                    $row->r3c3==-1?"NA":sprintf("%d",$row->r3c3),
                    $row->r3c4==-1?"NA":sprintf("%d",$row->r3c4),
                    $row->r3c5==-1?"NA":sprintf("%d",$row->r3c5),
                    $row->r3c6==-1?"NA":sprintf("%d",$row->r3c6),
                    $row->r3c7==-1?"NA":sprintf("%d",$row->r3c7),
                    $row->r3c8==-1?"NA":sprintf("%d",$row->r3c8),
                    $row->r3c9==-1?"NA":sprintf("%d",$row->r3c9),
                    $row->r3c10==-1?"NA":sprintf("%d",$row->r3c10),
                    $row->r3c11==-1?"NA":($row->r3c11==-2?"NR":sprintf("%d",$row->r3c11)),
                    $row->r3c12==-1?"NA":($row->r3c12==-2?"NR":sprintf("%d",$row->r3c12)),
                    $row->r3c13==-1?"NA":($row->r3c13==-2?"NR":sprintf("%d",$row->r3c13)),
                    $row->r3c14==-1?"NA":sprintf("%d",$row->r3c14),
                    $row->r3c15==-1?"NA":sprintf("%d",$row->r3c15),
                    $row->r3c16==-1?"NA":($row->r3c16==-2?"NR":sprintf("%d",$row->r3c16)),
                    $row->r3c17==-1?"NA":($row->r3c17==-2?"NR":sprintf("%d",$row->r3c17)),
                    $row->r3c18==-1?"NA":sprintf("%d",$row->r3c18),
                    $row->r3c19==-1?"NA":sprintf("%d",$row->r3c19),
                    $row->r3c20==-1?"NA":sprintf("%d",$row->r3c20),
                    $row->r3c21==-1?"NA":($row->r3c21==-2?"NR":sprintf("%d",$row->r3c21)),
                    $row->r3c22==-1?"NA":($row->r3c22==-4?'PS':($row->r3c22==-2?'NR':sprintf("%d",$row->r3c22))),

                    $row->r11c1==-1?"NA":sprintf("%d",$row->r11c1),
                    $row->r11c2==-1?"NA":($row->r11c2==-3?"E":sprintf("%d",$row->r11c2)),
                    $row->r11c3==-1?"NA":sprintf("%d",$row->r11c3),
                    $row->r11c4==-1?"NA":sprintf("%d",$row->r11c4),
                    $row->r11c5==-1?"NA":sprintf("%d",$row->r11c5),
                    $row->r11c6==-1?"NA":sprintf("%d",$row->r11c6),
                    $row->r11c7==-1?"NA":sprintf("%d",$row->r11c7),
                    $row->r11c8==-1?"NA":sprintf("%d",$row->r11c8),
                    $row->r11c9==-1?"NA":sprintf("%d",$row->r11c9),
                    $row->r11c10==-1?"NA":sprintf("%d",$row->r11c10),
                    $row->r11c11==-1?"NA":($row->r11c11==-2?"NR":sprintf("%d",$row->r11c11)),
                    $row->r11c12==-1?"NA":($row->r11c12==-2?"NR":sprintf("%d",$row->r11c12)),
                    $row->r11c13==-1?"NA":($row->r11c13==-2?"NR":sprintf("%d",$row->r11c13)),
                    $row->r11c14==-1?"NA":sprintf("%d",$row->r11c14),
                    $row->r11c15==-1?"NA":sprintf("%d",$row->r11c15),
                    $row->r11c16==-1?"NA":($row->r11c16==-2?"NR":sprintf("%d",$row->r11c16)),
                    $row->r11c17==-1?"NA":($row->r11c17==-2?"NR":sprintf("%d",$row->r11c17)),
                    $row->r11c18==-1?"NA":sprintf("%d",$row->r11c18),
                    $row->r11c19==-1?"NA":sprintf("%d",$row->r11c19),
                    $row->r11c20==-1?"NA":sprintf("%d",$row->r11c20),
                    $row->r11c21==-1?"NA":($row->r11c21==-2?"NR":sprintf("%d",$row->r11c21)),
                    $row->r11c22==-1?"NA":($row->r11c22==-4?'PS':($row->r11c22==-2?'NR':sprintf("%d",$row->r11c22))),

                    $row->r4c1==-1?"NA":sprintf("%d",$row->r4c1),
                    $row->r4c2==-1?"NA":($row->r4c2==-3?"E":sprintf("%d",$row->r4c2)),
                    $row->r4c3==-1?"NA":sprintf("%d",$row->r4c3),
                    $row->r4c4==-1?"NA":sprintf("%d",$row->r4c4),
                    $row->r4c5==-1?"NA":sprintf("%d",$row->r4c5),
                    $row->r4c6==-1?"NA":sprintf("%d",$row->r4c6),
                    $row->r4c7==-1?"NA":sprintf("%d",$row->r4c7),
                    $row->r4c8==-1?"NA":sprintf("%d",$row->r4c8),
                    $row->r4c9==-1?"NA":sprintf("%d",$row->r4c9),
                    $row->r4c10==-1?"NA":sprintf("%d",$row->r4c10),
                    $row->r4c11==-1?"NA":($row->r4c11==-2?"NR":sprintf("%d",$row->r4c11)),
                    $row->r4c12==-1?"NA":($row->r4c12==-2?"NR":sprintf("%d",$row->r4c12)),
                    $row->r4c13==-1?"NA":($row->r4c13==-2?"NR":sprintf("%d",$row->r4c13)),
                    $row->r4c14==-1?"NA":sprintf("%d",$row->r4c14),
                    $row->r4c15==-1?"NA":sprintf("%d",$row->r4c15),
                    $row->r4c16==-1?"NA":($row->r4c16==-2?"NR":sprintf("%d",$row->r4c16)),
                    $row->r4c17==-1?"NA":($row->r4c17==-2?"NR":sprintf("%d",$row->r4c17)),
                    $row->r4c18==-1?"NA":sprintf("%d",$row->r4c18),
                    $row->r4c19==-1?"NA":sprintf("%d",$row->r4c19),
                    $row->r4c20==-1?"NA":sprintf("%d",$row->r4c20),
                    $row->r4c21==-1?"NA":($row->r4c21==-2?"NR":sprintf("%d",$row->r4c21)),
                    $row->r4c22==-1?"NA":($row->r4c22==-4?'PS':($row->r4c22==-2?'NR':sprintf("%d",$row->r4c22))),

                    $row->r10c1==-1?"NA":sprintf("%d",$row->r10c1),
                    $row->r10c2==-1?"NA":($row->r10c2==-3?"E":sprintf("%d",$row->r10c2)),
                    $row->r10c3==-1?"NA":sprintf("%d",$row->r10c3),
                    $row->r10c4==-1?"NA":sprintf("%d",$row->r10c4),
                    $row->r10c5==-1?"NA":sprintf("%d",$row->r10c5),
                    $row->r10c6==-1?"NA":sprintf("%d",$row->r10c6),
                    $row->r10c7==-1?"NA":sprintf("%d",$row->r10c7),
                    $row->r10c8==-1?"NA":sprintf("%d",$row->r10c8),
                    $row->r10c9==-1?"NA":sprintf("%d",$row->r10c9),
                    $row->r10c10==-1?"NA":sprintf("%d",$row->r10c10),
                    $row->r10c11==-1?"NA":($row->r10c11==-2?"NR":sprintf("%d",$row->r10c11)),
                    $row->r10c12==-1?"NA":($row->r10c12==-2?"NR":sprintf("%d",$row->r10c12)),
                    $row->r10c13==-1?"NA":($row->r10c13==-2?"NR":sprintf("%d",$row->r10c13)),
                    $row->r10c14==-1?"NA":sprintf("%d",$row->r10c14),
                    $row->r10c15==-1?"NA":sprintf("%d",$row->r10c15),
                    $row->r10c16==-1?"NA":($row->r10c16==-2?"NR":sprintf("%d",$row->r10c16)),
                    $row->r10c17==-1?"NA":($row->r10c17==-2?"NR":sprintf("%d",$row->r10c17)),
                    $row->r10c18==-1?"NA":sprintf("%d",$row->r10c18),
                    $row->r10c19==-1?"NA":sprintf("%d",$row->r10c19),
                    $row->r10c20==-1?"NA":sprintf("%d",$row->r10c20),
                    $row->r10c21==-1?"NA":($row->r10c21==-2?"NR":sprintf("%d",$row->r10c21)),
                    $row->r10c22==-1?"NA":($row->r10c22==-4?'PS':($row->r10c22==-2?'NR':sprintf("%d",$row->r10c22))),

                    $row->r5c1==-1?"NA":sprintf("%d",$row->r5c1),
                    $row->r5c2==-1?"NA":($row->r5c2==-3?"E":sprintf("%d",$row->r5c2)),
                    $row->r5c3==-1?"NA":sprintf("%d",$row->r5c3),
                    $row->r5c4==-1?"NA":sprintf("%d",$row->r5c4),
                    $row->r5c5==-1?"NA":sprintf("%d",$row->r5c5),
                    $row->r5c6==-1?"NA":sprintf("%d",$row->r5c6),
                    $row->r5c7==-1?"NA":sprintf("%d",$row->r5c7),
                    $row->r5c8==-1?"NA":sprintf("%d",$row->r5c8),
                    $row->r5c9==-1?"NA":sprintf("%d",$row->r5c9),
                    $row->r5c10==-1?"NA":sprintf("%d",$row->r5c10),
                    $row->r5c11==-1?"NA":($row->r5c11==-2?"NR":sprintf("%d",$row->r5c11)),
                    $row->r5c12==-1?"NA":($row->r5c12==-2?"NR":sprintf("%d",$row->r5c12)),
                    $row->r5c13==-1?"NA":($row->r5c13==-2?"NR":sprintf("%d",$row->r5c13)),
                    $row->r5c14==-1?"NA":sprintf("%d",$row->r5c14),
                    $row->r5c15==-1?"NA":sprintf("%d",$row->r5c15),
                    $row->r5c16==-1?"NA":($row->r5c16==-2?"NR":sprintf("%d",$row->r5c16)),
                    $row->r5c17==-1?"NA":($row->r5c17==-2?"NR":sprintf("%d",$row->r5c17)),
                    $row->r5c18==-1?"NA":sprintf("%d",$row->r5c18),
                    $row->r5c19==-1?"NA":sprintf("%d",$row->r5c19),
                    $row->r5c20==-1?"NA":sprintf("%d",$row->r5c20),
                    $row->r5c21==-1?"NA":($row->r5c21==-2?"NR":sprintf("%d",$row->r5c21)),
                    $row->r5c22==-1?"NA":($row->r5c22==-4?'PS':($row->r5c22==-2?'NR':sprintf("%d",$row->r5c22))),

                    $row->r6c1==-1?"NA":sprintf("%d",$row->r6c1),
                    $row->r6c2==-1?"NA":($row->r6c2==-3?"E":sprintf("%d",$row->r6c2)),
                    $row->r6c3==-1?"NA":sprintf("%d",$row->r6c3),
                    $row->r6c4==-1?"NA":sprintf("%d",$row->r6c4),
                    $row->r6c5==-1?"NA":sprintf("%d",$row->r6c5),
                    $row->r6c6==-1?"NA":sprintf("%d",$row->r6c6),
                    $row->r6c7==-1?"NA":sprintf("%d",$row->r6c7),
                    $row->r6c8==-1?"NA":sprintf("%d",$row->r6c8),
                    $row->r6c9==-1?"NA":sprintf("%d",$row->r6c9),
                    $row->r6c10==-1?"NA":sprintf("%d",$row->r6c10),
                    $row->r6c11==-1?"NA":($row->r6c11==-2?"NR":sprintf("%d",$row->r6c11)),
                    $row->r6c12==-1?"NA":($row->r6c12==-2?"NR":sprintf("%d",$row->r6c12)),
                    $row->r6c13==-1?"NA":($row->r6c13==-2?"NR":sprintf("%d",$row->r6c13)),
                    $row->r6c14==-1?"NA":sprintf("%d",$row->r6c14),
                    $row->r6c15==-1?"NA":sprintf("%d",$row->r6c15),
                    $row->r6c16==-1?"NA":($row->r6c16==-2?"NR":sprintf("%d",$row->r6c16)),
                    $row->r6c17==-1?"NA":($row->r6c17==-2?"NR":sprintf("%d",$row->r6c17)),
                    $row->r6c18==-1?"NA":sprintf("%d",$row->r6c18),
                    $row->r6c19==-1?"NA":sprintf("%d",$row->r6c19),
                    $row->r6c20==-1?"NA":sprintf("%d",$row->r6c20),
                    $row->r6c21==-1?"NA":($row->r6c21==-2?"NR":sprintf("%d",$row->r6c21)),
                    $row->r6c22==-1?"NA":($row->r6c22==-4?'PS':($row->r6c22==-2?'NR':sprintf("%d",$row->r6c22))),

                    $row->r7c1==-1?"NA":sprintf("%d",$row->r7c1),
                    $row->r7c2==-1?"NA":($row->r7c2==-3?"E":sprintf("%d",$row->r7c2)),
                    $row->r7c3==-1?"NA":sprintf("%d",$row->r7c3),
                    $row->r7c4==-1?"NA":sprintf("%d",$row->r7c4),
                    $row->r7c5==-1?"NA":sprintf("%d",$row->r7c5),
                    $row->r7c6==-1?"NA":sprintf("%d",$row->r7c6),
                    $row->r7c7==-1?"NA":sprintf("%d",$row->r7c7),
                    $row->r7c8==-1?"NA":sprintf("%d",$row->r7c8),
                    $row->r7c9==-1?"NA":sprintf("%d",$row->r7c9),
                    $row->r7c10==-1?"NA":sprintf("%d",$row->r7c10),
                    $row->r7c11==-1?"NA":($row->r7c11==-2?"NR":sprintf("%d",$row->r7c11)),
                    $row->r7c12==-1?"NA":($row->r7c12==-2?"NR":sprintf("%d",$row->r7c12)),
                    $row->r7c13==-1?"NA":($row->r7c13==-2?"NR":sprintf("%d",$row->r7c13)),
                    $row->r7c14==-1?"NA":sprintf("%d",$row->r7c14),
                    $row->r7c15==-1?"NA":sprintf("%d",$row->r7c15),
                    $row->r7c16==-1?"NA":($row->r7c16==-2?"NR":sprintf("%d",$row->r7c16)),
                    $row->r7c17==-1?"NA":($row->r7c17==-2?"NR":sprintf("%d",$row->r7c17)),
                    $row->r7c18==-1?"NA":sprintf("%d",$row->r7c18),
                    $row->r7c19==-1?"NA":sprintf("%d",$row->r7c19),
                    $row->r7c20==-1?"NA":sprintf("%d",$row->r7c20),
                    $row->r7c21==-1?"NA":($row->r7c21==-2?"NR":sprintf("%d",$row->r7c21)),
                    $row->r7c22==-1?"NA":($row->r7c22==-4?'PS':($row->r7c22==-2?'NR':sprintf("%d",$row->r7c22))),

                    $row->r8c1==-1?"NA":sprintf("%d",$row->r8c1),
                    $row->r8c2==-1?"NA":($row->r8c2==-3?"E":sprintf("%d",$row->r8c2)),
                    $row->r8c3==-1?"NA":sprintf("%d",$row->r8c3),
                    $row->r8c4==-1?"NA":sprintf("%d",$row->r8c4),
                    $row->r8c5==-1?"NA":sprintf("%d",$row->r8c5),
                    $row->r8c6==-1?"NA":sprintf("%d",$row->r8c6),
                    $row->r8c7==-1?"NA":sprintf("%d",$row->r8c7),
                    $row->r8c8==-1?"NA":sprintf("%d",$row->r8c8),
                    $row->r8c9==-1?"NA":sprintf("%d",$row->r8c9),
                    $row->r8c10==-1?"NA":sprintf("%d",$row->r8c10),
                    $row->r8c11==-1?"NA":($row->r8c11==-2?"NR":sprintf("%d",$row->r8c11)),
                    $row->r8c12==-1?"NA":($row->r8c12==-2?"NR":sprintf("%d",$row->r8c12)),
                    $row->r8c13==-1?"NA":($row->r8c13==-2?"NR":sprintf("%d",$row->r8c13)),
                    $row->r8c14==-1?"NA":sprintf("%d",$row->r8c14),
                    $row->r8c15==-1?"NA":sprintf("%d",$row->r8c15),
                    $row->r8c16==-1?"NA":($row->r8c16==-2?"NR":sprintf("%d",$row->r8c16)),
                    $row->r8c17==-1?"NA":($row->r8c17==-2?"NR":sprintf("%d",$row->r8c17)),
                    $row->r8c18==-1?"NA":sprintf("%d",$row->r8c18),
                    $row->r8c19==-1?"NA":sprintf("%d",$row->r8c19),
                    $row->r8c20==-1?"NA":sprintf("%d",$row->r8c20),
                    $row->r8c21==-1?"NA":($row->r8c21==-2?"NR":sprintf("%d",$row->r8c21)),
                    $row->r8c22==-1?"NA":($row->r8c22==-4?'PS':($row->r8c22==-2?'NR':sprintf("%d",$row->r8c22))),

                    $row->r9c1==-1?"NA":sprintf("%d",$row->r9c1),
                    $row->r9c2==-1?"NA":($row->r9c2==-3?"E":sprintf("%d",$row->r9c2)),
                    $row->r9c3==-1?"NA":sprintf("%d",$row->r9c3),
                    $row->r9c4==-1?"NA":sprintf("%d",$row->r9c4),
                    $row->r9c5==-1?"NA":sprintf("%d",$row->r9c5),
                    $row->r9c6==-1?"NA":sprintf("%d",$row->r9c6),
                    $row->r9c7==-1?"NA":sprintf("%d",$row->r9c7),
                    $row->r9c8==-1?"NA":sprintf("%d",$row->r9c8),
                    $row->r9c9==-1?"NA":sprintf("%d",$row->r9c9),
                    $row->r9c10==-1?"NA":sprintf("%d",$row->r9c10),
                    $row->r9c11==-1?"NA":($row->r9c11==-2?"NR":sprintf("%d",$row->r9c11)),
                    $row->r9c12==-1?"NA":($row->r9c12==-2?"NR":sprintf("%d",$row->r9c12)),
                    $row->r9c13==-1?"NA":($row->r9c13==-2?"NR":sprintf("%d",$row->r9c13)),
                    $row->r9c14==-1?"NA":sprintf("%d",$row->r9c14),
                    $row->r9c15==-1?"NA":sprintf("%d",$row->r9c15),
                    $row->r9c16==-1?"NA":($row->r9c16==-2?"NR":sprintf("%d",$row->r9c16)),
                    $row->r9c17==-1?"NA":($row->r9c17==-2?"NR":sprintf("%d",$row->r9c17)),
                    $row->r9c18==-1?"NA":sprintf("%d",$row->r9c18),
                    $row->r9c19==-1?"NA":sprintf("%d",$row->r9c19),
                    $row->r9c20==-1?"NA":sprintf("%d",$row->r9c20),
                    $row->r9c21==-1?"NA":($row->r9c21==-2?"NR":sprintf("%d",$row->r9c21)),
                    $row->r9c22==-1?"NA":($row->r9c22==-4?'PS':($row->r9c22==-2?'NR':sprintf("%d",$row->r9c22))),

                    $row->stock_management_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 1-9 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 1-9 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:IO1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Stock management extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator10ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 10 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_storage_management_10', 'survey_summary.id', '=', 'spars_storage_management_10.survey_summary_id')
            ->select('survey_summary.*', 'spars_storage_management_10.sub_indicator_10a', 'spars_storage_management_10.sub_indicator_10b', 'spars_storage_management_10.sub_indicator_10c', 'spars_storage_management_10.sub_indicator_10d', 'spars_storage_management_10.indicator_10_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','10a','10b','10c','10d','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_10a==-1?"NA":sprintf("%d",$row->sub_indicator_10a),
                    $row->sub_indicator_10b==-1?"NA":sprintf("%d",$row->sub_indicator_10b),
                    $row->sub_indicator_10c==-1?"NA":sprintf("%d",$row->sub_indicator_10c),
                    $row->sub_indicator_10d==-1?"NA":sprintf("%d",$row->sub_indicator_10d),
                    $row->indicator_10_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 10 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 10 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:K1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 10 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }


    public function extractIndicator11ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 11 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_storage_management_11', 'survey_summary.id', '=', 'spars_storage_management_11.survey_summary_id')
            ->select('survey_summary.*',
                'spars_storage_management_11.sub_indicator_11a',
                'spars_storage_management_11.sub_indicator_11b',
                'spars_storage_management_11.sub_indicator_11c',
                'spars_storage_management_11.sub_indicator_11d',
                'spars_storage_management_11.sub_indicator_11e',
                'spars_storage_management_11.indicator_11_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))

            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','11a','11b','11c','11d','11e','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_11a==-1?"NA":sprintf("%d",$row->sub_indicator_11a),
                    $row->sub_indicator_11b==-1?"NA":sprintf("%d",$row->sub_indicator_11b),
                    $row->sub_indicator_11c==-1?"NA":sprintf("%d",$row->sub_indicator_11c),
                    $row->sub_indicator_11d==-1?"NA":sprintf("%d",$row->sub_indicator_11d),
                    $row->sub_indicator_11e==-1?"NA":sprintf("%d",$row->sub_indicator_11e),
                    $row->indicator_11_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 11 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 11 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:L1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 11 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator12ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 12 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_storage_management_12', 'survey_summary.id', '=', 'spars_storage_management_12.survey_summary_id')
            ->select('survey_summary.*',
                'spars_storage_management_12.sub_indicator_12a_main_store',
                'spars_storage_management_12.sub_indicator_12b_main_store',
                'spars_storage_management_12.sub_indicator_12c_main_store',
                'spars_storage_management_12.sub_indicator_12d_main_store',
                'spars_storage_management_12.sub_indicator_12e_main_store',
                'spars_storage_management_12.sub_indicator_12a_lab_store',
                'spars_storage_management_12.sub_indicator_12b_lab_store',
                'spars_storage_management_12.sub_indicator_12c_lab_store',
                'spars_storage_management_12.sub_indicator_12d_lab_store',
                'spars_storage_management_12.sub_indicator_12e_lab_store',
                'spars_storage_management_12.indicator_12_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','12a main store','12b main store','12c main store','12d main store','12e main store','12a lab store','12b lab store','12c lab store','12d lab store','12e lab store','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_12a_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_12a_main_store),
                    $row->sub_indicator_12b_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_12b_main_store),
                    $row->sub_indicator_12c_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_12c_main_store),
                    $row->sub_indicator_12d_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_12d_main_store),
                    $row->sub_indicator_12e_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_12e_main_store),
                    $row->sub_indicator_12a_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_12a_lab_store),
                    $row->sub_indicator_12b_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_12b_lab_store),
                    $row->sub_indicator_12c_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_12c_lab_store),
                    $row->sub_indicator_12d_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_12d_lab_store),
                    $row->sub_indicator_12e_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_12e_lab_store),
                    $row->indicator_12_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 12 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 12 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:Q1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 12 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator13ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 13 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_storage_management_13', 'survey_summary.id', '=', 'spars_storage_management_13.survey_summary_id')
            ->select('survey_summary.*',
                'spars_storage_management_13.sub_indicator_13a_main_store',
                'spars_storage_management_13.sub_indicator_13b_main_store',
                'spars_storage_management_13.sub_indicator_13c_main_store',
                'spars_storage_management_13.sub_indicator_13d_main_store',
                'spars_storage_management_13.sub_indicator_13e_main_store',
                'spars_storage_management_13.sub_indicator_13f_main_store',
                'spars_storage_management_13.sub_indicator_13g_main_store',
                'spars_storage_management_13.sub_indicator_13h_main_store',
                'spars_storage_management_13.sub_indicator_13i_main_store',
                'spars_storage_management_13.sub_indicator_13j_main_store',
                'spars_storage_management_13.sub_indicator_13k_main_store',
                'spars_storage_management_13.sub_indicator_13l_main_store',
                'spars_storage_management_13.sub_indicator_13a_lab_store',
                'spars_storage_management_13.sub_indicator_13b_lab_store',
                'spars_storage_management_13.sub_indicator_13c_lab_store',
                'spars_storage_management_13.sub_indicator_13d_lab_store',
                'spars_storage_management_13.sub_indicator_13e_lab_store',
                'spars_storage_management_13.sub_indicator_13f_lab_store',
                'spars_storage_management_13.sub_indicator_13g_lab_store',
                'spars_storage_management_13.sub_indicator_13h_lab_store',
                'spars_storage_management_13.sub_indicator_13i_lab_store',
                'spars_storage_management_13.sub_indicator_13j_lab_store',
                'spars_storage_management_13.sub_indicator_13k_lab_store',
                'spars_storage_management_13.sub_indicator_13l_lab_store',
                'spars_storage_management_13.indicator_13_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','13a main store','13b main store','13c main store','13d main store','13e main store','13f main store','13g main store','13h main store','13i main store','13j main store','13k main store','13l main store','13a lab store','13b lab store','13c lab store','13d lab store','13e lab store','13f lab store','13g lab store','13h lab store','13i lab store','13j lab store','13k lab store','13l lab store','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_13a_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13a_main_store),
                    $row->sub_indicator_13b_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13b_main_store),
                    $row->sub_indicator_13c_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13c_main_store),
                    $row->sub_indicator_13d_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13d_main_store),
                    $row->sub_indicator_13e_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13e_main_store),
                    $row->sub_indicator_13f_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13f_main_store),
                    $row->sub_indicator_13g_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13g_main_store),
                    $row->sub_indicator_13h_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13h_main_store),
                    $row->sub_indicator_13i_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13i_main_store),
                    $row->sub_indicator_13j_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13j_main_store),
                    $row->sub_indicator_13k_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13k_main_store),
                    $row->sub_indicator_13l_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_13l_main_store),
                    $row->sub_indicator_13a_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13a_lab_store),
                    $row->sub_indicator_13b_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13b_lab_store),
                    $row->sub_indicator_13c_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13c_lab_store),
                    $row->sub_indicator_13d_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13d_lab_store),
                    $row->sub_indicator_13e_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13e_lab_store),
                    $row->sub_indicator_13f_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13f_lab_store),
                    $row->sub_indicator_13g_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13g_lab_store),
                    $row->sub_indicator_13h_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13h_lab_store),
                    $row->sub_indicator_13i_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13i_lab_store),
                    $row->sub_indicator_13j_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13j_lab_store),
                    $row->sub_indicator_13k_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13k_lab_store),
                    $row->sub_indicator_13l_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_13l_lab_store),
                    $row->indicator_13_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 13 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 13 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:AE1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 13 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator14ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 14 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_storage_management_14', 'survey_summary.id', '=', 'spars_storage_management_14.survey_summary_id')
            ->select('survey_summary.*',
                'spars_storage_management_14.sub_indicator_14a_main_store',
                'spars_storage_management_14.sub_indicator_14b_main_store',
                'spars_storage_management_14.sub_indicator_14c_main_store',
                'spars_storage_management_14.sub_indicator_14d_main_store',
                'spars_storage_management_14.sub_indicator_14e_main_store',
                'spars_storage_management_14.sub_indicator_14f_main_store',
                'spars_storage_management_14.sub_indicator_14g_main_store',
                'spars_storage_management_14.sub_indicator_14h_main_store',
                'spars_storage_management_14.sub_indicator_14a_lab_store',
                'spars_storage_management_14.sub_indicator_14b_lab_store',
                'spars_storage_management_14.sub_indicator_14c_lab_store',
                'spars_storage_management_14.sub_indicator_14d_lab_store',
                'spars_storage_management_14.sub_indicator_14e_lab_store',
                'spars_storage_management_14.sub_indicator_14f_lab_store',
                'spars_storage_management_14.sub_indicator_14g_lab_store',
                'spars_storage_management_14.sub_indicator_14h_lab_store',
                'spars_storage_management_14.indicator_14_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','14a main store','14b main store','14c main store','14d main store','14e main store','14f main store','14g main store','14h main store','14a lab store','14b lab store','14c lab store','14d lab store','14e lab store','14f lab store','14g lab store','14h lab store','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_14a_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14a_main_store),
                    $row->sub_indicator_14b_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14b_main_store),
                    $row->sub_indicator_14c_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14c_main_store),
                    $row->sub_indicator_14d_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14d_main_store),
                    $row->sub_indicator_14e_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14e_main_store),
                    $row->sub_indicator_14f_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14f_main_store),
                    $row->sub_indicator_14g_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14g_main_store),
                    $row->sub_indicator_14h_main_store==-1?"NA":sprintf("%d",$row->sub_indicator_14h_main_store),
                    $row->sub_indicator_14a_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14a_lab_store),
                    $row->sub_indicator_14b_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14b_lab_store),
                    $row->sub_indicator_14c_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14c_lab_store),
                    $row->sub_indicator_14d_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14d_lab_store),
                    $row->sub_indicator_14e_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14e_lab_store),
                    $row->sub_indicator_14f_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14f_lab_store),
                    $row->sub_indicator_14g_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14g_lab_store),
                    $row->sub_indicator_14h_lab_store==-1?"NA":sprintf("%d",$row->sub_indicator_14h_lab_store),
                    $row->indicator_14_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 14 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 14 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:W1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 14 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator15ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 15 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_ordering_15', 'survey_summary.id', '=', 'spars_ordering_15.survey_summary_id')
            ->select('survey_summary.*',
                'spars_ordering_15.sub_indicator_15a',
                'spars_ordering_15.sub_indicator_15b',
                'spars_ordering_15.sub_indicator_15c',
                'spars_ordering_15.sub_indicator_15a_soh',
                'spars_ordering_15.sub_indicator_15a_issued',
                'spars_ordering_15.sub_indicator_15a_amc',
                'spars_ordering_15.indicator_15_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','15a','15a soh','15a issued','15a amc','15b','15c','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_15a==-1?"NA":sprintf("%d",$row->sub_indicator_15a),
                    $row->sub_indicator_15a_soh==-1?"NA":sprintf("%d",$row->sub_indicator_15a_soh),
                    $row->sub_indicator_15a_issued==-1?"NA":sprintf("%d",$row->sub_indicator_15a_issued),
                    $row->sub_indicator_15a_amc==-1?"NA":sprintf("%d",$row->sub_indicator_15a_amc),
                    $row->sub_indicator_15b==-1?"NA":sprintf("%d",$row->sub_indicator_15b),
                    $row->sub_indicator_15c==-1?"NA":sprintf("%d",$row->sub_indicator_15c),
                    $row->indicator_15_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 15 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 15 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:M1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 15 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator16ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 16 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_ordering_16', 'survey_summary.id', '=', 'spars_ordering_16.survey_summary_id')
            ->select('survey_summary.*',
                'spars_ordering_16.sub_indicator_16a',
                'spars_ordering_16.sub_indicator_16b',
                'spars_ordering_16.sub_indicator_16c',
                'spars_ordering_16.sub_indicator_16d',
                'spars_ordering_16.sub_indicator_16e',
                'spars_ordering_16.sub_indicator_16f',
                'spars_ordering_16.indicator_16_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','16a','16b','16c','16d','16e','16f','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_16a!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_16a)->format('d F Y'):null,
                    $row->sub_indicator_16b!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_16b)->format('d F Y'):null,
                    $row->sub_indicator_16c==-1?"NA":sprintf("%d",$row->sub_indicator_16c),
                    $row->sub_indicator_16e!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_16e)->format('d F Y'):null,
                    $row->sub_indicator_16e!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_16e)->format('d F Y'):null,
                    $row->sub_indicator_16f==-1?"NA":sprintf("%d",$row->sub_indicator_16f),
                    $row->indicator_16_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 16 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 16 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:M1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 16 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator17ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 17 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_ordering_17', 'survey_summary.id', '=', 'spars_ordering_17.survey_summary_id')
            ->select('survey_summary.*',
                'spars_ordering_17.sub_indicator_17a',
                'spars_ordering_17.indicator_17_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','17a','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_17a==-1?"NA":sprintf("%d",$row->sub_indicator_17a),
                    $row->indicator_17_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 17 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 17 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:H1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 17 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator18ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 18 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('equipment_18', 'survey_summary.id', '=', 'equipment_18.survey_summary_id')
            ->select('survey_summary.*',
                'equipment_18.sub_indicator_18a',
                'equipment_18.sub_indicator_18b',
                'equipment_18.sub_indicator_18c',
                'equipment_18.sub_indicator_18d',
                'equipment_18.indicator_18_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','18a','18b','18c','18d','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_18a==-1?"NA":sprintf("%d",$row->sub_indicator_18a),
                    $row->sub_indicator_18b==-1?"NA":sprintf("%d",$row->sub_indicator_18b),
                    $row->sub_indicator_18c==-1?"NA":sprintf("%d",$row->sub_indicator_18c),
                    $row->sub_indicator_18d==-1?"NA":sprintf("%d",$row->sub_indicator_18d),
                    $row->indicator_18_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 18 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 18 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:K1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 18 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator19ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 19 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('equipment_19', 'survey_summary.id', '=', 'equipment_19.survey_summary_id')
            ->select('survey_summary.*',
                'equipment_19.sub_indicator_19a',
                'equipment_19.sub_indicator_19b',
                'equipment_19.sub_indicator_19c',
                'equipment_19.sub_indicator_19d',
                'equipment_19.indicator_19_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','19a','19b','19c','19d','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_19a==-1?"NA":sprintf("%d",$row->sub_indicator_19a),
                    $row->sub_indicator_19b==-1?"NA":sprintf("%d",$row->sub_indicator_19b),
                    $row->sub_indicator_19c==-1?"NA":sprintf("%d",$row->sub_indicator_19c),
                    $row->sub_indicator_19d==-1?"NA":sprintf("%d",$row->sub_indicator_19d),
                    $row->indicator_19_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 19 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 19 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:K1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 19 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator20ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 20 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('equipment_20', 'survey_summary.id', '=', 'equipment_20.survey_summary_id')
            ->select('survey_summary.*',
                'equipment_20.sub_indicator_20a1',
                'equipment_20.sub_indicator_20a2',
                'equipment_20.sub_indicator_20a3',
                'equipment_20.sub_indicator_20a4',
                'equipment_20.sub_indicator_20a5',
                'equipment_20.sub_indicator_20a6',
                'equipment_20.sub_indicator_20b1',
                'equipment_20.sub_indicator_20b2',
                'equipment_20.sub_indicator_20b3',
                'equipment_20.sub_indicator_20b4',
                'equipment_20.sub_indicator_20b5',
                'equipment_20.sub_indicator_20b6',
                'equipment_20.sub_indicator_20c1',
                'equipment_20.sub_indicator_20c2',
                'equipment_20.sub_indicator_20c3',
                'equipment_20.sub_indicator_20c4',
                'equipment_20.sub_indicator_20c5',
                'equipment_20.sub_indicator_20c6',
                'equipment_20.sub_indicator_20d1',
                'equipment_20.sub_indicator_20d2',
                'equipment_20.sub_indicator_20d3',
                'equipment_20.sub_indicator_20d4',
                'equipment_20.sub_indicator_20d5',
                'equipment_20.sub_indicator_20d6',
                'equipment_20.sub_indicator_20e1',
                'equipment_20.sub_indicator_20e2',
                'equipment_20.sub_indicator_20e3',
                'equipment_20.sub_indicator_20e4',
                'equipment_20.sub_indicator_20e5',
                'equipment_20.sub_indicator_20e6',
                'equipment_20.sub_indicator_20f1',
                'equipment_20.sub_indicator_20f2',
                'equipment_20.sub_indicator_20f3',
                'equipment_20.sub_indicator_20f4',
                'equipment_20.sub_indicator_20f5',
                'equipment_20.sub_indicator_20f6',
                'equipment_20.indicator_20_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District',
        'Facility','Level','Ownership','Visit date','Visit number','Form ID',
        '20a1','20a2','20a3','20a4','20a5','20a6',
        '20b1','20b2','20b3','20b4','20b5','20b6',
        '20c1','20c2','20c3','20c4','20c5','20c6',
        '20d1','20d2','20d3','20d4','20d5','20d6',
        '20e1','20e2','20e3','20e4','20e5','20e6',
        '20f1','20f2','20f3','20f4','20f5','20f6'
        ,'Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_20a1==-1?"NA":sprintf("%d",$row->sub_indicator_20a1),
                    $row->sub_indicator_20a2==-1?"NA":sprintf("%d",$row->sub_indicator_20a2),
                    $row->sub_indicator_20a3==-1?"NA":sprintf("%d",$row->sub_indicator_20a3),
                    $row->sub_indicator_20a4==-1?"NA":sprintf("%d",$row->sub_indicator_20a4),
                    $row->sub_indicator_20a5==-1?"NA":sprintf("%d",$row->sub_indicator_20a5),
                    $row->sub_indicator_20a6==-1?"NA":sprintf("%d",$row->sub_indicator_20a6),

                    $row->sub_indicator_20b1==-1?"NA":sprintf("%d",$row->sub_indicator_20b1),
                    $row->sub_indicator_20b2==-1?"NA":sprintf("%d",$row->sub_indicator_20b2),
                    $row->sub_indicator_20b3==-1?"NA":sprintf("%d",$row->sub_indicator_20b3),
                    $row->sub_indicator_20b4==-1?"NA":sprintf("%d",$row->sub_indicator_20b4),
                    $row->sub_indicator_20b5==-1?"NA":sprintf("%d",$row->sub_indicator_20b5),
                    $row->sub_indicator_20b6==-1?"NA":sprintf("%d",$row->sub_indicator_20b6),

                    $row->sub_indicator_20c1==-1?"NA":sprintf("%d",$row->sub_indicator_20c1),
                    $row->sub_indicator_20c2==-1?"NA":sprintf("%d",$row->sub_indicator_20c2),
                    $row->sub_indicator_20c3==-1?"NA":sprintf("%d",$row->sub_indicator_20c3),
                    $row->sub_indicator_20c4==-1?"NA":sprintf("%d",$row->sub_indicator_20c4),
                    $row->sub_indicator_20c5==-1?"NA":sprintf("%d",$row->sub_indicator_20c5),
                    $row->sub_indicator_20c6==-1?"NA":sprintf("%d",$row->sub_indicator_20c6),

                    $row->sub_indicator_20d1==-1?"NA":sprintf("%d",$row->sub_indicator_20d1),
                    $row->sub_indicator_20d2==-1?"NA":sprintf("%d",$row->sub_indicator_20d2),
                    $row->sub_indicator_20d3==-1?"NA":sprintf("%d",$row->sub_indicator_20d3),
                    $row->sub_indicator_20d4==-1?"NA":sprintf("%d",$row->sub_indicator_20d4),
                    $row->sub_indicator_20d5==-1?"NA":sprintf("%d",$row->sub_indicator_20d5),
                    $row->sub_indicator_20d6==-1?"NA":sprintf("%d",$row->sub_indicator_20d6),

                    $row->sub_indicator_20e1==-1?"NA":sprintf("%d",$row->sub_indicator_20e1),
                    $row->sub_indicator_20e2==-1?"NA":sprintf("%d",$row->sub_indicator_20e2),
                    $row->sub_indicator_20e3==-1?"NA":sprintf("%d",$row->sub_indicator_20e3),
                    $row->sub_indicator_20e4==-1?"NA":sprintf("%d",$row->sub_indicator_20e4),
                    $row->sub_indicator_20e5==-1?"NA":sprintf("%d",$row->sub_indicator_20e5),
                    $row->sub_indicator_20e6==-1?"NA":sprintf("%d",$row->sub_indicator_20e6),

                    $row->sub_indicator_20f1==-1?"NA":sprintf("%d",$row->sub_indicator_20f1),
                    $row->sub_indicator_20f2==-1?"NA":sprintf("%d",$row->sub_indicator_20f2),
                    $row->sub_indicator_20f3==-1?"NA":sprintf("%d",$row->sub_indicator_20f3),
                    $row->sub_indicator_20f4==-1?"NA":sprintf("%d",$row->sub_indicator_20f4),
                    $row->sub_indicator_20f5==-1?"NA":sprintf("%d",$row->sub_indicator_20f5),
                    $row->sub_indicator_20f6==-1?"NA":sprintf("%d",$row->sub_indicator_20f6),

                    $row->indicator_20_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 20 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 20 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:AQ1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 20 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator21ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 21 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('equipment_21', 'survey_summary.id', '=', 'equipment_21.survey_summary_id')
            ->select('survey_summary.*',
                'equipment_21.sub_indicator_211ab',
                'equipment_21.sub_indicator_211ac',
                'equipment_21.sub_indicator_211ad',
                'equipment_21.sub_indicator_211ah',
                'equipment_21.sub_indicator_211bb',
                'equipment_21.sub_indicator_211bc',
                'equipment_21.sub_indicator_211bd',
                'equipment_21.sub_indicator_211bh',
                'equipment_21.sub_indicator_211cb',
                'equipment_21.sub_indicator_211cc',
                'equipment_21.sub_indicator_211cd',
                'equipment_21.sub_indicator_211ch',
                'equipment_21.sub_indicator_211db',
                'equipment_21.sub_indicator_211dc',
                'equipment_21.sub_indicator_211dd',
                'equipment_21.sub_indicator_211dh',
                'equipment_21.sub_indicator_211eb',
                'equipment_21.sub_indicator_211ec',
                'equipment_21.sub_indicator_211ed',
                'equipment_21.sub_indicator_211eh',
                'equipment_21.sub_indicator_212ab',
                'equipment_21.sub_indicator_212ac',
                'equipment_21.sub_indicator_212ad',
                'equipment_21.sub_indicator_212ah',
                'equipment_21.sub_indicator_212bb',
                'equipment_21.sub_indicator_212bc',
                'equipment_21.sub_indicator_212bd',
                'equipment_21.sub_indicator_212bh',
                'equipment_21.sub_indicator_213ab',
                'equipment_21.sub_indicator_213ac',
                'equipment_21.sub_indicator_213ad',
                'equipment_21.sub_indicator_213ah',
                'equipment_21.sub_indicator_213bb',
                'equipment_21.sub_indicator_213bc',
                'equipment_21.sub_indicator_213bd',
                'equipment_21.sub_indicator_213bh',
                'equipment_21.sub_indicator_213cb',
                'equipment_21.sub_indicator_213cc',
                'equipment_21.sub_indicator_213cd',
                'equipment_21.sub_indicator_213ch',
                'equipment_21.sub_indicator_213db',
                'equipment_21.sub_indicator_213dc',
                'equipment_21.sub_indicator_213dd',
                'equipment_21.sub_indicator_213dh',
                'equipment_21.sub_indicator_213eb',
                'equipment_21.sub_indicator_213ec',
                'equipment_21.sub_indicator_213ed',
                'equipment_21.sub_indicator_213eh',
                'equipment_21.sub_indicator_213fb',
                'equipment_21.sub_indicator_213fc',
                'equipment_21.sub_indicator_213fd',
                'equipment_21.sub_indicator_213fh',
                'equipment_21.sub_indicator_213gb',
                'equipment_21.sub_indicator_213gc',
                'equipment_21.sub_indicator_213gd',
                'equipment_21.sub_indicator_213gh',
                'equipment_21.sub_indicator_213hb',
                'equipment_21.sub_indicator_213hc',
                'equipment_21.sub_indicator_213hd',
                'equipment_21.sub_indicator_213hh',
                'equipment_21.sub_indicator_213ib',
                'equipment_21.sub_indicator_213ic',
                'equipment_21.sub_indicator_213id',
                'equipment_21.sub_indicator_213ih',
                'equipment_21.sub_indicator_213jb',
                'equipment_21.sub_indicator_213jc',
                'equipment_21.sub_indicator_213jd',
                'equipment_21.sub_indicator_213jh',
                'equipment_21.indicator_21_comments')
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District',
        'Facility','Level','Ownership','Visit date','Visit number','Form ID',
        '211ab','211ac','211ad','211ae','211af','211ag','211ah',
        '211bb','211bc','211bd','211be','211bf','211bg','211bh',
        '211cb','211cc','211cd','211ce','211cf','211cg','211ch',
        '211db','211dc','211dd','211de','211df','211dg','211dh',
        '211eb','211ec','211ed','211ee','211ef','211eg','211eh',
        '212ab','212ac','212ad','212ae','212af','212ag','212ah',
        '212bb','212bc','212bd','212be','212bf','212bg','212bh',
        '213ab','213ac','213ad','213ae','213af','213ag','213ah',
        '213bb','213bc','213bd','213be','213bf','213bg','213bh',
        '213cb','213cc','213cd','213ce','213cf','213cg','213ch',
        '213db','213dc','213dd','213de','213df','213dg','213dh',
        '213eb','213ec','213ed','213ee','213ef','213eg','213eh',
        '213fb','213fc','213fd','213fe','213ff','213fg','213fh',
        '213gb','213gc','213gd','213ge','213gf','213gg','213gh',
        '213hb','213hc','213hd','213he','213hf','213hg','213hh',
        '213ib','213ic','213id','213ie','213if','213ig','213ih',
        '213jb','213jc','213jd','213je','213jf','213jg','213jh',
        'Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                    $sub_indicator_211ab_denominator = $row->sub_indicator_211ab*$row->sub_indicator_211ac;
                    $sub_indicator_211bb_denominator = $row->sub_indicator_211bb*$row->sub_indicator_211bc;
                    $sub_indicator_211cb_denominator = $row->sub_indicator_211cb*$row->sub_indicator_211cc;
                    $sub_indicator_211db_denominator = $row->sub_indicator_211db*$row->sub_indicator_211dc;
                    $sub_indicator_211eb_denominator = $row->sub_indicator_211eb*$row->sub_indicator_211ec;

                    $sub_indicator_212ab_denominator = $row->sub_indicator_212ab*$row->sub_indicator_212ac;
                    $sub_indicator_212bb_denominator = $row->sub_indicator_212bb*$row->sub_indicator_212bc;

                    $sub_indicator_213ab_denominator = $row->sub_indicator_213ab*$row->sub_indicator_213ac;
                    $sub_indicator_213bb_denominator = $row->sub_indicator_213bb*$row->sub_indicator_213bc;
                    $sub_indicator_213cb_denominator = $row->sub_indicator_213cb*$row->sub_indicator_213cc;
                    $sub_indicator_213db_denominator = $row->sub_indicator_213db*$row->sub_indicator_213dc;
                    $sub_indicator_213eb_denominator = $row->sub_indicator_213eb*$row->sub_indicator_213ec;
                    $sub_indicator_213fb_denominator = $row->sub_indicator_213fb*$row->sub_indicator_213fc;
                    $sub_indicator_213gb_denominator = $row->sub_indicator_213gb*$row->sub_indicator_213gc;
                    $sub_indicator_213hb_denominator = $row->sub_indicator_213hb*$row->sub_indicator_213hc;
                    $sub_indicator_213ib_denominator = $row->sub_indicator_213ib*$row->sub_indicator_213ic;
                    $sub_indicator_213jb_denominator = $row->sub_indicator_213jb*$row->sub_indicator_213jc;


                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,

                    $row->sub_indicator_211ab==-1?"NA":sprintf("%d",$row->sub_indicator_211ab),
                    $row->sub_indicator_211ac==-1?"NA":sprintf("%d",$row->sub_indicator_211ac),
                    $row->sub_indicator_211ad==-1?"NA":sprintf("%d",$row->sub_indicator_211ad),
                    $row->sub_indicator_211ac==-1?"NA":sprintf("%d",($row->sub_indicator_211ab*$row->sub_indicator_211ac)),
                    $row->sub_indicator_211ac==-1?"NA": ( $sub_indicator_211ab_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_211ad/($row->sub_indicator_211ab*$row->sub_indicator_211ac)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_211ah==-1?"NA":sprintf("%d",$row->sub_indicator_211ah),
                    $row->sub_indicator_211ac==-1?"NA":   ($row->sub_indicator_211ah==$row->sub_indicator_211ab)? sprintf("%d",1): sprintf("%d",0),

                    $row->sub_indicator_211bb==-1?"NA":sprintf("%d",$row->sub_indicator_211bb),
                    $row->sub_indicator_211bc==-1?"NA":sprintf("%d",$row->sub_indicator_211bc),
                    $row->sub_indicator_211bd==-1?"NA":sprintf("%d",$row->sub_indicator_211bd),
                    $row->sub_indicator_211bc==-1?"NA":sprintf("%d",($row->sub_indicator_211bb*$row->sub_indicator_211bc)),
                    $row->sub_indicator_211bc==-1?"NA": ( $sub_indicator_211bb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_211bd/($row->sub_indicator_211bb*$row->sub_indicator_211bc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_211bh==-1?"NA":sprintf("%d",$row->sub_indicator_211bh),
                    $row->sub_indicator_211bc==-1?"NA":   ($row->sub_indicator_211bh==$row->sub_indicator_211bb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_211cb==-1?"NA":sprintf("%d",$row->sub_indicator_211cb),
                    $row->sub_indicator_211cc==-1?"NA":sprintf("%d",$row->sub_indicator_211cc),
                    $row->sub_indicator_211cd==-1?"NA":sprintf("%d",$row->sub_indicator_211cd),
                    $row->sub_indicator_211cc==-1?"NA":sprintf("%d",($row->sub_indicator_211cb*$row->sub_indicator_211cc)),
                    $row->sub_indicator_211cc==-1?"NA": ( $sub_indicator_211cb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_211cd/($row->sub_indicator_211cb*$row->sub_indicator_211cc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_211ch==-1?"NA":sprintf("%d",$row->sub_indicator_211ch),
                    $row->sub_indicator_211cc==-1?"NA":   ($row->sub_indicator_211ch==$row->sub_indicator_211cb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_211db==-1?"NA":sprintf("%d",$row->sub_indicator_211db),
                    $row->sub_indicator_211dc==-1?"NA":sprintf("%d",$row->sub_indicator_211dc),
                    $row->sub_indicator_211dd==-1?"NA":sprintf("%d",$row->sub_indicator_211dd),
                    $row->sub_indicator_211dc==-1?"NA":sprintf("%d",($row->sub_indicator_211db*$row->sub_indicator_211dc)),
                    $row->sub_indicator_211dc==-1?"NA": ( $sub_indicator_211db_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_211dd/($row->sub_indicator_211db*$row->sub_indicator_211dc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_211dh==-1?"NA":sprintf("%d",$row->sub_indicator_211dh),
                    $row->sub_indicator_211dc==-1?"NA":   ($row->sub_indicator_211dh==$row->sub_indicator_211db)? sprintf("%d",1): sprintf("%d",0),

                    $row->sub_indicator_211eb==-1?"NA":sprintf("%d",$row->sub_indicator_211eb),
                    $row->sub_indicator_211ec==-1?"NA":sprintf("%d",$row->sub_indicator_211ec),
                    $row->sub_indicator_211ed==-1?"NA":sprintf("%d",$row->sub_indicator_211ed),
                    $row->sub_indicator_211ec==-1?"NA":sprintf("%d",($row->sub_indicator_211eb*$row->sub_indicator_211ec)),
                    $row->sub_indicator_211ec==-1?"NA": ( $sub_indicator_211eb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_211ed/($row->sub_indicator_211eb*$row->sub_indicator_211ec)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_211eh==-1?"NA":sprintf("%d",$row->sub_indicator_211eh),
                    $row->sub_indicator_211ec==-1?"NA":   ($row->sub_indicator_211eh==$row->sub_indicator_211eb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_212ab==-1?"NA":sprintf("%d",$row->sub_indicator_212ab),
                    $row->sub_indicator_212ac==-1?"NA":sprintf("%d",$row->sub_indicator_212ac),
                    $row->sub_indicator_212ad==-1?"NA":sprintf("%d",$row->sub_indicator_212ad),
                    $row->sub_indicator_212ac==-1?"NA":sprintf("%d",($row->sub_indicator_212ab*$row->sub_indicator_212ac)),
                    $row->sub_indicator_212ac==-1?"NA": ( $sub_indicator_212ab_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_212ad/($row->sub_indicator_212ab*$row->sub_indicator_212ac)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_212ah==-1?"NA":sprintf("%d",$row->sub_indicator_212ah),
                    $row->sub_indicator_212ac==-1?"NA":   ($row->sub_indicator_212ah==$row->sub_indicator_212ab)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_212bb==-1?"NA":sprintf("%d",$row->sub_indicator_212bb),
                    $row->sub_indicator_212bc==-1?"NA":sprintf("%d",$row->sub_indicator_212bc),
                    $row->sub_indicator_212bd==-1?"NA":sprintf("%d",$row->sub_indicator_212bd),
                    $row->sub_indicator_212bc==-1?"NA":sprintf("%d",($row->sub_indicator_212bb*$row->sub_indicator_212bc)),
                    $row->sub_indicator_212bc==-1?"NA": ( $sub_indicator_212bb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_212bd/($row->sub_indicator_212bb*$row->sub_indicator_212bc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_212bh==-1?"NA":sprintf("%d",$row->sub_indicator_212bh),
                    $row->sub_indicator_212bc==-1?"NA":   ($row->sub_indicator_212bh==$row->sub_indicator_212bb)? sprintf("%d",1): sprintf("%d",0),

                    $row->sub_indicator_213ab==-1?"NA":sprintf("%d",$row->sub_indicator_213ab),
                    $row->sub_indicator_213ac==-1?"NA":sprintf("%d",$row->sub_indicator_213ac),
                    $row->sub_indicator_213ad==-1?"NA":sprintf("%d",$row->sub_indicator_213ad),
                    $row->sub_indicator_213ac==-1?"NA":sprintf("%d",($row->sub_indicator_213ab*$row->sub_indicator_213ac)),
                    $row->sub_indicator_213ac==-1?"NA": ( $sub_indicator_213ab_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213ad/($row->sub_indicator_213ab*$row->sub_indicator_213ac)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213ah==-1?"NA":sprintf("%d",$row->sub_indicator_213ah),
                    $row->sub_indicator_213ac==-1?"NA":   ($row->sub_indicator_213ah==$row->sub_indicator_213ab)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213bb==-1?"NA":sprintf("%d",$row->sub_indicator_213bb),
                    $row->sub_indicator_213bc==-1?"NA":sprintf("%d",$row->sub_indicator_213bc),
                    $row->sub_indicator_213bd==-1?"NA":sprintf("%d",$row->sub_indicator_213bd),
                    $row->sub_indicator_213bc==-1?"NA":sprintf("%d",($row->sub_indicator_213bb*$row->sub_indicator_213bc)),
                    $row->sub_indicator_213bc==-1?"NA": ( $sub_indicator_213bb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213bd/($row->sub_indicator_213bb*$row->sub_indicator_213bc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213bh==-1?"NA":sprintf("%d",$row->sub_indicator_213bh),
                    $row->sub_indicator_213bc==-1?"NA":   ($row->sub_indicator_213bh==$row->sub_indicator_213bb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213cb==-1?"NA":sprintf("%d",$row->sub_indicator_213cb),
                    $row->sub_indicator_213cc==-1?"NA":sprintf("%d",$row->sub_indicator_213cc),
                    $row->sub_indicator_213cd==-1?"NA":sprintf("%d",$row->sub_indicator_213cd),
                    $row->sub_indicator_213cc==-1?"NA":sprintf("%d",($row->sub_indicator_213cb*$row->sub_indicator_213cc)),
                    $row->sub_indicator_213cc==-1?"NA": ( $sub_indicator_213cb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213cd/($row->sub_indicator_213cb*$row->sub_indicator_213cc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213ch==-1?"NA":sprintf("%d",$row->sub_indicator_213ch),
                    $row->sub_indicator_213cc==-1?"NA":   ($row->sub_indicator_213ch==$row->sub_indicator_213cb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213db==-1?"NA":sprintf("%d",$row->sub_indicator_213db),
                    $row->sub_indicator_213dc==-1?"NA":sprintf("%d",$row->sub_indicator_213dc),
                    $row->sub_indicator_213dd==-1?"NA":sprintf("%d",$row->sub_indicator_213dd),
                    $row->sub_indicator_213dc==-1?"NA":sprintf("%d",($row->sub_indicator_213db*$row->sub_indicator_213dc)),
                    $row->sub_indicator_213dc==-1?"NA": ( $sub_indicator_213db_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213dd/($row->sub_indicator_213db*$row->sub_indicator_213dc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213dh==-1?"NA":sprintf("%d",$row->sub_indicator_213dh),
                    $row->sub_indicator_213dc==-1?"NA":   ($row->sub_indicator_213dh==$row->sub_indicator_213db)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213eb==-1?"NA":sprintf("%d",$row->sub_indicator_213eb),
                    $row->sub_indicator_213ec==-1?"NA":sprintf("%d",$row->sub_indicator_213ec),
                    $row->sub_indicator_213ed==-1?"NA":sprintf("%d",$row->sub_indicator_213ed),
                    $row->sub_indicator_213ec==-1?"NA":sprintf("%d",($row->sub_indicator_213eb*$row->sub_indicator_213ec)),
                    $row->sub_indicator_213ec==-1?"NA": ( $sub_indicator_213eb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213ed/($row->sub_indicator_213eb*$row->sub_indicator_213ec)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213eh==-1?"NA":sprintf("%d",$row->sub_indicator_213eh),
                    $row->sub_indicator_213ec==-1?"NA":   ($row->sub_indicator_213eh==$row->sub_indicator_213eb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213fb==-1?"NA":sprintf("%d",$row->sub_indicator_213fb),
                    $row->sub_indicator_213fc==-1?"NA":sprintf("%d",$row->sub_indicator_213fc),
                    $row->sub_indicator_213fd==-1?"NA":sprintf("%d",$row->sub_indicator_213fd),
                    $row->sub_indicator_213fc==-1?"NA":sprintf("%d",($row->sub_indicator_213fb*$row->sub_indicator_213fc)),
                    $row->sub_indicator_213fc==-1?"NA": ( $sub_indicator_213fb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213fd/($row->sub_indicator_213fb*$row->sub_indicator_213fc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213fh==-1?"NA":sprintf("%d",$row->sub_indicator_213fh),
                    $row->sub_indicator_213fc==-1?"NA":   ($row->sub_indicator_213fh==$row->sub_indicator_213fb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213gb==-1?"NA":sprintf("%d",$row->sub_indicator_213gb),
                    $row->sub_indicator_213gc==-1?"NA":sprintf("%d",$row->sub_indicator_213gc),
                    $row->sub_indicator_213gd==-1?"NA":sprintf("%d",$row->sub_indicator_213gd),
                    $row->sub_indicator_213gc==-1?"NA":sprintf("%d",($row->sub_indicator_213gb*$row->sub_indicator_213gc)),
                    $row->sub_indicator_213gc==-1?"NA": ( $sub_indicator_213gb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213gd/($row->sub_indicator_213gb*$row->sub_indicator_213gc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213gh==-1?"NA":sprintf("%d",$row->sub_indicator_213gh),
                    $row->sub_indicator_213gc==-1?"NA":   ($row->sub_indicator_213gh==$row->sub_indicator_213gb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213hb==-1?"NA":sprintf("%d",$row->sub_indicator_213hb),
                    $row->sub_indicator_213hc==-1?"NA":sprintf("%d",$row->sub_indicator_213hc),
                    $row->sub_indicator_213hd==-1?"NA":sprintf("%d",$row->sub_indicator_213hd),
                    $row->sub_indicator_213hc==-1?"NA":sprintf("%d",($row->sub_indicator_213hb*$row->sub_indicator_213hc)),
                    $row->sub_indicator_213hc==-1?"NA": ( $sub_indicator_213hb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213hd/($row->sub_indicator_213hb*$row->sub_indicator_213hc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213hh==-1?"NA":sprintf("%d",$row->sub_indicator_213hh),
                    $row->sub_indicator_213hc==-1?"NA":   ($row->sub_indicator_213hh==$row->sub_indicator_213hb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213ib==-1?"NA":sprintf("%d",$row->sub_indicator_213ib),
                    $row->sub_indicator_213ic==-1?"NA":sprintf("%d",$row->sub_indicator_213ic),
                    $row->sub_indicator_213id==-1?"NA":sprintf("%d",$row->sub_indicator_213id),
                    $row->sub_indicator_213ic==-1?"NA":sprintf("%d",($row->sub_indicator_213ib*$row->sub_indicator_213ic)),
                    $row->sub_indicator_213ic==-1?"NA": ( $sub_indicator_213ib_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213id/($row->sub_indicator_213ib*$row->sub_indicator_213ic)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213ih==-1?"NA":sprintf("%d",$row->sub_indicator_213ih),
                    $row->sub_indicator_213ic==-1?"NA":   ($row->sub_indicator_213ih==$row->sub_indicator_213ib)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->sub_indicator_213jb==-1?"NA":sprintf("%d",$row->sub_indicator_213jb),
                    $row->sub_indicator_213jc==-1?"NA":sprintf("%d",$row->sub_indicator_213jc),
                    $row->sub_indicator_213jd==-1?"NA":sprintf("%d",$row->sub_indicator_213jd),
                    $row->sub_indicator_213jc==-1?"NA":sprintf("%d",($row->sub_indicator_213jb*$row->sub_indicator_213jc)),
                    $row->sub_indicator_213jc==-1?"NA": ( $sub_indicator_213jb_denominator == 0?sprintf("%d",0):  ( ($row->sub_indicator_213jd/($row->sub_indicator_213jb*$row->sub_indicator_213jc)*100)>70? sprintf("%d",1): sprintf("%d",0) ) ),
                    $row->sub_indicator_213jh==-1?"NA":sprintf("%d",$row->sub_indicator_213jh),
                    $row->sub_indicator_213jc==-1?"NA":   ($row->sub_indicator_213jh==$row->sub_indicator_213jb)? sprintf("%d",1): sprintf("%d",0) ,

                    $row->indicator_21_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 21 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 21 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:DV1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 21 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator22ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 22 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_info_system_22', 'survey_summary.id', '=', 'spars_info_system_22.survey_summary_id')
            ->select('survey_summary.*',
                'spars_info_system_22.sub_indicator_22a',
                'spars_info_system_22.sub_indicator_22b',
                'spars_info_system_22.sub_indicator_22c',
                'spars_info_system_22.sub_indicator_22d',
                'spars_info_system_22.sub_indicator_22e',
                'spars_info_system_22.sub_indicator_22f',
                'spars_info_system_22.sub_indicator_22g',
                'spars_info_system_22.sub_indicator_22h',
                'spars_info_system_22.sub_indicator_22i',
                'spars_info_system_22.sub_indicator_22j',
                'spars_info_system_22.sub_indicator_22k',
                'spars_info_system_22.sub_indicator_22l',
                'spars_info_system_22.sub_indicator_22m',
                'spars_info_system_22.sub_indicator_22n',
                'spars_info_system_22.indicator_22_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','22a','22b','22c','22d','22e','22f','22g','22h','22i','22j','22k','22l','22m','22n','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_22a==-1?"NA":sprintf("%d",$row->sub_indicator_22a),
                    $row->sub_indicator_22b==-1?"NA":sprintf("%d",$row->sub_indicator_22b),
                    $row->sub_indicator_22c==-1?"NA":sprintf("%d",$row->sub_indicator_22c),
                    $row->sub_indicator_22d==-1?"NA":sprintf("%d",$row->sub_indicator_22d),
                    $row->sub_indicator_22e==-1?"NA":sprintf("%d",$row->sub_indicator_22e),
                    $row->sub_indicator_22f==-1?"NA":sprintf("%d",$row->sub_indicator_22f),
                    $row->sub_indicator_22g==-1?"NA":sprintf("%d",$row->sub_indicator_22g),
                    $row->sub_indicator_22h==-1?"NA":sprintf("%d",$row->sub_indicator_22h),
                    $row->sub_indicator_22i==-1?"NA":sprintf("%d",$row->sub_indicator_22i),
                    $row->sub_indicator_22j==-1?"NA":sprintf("%d",$row->sub_indicator_22j),
                    $row->sub_indicator_22k==-1?"NA":sprintf("%d",$row->sub_indicator_22k),
                    $row->sub_indicator_22l==-1?"NA":sprintf("%d",$row->sub_indicator_22l),
                    $row->sub_indicator_22m==-1?"NA":sprintf("%d",$row->sub_indicator_22m),
                    $row->sub_indicator_22n==-1?"NA":sprintf("%d",$row->sub_indicator_22n),
                    $row->indicator_22_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 22 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 22 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:U1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 22 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator23ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 23 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $rows = DB::table('survey_summary')
            ->join('spars_info_system_23', 'survey_summary.id', '=', 'spars_info_system_23.survey_summary_id')
            ->select('survey_summary.*',
                'spars_info_system_23.sub_indicator_23a',
                'spars_info_system_23.sub_indicator_23b',
                'spars_info_system_23.indicator_23_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','23a','23b','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_23a==-1?"NA":sprintf("%d",$row->sub_indicator_23a),
                    $row->sub_indicator_23b==-1?"NA":sprintf("%d",$row->sub_indicator_23b),
                    $row->indicator_23_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 23 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 23 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:I1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 23 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator24ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 24 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_info_system_24', 'survey_summary.id', '=', 'spars_info_system_24.survey_summary_id')
            ->select('survey_summary.*',
                'spars_info_system_24.sub_indicator_24a',
                'spars_info_system_24.sub_indicator_24b',
                'spars_info_system_24.sub_indicator_24c',
                'spars_info_system_24.indicator_24_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','24a','24b','24c','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_24a!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_24a)->format('d F Y'):null,
                    $row->sub_indicator_24b!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_24b)->format('d F Y'):null,
                    $row->sub_indicator_24c==-1?"NA":sprintf("%d",$row->sub_indicator_24c),
                    $row->indicator_24_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 24 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 24 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:J1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 24 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }

    public function extractIndicator25ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 25 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);

        $rows = DB::table('survey_summary')
            ->join('spars_info_system_25', 'survey_summary.id', '=', 'spars_info_system_25.survey_summary_id')
            ->select('survey_summary.*',
                  'spars_info_system_25.sub_indicator_25aa',
                  'spars_info_system_25.sub_indicator_25ab',
                  'spars_info_system_25.sub_indicator_25ac',
                  'spars_info_system_25.sub_indicator_25ba1',
                  'spars_info_system_25.sub_indicator_25ba2',
                  'spars_info_system_25.sub_indicator_25ba3',
                  'spars_info_system_25.sub_indicator_25ba4',
                  'spars_info_system_25.sub_indicator_25ba5',
                  'spars_info_system_25.sub_indicator_25ba6',
                  'spars_info_system_25.sub_indicator_25ba7',
                  'spars_info_system_25.sub_indicator_25ba8',
                  'spars_info_system_25.sub_indicator_25bb1',
                  'spars_info_system_25.sub_indicator_25bb2',
                  'spars_info_system_25.sub_indicator_25bb3',
                  'spars_info_system_25.sub_indicator_25bb4',
                  'spars_info_system_25.sub_indicator_25bb5',
                  'spars_info_system_25.sub_indicator_25bb6',
                  'spars_info_system_25.sub_indicator_25bb7',
                  'spars_info_system_25.sub_indicator_25bb8',
                  'spars_info_system_25.sub_indicator_25bc1',
                  'spars_info_system_25.sub_indicator_25bc2',
                  'spars_info_system_25.sub_indicator_25bc3',
                  'spars_info_system_25.sub_indicator_25bc4',
                  'spars_info_system_25.sub_indicator_25bc5',
                  'spars_info_system_25.sub_indicator_25bc6',
                  'spars_info_system_25.sub_indicator_25bc7',
                  'spars_info_system_25.sub_indicator_25bc8',
                  'spars_info_system_25.sub_indicator_cd4item',
                  'spars_info_system_25.sub_indicator_25bd1',
                  'spars_info_system_25.sub_indicator_25bd2',
                  'spars_info_system_25.sub_indicator_25bd3',
                  'spars_info_system_25.sub_indicator_25bd4',
                  'spars_info_system_25.sub_indicator_25bd5',
                  'spars_info_system_25.sub_indicator_25bd6',
                  'spars_info_system_25.sub_indicator_25bd7',
                  'spars_info_system_25.sub_indicator_25bd8',
                  'spars_info_system_25.sub_indicator_25be1',
                  'spars_info_system_25.sub_indicator_25be2',
                  'spars_info_system_25.sub_indicator_25be3',
                  'spars_info_system_25.sub_indicator_25be4',
                  'spars_info_system_25.sub_indicator_25be5',
                  'spars_info_system_25.sub_indicator_25be6',
                  'spars_info_system_25.sub_indicator_25be7',
                  'spars_info_system_25.sub_indicator_25be8',
                  'spars_info_system_25.sub_indicator_25bf1',
                  'spars_info_system_25.sub_indicator_25bf2',
                  'spars_info_system_25.sub_indicator_25bf3',
                  'spars_info_system_25.sub_indicator_25bf4',
                  'spars_info_system_25.sub_indicator_25bf5',
                  'spars_info_system_25.sub_indicator_25bf6',
                  'spars_info_system_25.sub_indicator_25bf7',
                  'spars_info_system_25.sub_indicator_25bf8',
                  'spars_info_system_25.sub_indicator_25bg1',
                  'spars_info_system_25.sub_indicator_25bg2',
                  'spars_info_system_25.sub_indicator_25bg3',
                  'spars_info_system_25.sub_indicator_25bg4',
                  'spars_info_system_25.sub_indicator_25bg5',
                  'spars_info_system_25.sub_indicator_25bg6',
                  'spars_info_system_25.sub_indicator_25bg7',
                  'spars_info_system_25.sub_indicator_25bg8',
                  'spars_info_system_25.sub_indicator_25ca1',
                  'spars_info_system_25.sub_indicator_25ca2',
                  'spars_info_system_25.sub_indicator_25ca3',
                  'spars_info_system_25.sub_indicator_25ca4',
                  'spars_info_system_25.sub_indicator_25cb1',
                  'spars_info_system_25.sub_indicator_25cb2',
                  'spars_info_system_25.sub_indicator_25cb3',
                  'spars_info_system_25.sub_indicator_25cb4',
                  'spars_info_system_25.sub_indicator_25cc1',
                  'spars_info_system_25.sub_indicator_25cc2',
                  'spars_info_system_25.sub_indicator_25cc3',
                  'spars_info_system_25.sub_indicator_25cc4',
                  'spars_info_system_25.sub_indicator_25cd1',
                  'spars_info_system_25.sub_indicator_25cd2',
                  'spars_info_system_25.sub_indicator_25cd3',
                  'spars_info_system_25.sub_indicator_25cd4',
                  'spars_info_system_25.sub_indicator_25ce1',
                  'spars_info_system_25.sub_indicator_25ce2',
                  'spars_info_system_25.sub_indicator_25ce3',
                  'spars_info_system_25.sub_indicator_25ce4',
                  'spars_info_system_25.sub_indicator_25cf1',
                  'spars_info_system_25.sub_indicator_25cf2',
                  'spars_info_system_25.sub_indicator_25cf3',
                  'spars_info_system_25.sub_indicator_25cf4',
                'spars_info_system_25.indicator_25_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number',
                        'Form ID','25aa','25ab','25ac',
                        '25ba1','25ba2','25ba3','25ba4','25ba5','25ba6','25ba7','25ba8',
                        '25bb1','25bb2','25bb3','25bb4','25bb5','25bb6','25bb7','25bb8',
                        '25bc1','25bc2','25bc3','25bc4','25bc5','25bc6','25bc7','25bc8','cd4Item',
                        '25bd1','25bd2','25bd3','25bd4','25bd5','25bd6','25bd7','25bd8',
                        '25be1','25be2','25be3','25be4','25be5','25be6','25be7','25be8',
                        '25bf1','25bf2','25bf3','25bf4','25bf5','25bf6','25bf7','25bf8',
                        '25bg1','25bg2','25bg3','25bg4','25bg5','25bg6','25bg7','25bg8',
                        '25ca1','25ca2','25ca3','25ca4','25cb1','25cb2','25cb3','25cb4',
                        '25cc1','25cc2','25cc3','25cc4','25cd1','25cd2','25cd3','25cd4',
                        'Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_25aa!=null?DateTime::createFromFormat('Y-m-d', $row->sub_indicator_25aa)->format('d F Y'):null,
                    $row->sub_indicator_25ab==-1?"NA":sprintf("%d",$row->sub_indicator_25ab),
                    $row->sub_indicator_25ac==-1?"NA":sprintf("%d",$row->sub_indicator_25ac),

                    $row->sub_indicator_25ba1==-1?"NA":sprintf("%d",$row->sub_indicator_25ba1),
                    $row->sub_indicator_25ba2==-1?"NA":sprintf("%d",$row->sub_indicator_25ba2),
                    $row->sub_indicator_25ba3==-1?"NA":sprintf("%d",$row->sub_indicator_25ba3),
                    $row->sub_indicator_25ba4==-1?"NA":sprintf("%d",$row->sub_indicator_25ba4),
                    $row->sub_indicator_25ba5==-1?"NA":sprintf("%d",$row->sub_indicator_25ba5),
                    $row->sub_indicator_25ba6==-1?"NA":sprintf("%d",$row->sub_indicator_25ba6),
                    $row->sub_indicator_25ba7==-1?"NA":sprintf("%d",$row->sub_indicator_25ba7),
                    $row->sub_indicator_25ba8==-1?"NA":sprintf("%d",$row->sub_indicator_25ba8),

                    $row->sub_indicator_25bb1==-1?"NA":sprintf("%d",$row->sub_indicator_25bb1),
                    $row->sub_indicator_25bb2==-1?"NA":sprintf("%d",$row->sub_indicator_25bb2),
                    $row->sub_indicator_25bb3==-1?"NA":sprintf("%d",$row->sub_indicator_25bb3),
                    $row->sub_indicator_25bb4==-1?"NA":sprintf("%d",$row->sub_indicator_25bb4),
                    $row->sub_indicator_25bb5==-1?"NA":sprintf("%d",$row->sub_indicator_25bb5),
                    $row->sub_indicator_25bb6==-1?"NA":sprintf("%d",$row->sub_indicator_25bb6),
                    $row->sub_indicator_25bb7==-1?"NA":sprintf("%d",$row->sub_indicator_25bb7),
                    $row->sub_indicator_25bb8==-1?"NA":sprintf("%d",$row->sub_indicator_25bb8),

                    $row->sub_indicator_25bc1==-1?"NA":sprintf("%d",$row->sub_indicator_25bc1),
                    $row->sub_indicator_25bc2==-1?"NA":sprintf("%d",$row->sub_indicator_25bc2),
                    $row->sub_indicator_25bc3==-1?"NA":sprintf("%d",$row->sub_indicator_25bc3),
                    $row->sub_indicator_25bc4==-1?"NA":sprintf("%d",$row->sub_indicator_25bc4),
                    $row->sub_indicator_25bc5==-1?"NA":sprintf("%d",$row->sub_indicator_25bc5),
                    $row->sub_indicator_25bc6==-1?"NA":sprintf("%d",$row->sub_indicator_25bc6),
                    $row->sub_indicator_25bc7==-1?"NA":sprintf("%d",$row->sub_indicator_25bc7),
                    $row->sub_indicator_25bc8==-1?"NA":sprintf("%d",$row->sub_indicator_25bc8),

                    $row->sub_indicator_cd4item==-1?"NA":sprintf("%d",$row->sub_indicator_cd4item),
                    $row->sub_indicator_25bd1==-1?"NA":sprintf("%d",$row->sub_indicator_25bd1),
                    $row->sub_indicator_25bd2==-1?"NA":sprintf("%d",$row->sub_indicator_25bd2),
                    $row->sub_indicator_25bd3==-1?"NA":sprintf("%d",$row->sub_indicator_25bd3),
                    $row->sub_indicator_25bd4==-1?"NA":sprintf("%d",$row->sub_indicator_25bd4),
                    $row->sub_indicator_25bd5==-1?"NA":sprintf("%d",$row->sub_indicator_25bd5),
                    $row->sub_indicator_25bd6==-1?"NA":sprintf("%d",$row->sub_indicator_25bd6),
                    $row->sub_indicator_25bd7==-1?"NA":sprintf("%d",$row->sub_indicator_25bd7),
                    $row->sub_indicator_25bd8==-1?"NA":sprintf("%d",$row->sub_indicator_25bd8),

                    $row->sub_indicator_25be1==-1?"NA":sprintf("%d",$row->sub_indicator_25be1),
                    $row->sub_indicator_25be2==-1?"NA":sprintf("%d",$row->sub_indicator_25be2),
                    $row->sub_indicator_25be3==-1?"NA":sprintf("%d",$row->sub_indicator_25be3),
                    $row->sub_indicator_25be4==-1?"NA":sprintf("%d",$row->sub_indicator_25be4),
                    $row->sub_indicator_25be5==-1?"NA":sprintf("%d",$row->sub_indicator_25be5),
                    $row->sub_indicator_25be6==-1?"NA":sprintf("%d",$row->sub_indicator_25be6),
                    $row->sub_indicator_25be7==-1?"NA":sprintf("%d",$row->sub_indicator_25be7),
                    $row->sub_indicator_25be8==-1?"NA":sprintf("%d",$row->sub_indicator_25be8),

                    $row->sub_indicator_25bf1==-1?"NA":sprintf("%d",$row->sub_indicator_25bf1),
                    $row->sub_indicator_25bf2==-1?"NA":sprintf("%d",$row->sub_indicator_25bf2),
                    $row->sub_indicator_25bf3==-1?"NA":sprintf("%d",$row->sub_indicator_25bf3),
                    $row->sub_indicator_25bf4==-1?"NA":sprintf("%d",$row->sub_indicator_25bf4),
                    $row->sub_indicator_25bf5==-1?"NA":sprintf("%d",$row->sub_indicator_25bf5),
                    $row->sub_indicator_25bf6==-1?"NA":sprintf("%d",$row->sub_indicator_25bf6),
                    $row->sub_indicator_25bf7==-1?"NA":sprintf("%d",$row->sub_indicator_25bf7),
                    $row->sub_indicator_25bf8==-1?"NA":sprintf("%d",$row->sub_indicator_25bf8),

                    $row->sub_indicator_25bg1==-1?"NA":sprintf("%d",$row->sub_indicator_25bg1),
                    $row->sub_indicator_25bg2==-1?"NA":sprintf("%d",$row->sub_indicator_25bg2),
                    $row->sub_indicator_25bg3==-1?"NA":sprintf("%d",$row->sub_indicator_25bg3),
                    $row->sub_indicator_25bg4==-1?"NA":sprintf("%d",$row->sub_indicator_25bg4),
                    $row->sub_indicator_25bg5==-1?"NA":sprintf("%d",$row->sub_indicator_25bg5),
                    $row->sub_indicator_25bg6==-1?"NA":sprintf("%d",$row->sub_indicator_25bg6),
                    $row->sub_indicator_25bg7==-1?"NA":sprintf("%d",$row->sub_indicator_25bg7),
                    $row->sub_indicator_25bg8==-1?"NA":sprintf("%d",$row->sub_indicator_25bg8),

                    $row->sub_indicator_25ca1==-1?"NA":sprintf("%d",$row->sub_indicator_25ca1),
                    $row->sub_indicator_25ca2==-1?"NA":sprintf("%d",$row->sub_indicator_25ca2),
                    $row->sub_indicator_25ca3==-1?"NA":sprintf("%d",$row->sub_indicator_25ca3),
                    $row->sub_indicator_25ca4==-1?"NA":sprintf("%d",$row->sub_indicator_25ca4),

                    $row->sub_indicator_25cb1==-1?"NA":sprintf("%d",$row->sub_indicator_25cb1),
                    $row->sub_indicator_25cb2==-1?"NA":sprintf("%d",$row->sub_indicator_25cb2),
                    $row->sub_indicator_25cb3==-1?"NA":sprintf("%d",$row->sub_indicator_25cb3),
                    $row->sub_indicator_25cb4==-1?"NA":sprintf("%d",$row->sub_indicator_25cb4),

                    $row->sub_indicator_25cc1==-1?"NA":sprintf("%d",$row->sub_indicator_25cc1),
                    $row->sub_indicator_25cc2==-1?"NA":sprintf("%d",$row->sub_indicator_25cc2),
                    $row->sub_indicator_25cc3==-1?"NA":sprintf("%d",$row->sub_indicator_25cc3),
                    $row->sub_indicator_25cc4==-1?"NA":sprintf("%d",$row->sub_indicator_25cc4),

                    $row->sub_indicator_25cd1==-1?"NA":sprintf("%d",$row->sub_indicator_25cd1),
                    $row->sub_indicator_25cd2==-1?"NA":sprintf("%d",$row->sub_indicator_25cd2),
                    $row->sub_indicator_25cd3==-1?"NA":sprintf("%d",$row->sub_indicator_25cd3),
                    $row->sub_indicator_25cd4==-1?"NA":sprintf("%d",$row->sub_indicator_25cd4),


                    $row->indicator_25_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 25 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 25 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:CE1', function($cells) {

                    // Set with font color
                    //$cells->setFontColor('#ffffff');


                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 25 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }


    public function extractIndicator26ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 26 extract', function($excel) use ($request)  {
        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $rows = DB::table('survey_summary')
            ->join('spars_info_system_26', 'survey_summary.id', '=', 'spars_info_system_26.survey_summary_id')
            ->select('survey_summary.*',
                'spars_info_system_26.sub_indicator_26a',
                'spars_info_system_26.sub_indicator_26b',
                'spars_info_system_26.indicator_26_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','26a','26b','Comment'];


        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_26a==-1?"NA":sprintf("%d",$row->sub_indicator_26a),
                    $row->sub_indicator_26b==-1?"NA":sprintf("%d",$row->sub_indicator_26b),
                    $row->indicator_26_comments];

            }


            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 26 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 26 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:I1', function($cells) {

                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 26 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }


    public function extractIndicator27ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('Indicator 27 extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $rows = DB::table('survey_summary')
            ->join('spars_info_system_27', 'survey_summary.id', '=', 'spars_info_system_27.survey_summary_id')
            ->select('survey_summary.*',
                'spars_info_system_27.sub_indicator_27a',
                'spars_info_system_27.sub_indicator_27b',
                'spars_info_system_27.sub_indicator_27c',
                'spars_info_system_27.sub_indicator_27d',
                'spars_info_system_27.indicator_27_comments' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','27a','27b','27c','27d','Comment'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->sub_indicator_27a==-1?"NA":sprintf("%d",$row->sub_indicator_27a),
                    $row->sub_indicator_27b==-1?"NA":sprintf("%d",$row->sub_indicator_27b),
                    $row->sub_indicator_27c==-1?"NA":sprintf("%d",$row->sub_indicator_27c),
                    $row->sub_indicator_27d==-1?"NA":sprintf("%d",$row->sub_indicator_27d),
                    $row->indicator_27_comments];

            }

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Indicator 27 extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('Indicator 27 extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:K1', function($cells) {

                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "Indicator 27 extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }



    public function extractIndicator28ToExcel(Request $request)
    {

        // Generate and return the spreadsheet
        $myFile = Excel::create('General information extract', function($excel) use ($request)  {

        $start_date = DateTime::createFromFormat('d F Y', $request->start_date);
        $end_date = DateTime::createFromFormat('d F Y', $request->end_date);


        $rows = DB::table('survey_summary')
            ->join('spars_general', 'survey_summary.form_id', '=', 'spars_general.form_id')
            ->select('survey_summary.*',
                'spars_general.d1',
                'spars_general.d2a',
                'spars_general.d2b',
                'spars_general.d2c',
                'spars_general.d2d',
                'spars_general.d2e',
                'spars_general.d2f',
                'spars_general.d2comment' ,
                'spars_general.d3',
                'spars_general.d3comment' ,
                'spars_general.d4a',
                'spars_general.d4b',
                'spars_general.d4c',
                'spars_general.d4d',
                'spars_general.d4e',
                'spars_general.d4f',
                'spars_general.d4comment' ,
                'spars_general.d5' )
            ->whereBetween('survey_summary.visit_date', array( $start_date->format('Y-m-d 00:00:00'), $end_date->format('Y-m-d 23:59:59') ))
            ->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $par_array = [];


        // Define the Excel spreadsheet headers
        $par_array[] = ['Facility ID','District', 'Facility','Level','Ownership','Visit date','Visit number','Form ID','d1','d2a','d2b','d2c','d2d','d2e','d2f','D2 Comment','d3','D3 Comment','d4a','d4b','d4c','d4d','d4e','d4f','D4 Comment','d5'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($rows as $row) {

                $facility = HealthFacility::find($row->health_facility_id);

                $par_array[] = [$row->health_facility_id,$facility->district,$facility->facility,$facility->level,$facility->ownership,DateTime::createFromFormat('Y-m-d', $row->visit_date)->format('d F Y'),$row->visit_number,
                    $row->form_id,
                    $row->d1,
                    $row->d2a,
                    $row->d2b,
                    $row->d2c,
                    $row->d2d,
                    $row->d2e,
                    $row->d2f,
                    $row->d2comment,
                    $row->d3,
                    $row->d3comment,
                    $row->d4a,
                    $row->d4b,
                    $row->d4c,
                    $row->d4d,
                    $row->d4e,
                    $row->d4f,
                    $row->d4comment,
                    $row->d5
                ];

            }

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('General information extract');
            $excel->setCreator('Lab SPARS database')->setCompany('UNHLS/CPHL');
            $excel->setDescription('General information extract');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($par_array) {

                $sheet->fromArray($par_array, null, 'A1', false, false);

                // Set font with ->setStyle()
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Segoe UI',
                        'size'      =>  10,
                        'bold'      =>  false
                    )
                ));


                // Set font with ->setStyle()`for cells
                $sheet->cells('A1:Z1', function($cells) {

                    // Set font
                    $cells->setFont(array(
                        'family'     => 'Segoe UI',
                        'size'       => 10,
                        'bold'       =>  true
                    ));
                });


            });

        });

        $myFile = $myFile->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "General information extract", //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );

        return response()->json($response);

    }



}
