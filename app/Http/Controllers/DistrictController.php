<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\District;

use Illuminate\Support\Facades\Redirect;

use Session;

class DistrictController extends Controller
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

        //List all districts
        $districts = District::orderBy('name', 'asc')->get();

        //Load the view and pass the district list        
        return view('settings.district.index')->with('districts',$districts);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('settings.district.create');

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
            'district_name' => 'required|max:50'
        ]);   

        $district = new District;

        $district->name = $request->district_name;

        $district->save();    

        // redirect
        Session::flash('message', 'Successfully added the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('district');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = district::find($id);

        return view('settings.district.edit')->with('district', $district);
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
            'district_name' => 'required|max:50'
        ]);   

        $district =  district::find($id);

        $district->name = $request->district_name;

        $district->save();  

        // redirect
        Session::flash('message', 'Successfully updated the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('district');
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
        $district = district::find($id);
        $district->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('district');
    }
}
