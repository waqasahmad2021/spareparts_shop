<?php

namespace App\Http\Controllers\admin_controller;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        return view("admin_view/product_view")->with('all_pro' , $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_view/add_product_view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "store";
        $this->validate($request,[
            'pro_img' => 'image|nullable|max:1999',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
            'vin_vds' => 'required',
            'catalog_code' => 'required',
            'frame_no' => 'required',
            'partno' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

            // Handle file uploading

            if($request->hasFile('pro_img')):
                //Get file name with extension
                $filenameWithExtension = $request->file('pro_img')->getClientOriginalName();
                //Get just the file
                $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);
                //Get the file extension
                $extension = $request->file('pro_img')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload car images
                $path = $request->file('pro_img')->storeAs('public/product_images',$fileNameToStore);
            else:
                $fileNameToStore = 'noimage.png';
            endif;
 
        // save the post in the db
        $product = new Products;
        $product->brand = $request->input('brand');
        $product->model = $request->input('model');
        $product->year = $request->input('year');
        $product->vin_vds = $request->input('vin_vds');
        $product->catalog_code = $request->input('catalog_code');
        $product->frame_no = $request->input('frame_no');
        $product->partno = $request->input('partno');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->image = $fileNameToStore;
        $product->save();
        // return redirect()->back()->with('success', 'Recored Created.');
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Products::find($id);
        return view('admin_view/edit_product_view')->with('single_product',$products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'pro_img' => 'image|nullable|max:1999',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required',
            'vin_vds' => 'required',
            'catalog_code' => 'required',
            'frame_no' => 'required',
            'partno' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('pro_img')):

            // if have old image unlink that first

            $oldImage = $request->input('pro_img_hidden');
            unlink(public_path('storage/product_images/') . $oldImage);

            //Get file name with extension
            $filenameWithExtension = $request->file('pro_img')->getClientOriginalName();
            //Get just the file
            $filename = pathinfo($filenameWithExtension,PATHINFO_FILENAME);
            //Get the file extension
            $extension = $request->file('pro_img')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload car images
            $path = $request->file('pro_img')->storeAs('public/product_images',$fileNameToStore);
        else:

            $fileNameToStore = 'noimage.png';

        endif;

        // save the post in the db
        $product = Products::find($id);
        $product->brand = $request->input('brand');
        $product->model = $request->input('model');
        $product->year = $request->input('year');
        $product->vin_vds = $request->input('vin_vds');
        $product->catalog_code = $request->input('catalog_code');
        $product->frame_no = $request->input('frame_no');
        $product->partno = $request->input('partno');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        if($request->hasFile('pro_img')):
            $product->image = $fileNameToStore;
        endif;
        $product->save();
        return redirect('/product');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        if($products->image != 'noimage.png'):
            Storage::delete('public/product_images/'.$products->image);
        endif;
        $products->delete();
        return redirect()->back();
    }

} // end of the controller
