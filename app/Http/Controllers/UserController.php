<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserHasRole;

use App\Models\Role;

use App\User;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

use Session;

use Validator;

use Auth;

class UserController extends Controller
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

        //List all users
        $users = UserHasRole::with('Role')->with('User')->get();

        //dd($users);

        //Load the view and pass the district list        
        return view('acl.users.index')->with('users',$users);              
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //List all roles
        $roles = Role::orderBy('name','asc')->get()->lists('name','id');   
        $roles->prepend("","");
             
    
        return view('acl.users.create')->with('roles_list',$roles);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:25|unique:users',
            'role_id' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        //create batch record
        $user = new User;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);

        $user->save();    

        $userHasRole = new UserHasRole;

        $userHasRole->user_id = $user->id;
        $userHasRole->role_id = $request->role_id;
        $userHasRole->timestamps = false;

        $userHasRole->save();    


        // redirect
        Session::flash('message', 'Successfully added the record!');
        Session::flash('alert-type', 'success');

        return Redirect::to('user');
        
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
    
        //List all roles
        $roles_list = Role::orderBy('name','asc')->get()->lists('name','id');   
        $roles_list->prepend("","");

        $user = User::find($id);
        $userRole = UserHasRole::where('user_id','=',$id)->first();

        //dd($userRole);

        return view('acl.users.edit')->with('userRole', $userRole)->with('user', $user)->with('roles_list', $roles_list);
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
   
            $this->validate($request, [
                'name' => 'required|max:255',
                'role_id' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);


            $user = User::find($id);

            $user->name = $request->name;
            $user->password = bcrypt($request->password);

            $user->save();    


            $userHasRole = UserHasRole::find($id);
            $userHasRole->role_id = $request->role_id;
            $userHasRole->timestamps = false;

            
            $userHasRole->save();    

            // redirect
            Session::flash('message', 'Successfully updated the record!');
            Session::flash('alert-type', 'success');

            return Redirect::to('user');
         
         }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPassword($id)
    {

        $user = User::find($id);

        return view('acl.password.edit')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        //validate data 
        $validation=$this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]); 


        //
        if (Auth::attempt(['username' => Auth::user()->username, 'password' => $request->old_password])) {
            // Authentication passed...
            
            $user = User::find(Auth::user()->id);


            $user->password = bcrypt($request->password);
            $user->save();

            Session::flash('message', 'Successfully updated your password!');
            Session::flash('alert-type', 'success');

            return Redirect::to('home');
        }

            Session::flash('message', 'Error! Old password is invalid.');
            Session::flash('alert-type', 'error');
            return redirect()->back()->withInput();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        //
        $user = User::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the record!');
        Session::flash('alert-type', 'success');
            
        return Redirect::to('user');
    }
}
