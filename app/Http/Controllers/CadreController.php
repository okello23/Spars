<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Cadre;
use Illuminate\Support\Facades\Redirect;
use Session;


class CadreController extends Controller
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
        $cadres = Cadre::orderBy('name', 'asc')->get();

        //Load the view and pass the cadre list        
        return view('settings.cadre.index')->with('cadres',$cadres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.cadre.create');
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
            'cadre_name' => 'required|max:50'
        ]);   

        $cadre = new Cadre;

        $cadre->name = $request->cadre_name;

        $cadre->save();    

        // redirect
        Session::flash('message', 'Successfully added the cadre!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('cadre');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cadre = Cadre::find($id);

        return view('settings.cadre.edit')->with('cadre', $cadre);
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
            'cadre_name' => 'required|max:50'
        ]);   

        $cadre =  Cadre::find($id);

        $cadre->name = $request->cadre_name;

        $cadre->save();  

        // redirect
        Session::flash('message', 'Successfully updated the cadre!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('cadre');
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
        $cadre = Cadre::find($id);
        $cadre->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the cadre!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('cadre');
    }
}
