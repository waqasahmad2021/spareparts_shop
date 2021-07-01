<?php

namespace App\Http\Controllers\admin_controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Session;

class CommonUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("admin_view/users_view")->with("allusers" , $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin_view/add_users_view");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'choices' => 'required|not_in:""',
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ]);

        $global_permission = [];
        
        $per_pro = $request->input('permission_pro');
        if(!empty($per_pro) && is_array($per_pro)){
            foreach($per_pro as $per_pro_row){
                array_push($global_permission, array("product" => $per_pro_row) );   
            }
        }

        $per_user = $request->input('permission_user');
        if(!empty($per_user) && is_array($per_user)){
            foreach($per_user as $per_user_row){
                array_push($global_permission, array("users" => $per_user_row) );   
            }
        }

        $per_general = $request->input('permission_general');
        if(!empty($per_general) && is_array($per_general)){
            foreach($per_general as $per_general_row){
                array_push($global_permission, array("general" => $per_general_row) );   
            }
        }

        $permissionJson = json_encode($global_permission);
        // dd($global_permission); exit;

        $user = new User;
        $user->choices = $request->input('choices');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->permission = $permissionJson;
        $user->save();
        return redirect("common_users")->withSuccess('Success! You record has been successfully submited.');

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
        $user = User::find($id);
        // return dd($user);
        return view('admin_view/edit_profile_view')->with('single_user',$user);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('common_users')->withSuccess('Success! user has been successfully deleted.');
    }
}
