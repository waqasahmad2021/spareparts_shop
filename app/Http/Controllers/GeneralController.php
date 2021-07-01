<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class GeneralController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = General::all();
        return view("general_view")->with('general',$general);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("add_general_view");
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
            'company_intro' => 'required',
            'logo' => 'required',
            'logo.*' => 'mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png',
            'address'    => 'required|array',
            'address.*'  => 'required|string|distinct',
            'contact'    => 'required|array',
            'contact.*'  => 'required|integer|distinct',
        ]);

        // For Social Links
        $social_arr = [];
        $facebook = $request->input('facebook');
        $linkedin = $request->input('linkedin');
        $twiter = $request->input('twiter');
        $youtube = $request->input('youtube');
        $googleplus = $request->input('googleplus');


        $social_arr_values = array(
                        "facebook" => $facebook,
                        "linkedin" => $linkedin,
                        "twiter" => $twiter,
                        "youtube" => $youtube,
                        "googleplus" => $googleplus,
                    );
        array_push($social_arr,$social_arr_values);
        $social_arr =  json_encode(array("socia_links" => $social_arr));
        // dd($social_arr);exit;

        // For Multiple Address
        $address = $request->input('address');
        $contact = $request->input('contact');
        $address_arr = [];
        $contact_arr = [];
        for($var=0; $var<count($address); $var++){
            $address_arr[] = $address[$var];
            $contact_arr[] = $contact[$var];
        }
        $address_contact_values =  json_encode(array("address" => $address_arr, "contact" => $contact_arr));

        // Logo Uploading Start

            // Handle file uploading
            $input = [];
            // request()->validate([
            //     'logo' => 'required',
            //     'logo.*' => 'mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png'
            // ]);
            if($request->hasfile('logo')) {
                foreach($request->file('logo') as $file)
                {
                    $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $fileName.'.'.$file->getClientOriginalExtension();
                    // $file->move(public_path('stcompany_logo_images'),$fileName);
                    $file->move('storage/company_logo_images',$fileName);
                    $input[] = $fileName;
                    //Document::create($input);
                }
            }
            $logos_values =  json_encode(array("logos" => $input));

            // save the post in the db
            $general = new General;
            $general->logos = $logos_values;
            $general->company_intro = $request->input('company_intro');
            $general->address_contact = $address_contact_values;
            $general->social_links = $social_arr;
            $general->save();

            return redirect("general/create")->withSuccess('Success! You record has been successfully uploaded.');
            // return $input;
            //  Logo Uploading End


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function show(General $General)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $general = General::find($id);
        // dd($general->toArray());
        return view("edit_general_view")->with('general',$general);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        $this->validate($request,[
            'company_intro' => 'required',
            // 'logo' => 'required',
            // 'logo.*' => 'mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png',
            'address'    => 'required|array',
            'address.0'  => 'required|string|distinct',
            'contact'    => 'required|array',
            'contact.0'  => 'required|integer|distinct',
        ]);

         // For Social Links
         $social_arr = [];
         $facebook = $request->input('facebook');
         $linkedin = $request->input('linkedin');
         $twiter = $request->input('twiter');
         $youtube = $request->input('youtube');
         $googleplus = $request->input('googleplus');


         $social_arr_values = array(
                         "facebook" => $facebook,
                         "linkedin" => $linkedin,
                         "twiter" => $twiter,
                         "youtube" => $youtube,
                         "googleplus" => $googleplus,
                     );
         array_push($social_arr,$social_arr_values);
         $social_arr =  json_encode(array("socia_links" => $social_arr));
         // dd($social_arr);exit;

         // For Multiple Address
         $address = $request->input('address');
         $contact = $request->input('contact');
         $address_arr = [];
         $contact_arr = [];
         for($var=0; $var<count($address); $var++){
            if($address[$var] != null && $contact[$var] != null){
                $address_arr[] = $address[$var];
                $contact_arr[] = $contact[$var];
            }
         }
        $address_contact_values =  json_encode(array("address" => $address_arr, "contact" => $contact_arr));

        // Logo Uploading Start
        // Handle file uploading
        $input = [];
        if($request->hasfile('logo')) {
            // unlink the file from the folder start
            $oldimg_names = $request->input('logo_img_hidden');
            for($var_logo=0; $var_logo<count($oldimg_names); $var_logo++){
                if(file_exists(public_path('storage/company_logo_images/') . $oldimg_names[$var_logo])){
                    unlink(public_path('storage/company_logo_images/') . $oldimg_names[$var_logo]);
                }
            }
            foreach($request->file('logo') as $file)
            {
                $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName.'.'.$file->getClientOriginalExtension();
                // $file->move(public_path('stcompany_logo_images'),$fileName);
                $file->move('storage/company_logo_images',$fileName);
                $input[] = $fileName;
                //Document::create($input);
            }
        }
        $logos_values =  json_encode(array("logos" => $input));

        // Update the post in the db
        $general = General::find($id);
        if($request->hasFile('logo')):
            $general->logos = $logos_values;
        endif;
        $general->company_intro = $request->input('company_intro');
        $general->address_contact = $address_contact_values;
        $general->social_links = $social_arr;
        $general->save();

        return redirect("general")->withSuccess('Success! You record has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(General $General)
    {
        //
    }

} // end of controller
