<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Personnel;

use App\Models\Cadre;

use Illuminate\Support\Facades\Redirect;

use Session;

class PersonnelController extends Controller
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

        //List all cadres
        $persons = Personnel::with('Cadre')->orderBy('first_name', 'asc')->get();

        //Load the view and pass the personnel list        
        return view('settings.personnel.index')->with('persons',$persons);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cadre_list = Cadre::orderBy('name', 'asc')
               ->lists('name','id');

        $cadre_list->prepend("","");

        return view('settings.personnel.create')
                ->with('cadre_list',$cadre_list);
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',            
            'email' => 'required|email|max:50' ,
            'phone_number'=> ['required','digits:10','regex:/^(07\d{8})$/'],  
            'cadre_id' => 'required|numeric' 
        ]);   

            
        $person = new Personnel;

        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->telephone = $request->phone_number;
        $person->cadre_id = $request->cadre_id;

        $person->save();    

        // redirect
        Session::flash('message', 'Successfully added the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('personnel');

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
    public function edit($id)
    {
        //
        $person = Personnel::find($id);

        $cadre_list = Cadre::orderBy('name', 'asc')
               ->lists('name','id');

        $cadre_list->prepend("","");

        return view('settings.personnel.edit')
            ->with('person', $person)
            ->with('cadre_list', $cadre_list);        
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',            
            'email' => 'required|email|max:50' ,
            'phone_number'=> ['required','digits:10','regex:/^(07\d{8})$/'],  
            'cadre_id' => 'required|numeric' 
        ]);   

            
        $person = Personnel::find($id);

        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->telephone = $request->phone_number;
        $person->cadre_id = $request->cadre_id;

        $person->save();    

        // redirect
        Session::flash('message', 'Successfully updated the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('personnel');        
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
        $person = Personnel::find($id);
        $person->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('personnel');
    }
}
