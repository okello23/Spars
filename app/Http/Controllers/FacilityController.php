<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Models\District;

use App\Models\Subdistrict;

use App\Models\Personnel;

use App\Models\Facility;

use App\Models\HealthFacility;

use App\Models\Ownership;

use App\Models\Level;

use Illuminate\Support\Facades\Redirect;

use Session;

class FacilityController extends Controller
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
    public function index()
    {

        //List all facilities
        $facilities = HealthFacility::orderBy('district', 'asc')->orderBy('facility', 'asc')->get();

        //Load the view and pass the facility list        
        return view('settings.facility.index')->with('facilities',$facilities);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $district_list = District::orderBy('name', 'asc')
               ->lists('name','id');
        $district_list->prepend("","");


        $sub_district_list = Subdistrict::orderBy('name', 'asc')
               ->lists('name','id');
        $sub_district_list->prepend("","");

        $responsible_lss_list = Personnel::orderBy('first_name', 'asc')
               ->lists('first_name','id');
        $responsible_lss_list->prepend("","");

        $level_list = Level::lists('level','id');
        $level_list->prepend("","");

        $ownership_list = Ownership::lists('owner','id');
        $ownership_list->prepend("","");

        $in_charge_list = Personnel::orderBy('first_name', 'asc')
               ->lists('first_name','id');
        $in_charge_list->prepend("","");                

        return view('settings.facility.create')
                ->with('district_list',$district_list)
                ->with('sub_district_list',$sub_district_list)
                ->with('ownership_list',$ownership_list)
                ->with('level_list',$level_list)
                ->with('responsible_lss_list',$responsible_lss_list)
                ->with('in_charge_list',$in_charge_list);

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
            'district' => 'required|numeric',
            'sub_district' => 'required|numeric',
            'level' => 'required|numeric',
            'ownership' => 'required|numeric',
            'facility_name' => 'required',
            'in_charge' => 'required|numeric',
            'responsible_lss' => 'required|numeric'
        ]);

        $facility = new Facility;

        $facility->district_id = $request->district;
        $facility->subdistrict_id = $request->sub_district;
        $facility->level_id = $request->level;
        $facility->ownership_id = $request->ownership;
        $facility->name = $request->facility_name;
        $facility->in_charge_id = $request->in_charge;
        $facility->responsible_lss_id = $request->responsible_lss;

        $facility->save();    

        // redirect
        Session::flash('message', 'Successfully added the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('facility');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $facility = HealthFacility::find($id);        

        return view('settings.facility.edit')->with('facility', $facility);
    
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
  
        //validate data 
        $validation=$this->validate($request, [
            'incharge_fname' => 'required',
            'incharge_lname' => 'required',
            'incharge_contact' => 'required',            
            'lss_fname' => 'required',
            'lss_lname' => 'required',
            'lss_contact' => 'required'
        ]);   

        $facility =  HealthFacility::find($id);

        $facility->in_charge_fname = $request->incharge_fname;
        $facility->in_charge_lname = $request->incharge_lname;
        $facility->in_charge_contact = $request->incharge_contact;
        $facility->lss_fname = $request->lss_fname;
        $facility->lss_lname = $request->lss_lname;
        $facility->lss_contact = $request->lss_contact;
        $facility->timestamps = false;

        $facility->save();  

        // redirect
        Session::flash('message', 'Successfully updated the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('facility');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $district = Facility::find($id);
        $district->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('facility');
    }

}