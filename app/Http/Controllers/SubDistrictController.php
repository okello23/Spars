<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\District;

use App\Models\SubDistrict;

use Illuminate\Support\Facades\Redirect;

use Session;

class SubDistrictController extends Controller
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

        //List all subdistricts
        $subdistricts = Subdistrict::orderBy('name', 'asc')->get();

        //Load the view and pass the subdistrict list        
        return view('settings.subdistrict.index')->with('subdistricts',$subdistricts);        
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

        return view('settings.subdistrict.create')
                ->with('district_list',$district_list);

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
            'sub_district_name' => 'required|max:50',
            'district_id' => 'required|numeric'
        ]);   

        $subdistrict = new Subdistrict;

        $subdistrict->name = $request->sub_district_name;
        $subdistrict->district_id = $request->district_id;

        $subdistrict->save();    

        // redirect
        Session::flash('message', 'Successfully added the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('subdistrict');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                
        $district_list = District::orderBy('name', 'asc')
               ->lists('name','id');
        $district_list->prepend("","");


        $subdistrict = Subdistrict::find($id);

        return view('settings.subdistrict.edit')
            ->with('district_list', $district_list)
            ->with('subdistrict', $subdistrict);
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
            'sub_district_name' => 'required|max:50',
            'district_id' => 'required|numeric'            
        ]);   

        $subdistrict =  Subdistrict::find($id);

        $subdistrict->id = $request->district_id;
        $subdistrict->name = $request->sub_district_name;

        $subdistrict->save();  

        // redirect
        Session::flash('message', 'Successfully updated the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('subdistrict');
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
        $district = Subdistrict::find($id);
        $district->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('subdistrict');
    }
}
