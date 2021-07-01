<?php

namespace App\Http\Controllers\admin_controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class CustomUserController extends Controller
{
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin_view/profile_view");
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

        $user_session = auth()->user();
        //dd($user);
        // if($user->choices == "0"){
        //     auth()->logout();
        //     return '/login';
        // }

        $this->validate($request,[
            //'profileimg' => 'image|nullable|max:1999',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
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


        if($request->hasFile('profileimg')):

            // if have old image unlink that first
                $oldImage = $request->input('profile_img_hidden');
            if($oldImage != ""){
                unlink(public_path('storage/profile_images/') . $oldImage);
            }

            //Get file name with extension
            $filenameWithExtension = $request->file('profileimg')->getClientOriginalName();
            //Get just the file
            $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);
            //Get the file extension
            $extension = $request->file('profileimg')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload car images
            $path = $request->file('profileimg')->storeAs('public/profile_images',$fileNameToStore);
        else:

            $fileNameToStore = 'noimage.gif';

        endif;

        // save the post in the db
        $user = User::find($id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->address = $request->input('address');

        if($user_session->choices === "0"){
            $user->permission = $permissionJson;
        }
        if($request->hasFile('profileimg')):
            $user->image = $fileNameToStore;
        endif;
        $user->save();
        return redirect()->back()->withSuccess('Success! You record has been updated successfully.');
        //return redirect('/profile/create');
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
