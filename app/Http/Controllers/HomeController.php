<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // {{ (Auth::user()->choices == "0") ? 'Supper Admin' : 'Admin'}}
        // if (Auth::attempt(['email' => $email, 'password' => $password, 'choices' => 0])) {
            // if (Auth::user()->choices == "0") {
            //     // The user is active, not suspended, and exists.
            //     echo "supper admin";
            // }else{
            //     echo "admin";
            // }
        return view("admin_view/dashboard");
        // return view('home');
    }
}
