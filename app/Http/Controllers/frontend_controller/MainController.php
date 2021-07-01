<?php

namespace App\Http\Controllers\frontend_controller;

use App\Http\Controllers\Controller;
use App\Models\Main;
use App\Models\Products;
use App\Models\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search_val = "";
        $general = General::all();
        $products = Products::all();
        return view("frontend_view/index")->with(['all_pro' => $products, 'general' => $general, 'search_val' => $search_val]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
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
     * @param  \App\Models\Main  $main
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Main  $main
     * @return \Illuminate\Http\Response
     */

    /*
    public function edit(Request $request,$id)
    {
        $products = Products::find($id);
        // dd($products);return;
        // $request->session()->flush();
        $cartitm_arr = $products->toArray();
        $total = 0;
        $data_org_qnt = $request->input("data_org_qnt");
        $runtime_qantity = $request->input("data_runtime_qnt");
        $totalHide = $request->input("totalHide");

            $carthtml = '';
            // foreach($products->toArray() as $row){
                    $runtimeqnt = $runtime_qantity;
                    $get_price = $products["price"]*$runtime_qantity;

                    $total = $get_price+$totalHide;
                    $carthtml .= '<div class="cart_item">
                                        <div class="cart_img">
                                            <a href="javascript:;"><img src="'.asset("storage/product_images/".$products["image"]).'" alt=""></a>
                                        </div>
                                        <div class="cart_info">
                                            <a href="javascript:;">'.$products["description"].'</a>

                                            <span class="quantity">Qty: '.$runtimeqnt.'</span>
                                            <span class="price_cart">'.$get_price.' AED</span>

                                        </div>
                                        <div class="cart_remove">
                                            <a href="javascript:;"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div>';
            // }
        $request->session()->push('cartArr', $cartitm_arr);
        return redirect()->back();
        // $request->session()->forget('cartArr');
        return json_encode(array("cart" => $carthtml,"total" => $total,"recID" => $products["id"]));

        //return response()->json(array('response'=> $products), 200);
    }*/

    public function edit(Request $request,$id)
    {
        $products = Products::find($id);
        $total = 0;
        $productid = $products["id"];
        $productname = $products["brand"];
        $orgprice = $products["price"];
        $data_org_qnt = $request->input("data_org_qnt");
        $runtime_qantity = $request->input("data_runtime_qnt");
        $totalHide = $request->input("totalHide");
        $runtimeqnt = $runtime_qantity;
        $get_price = $products["price"]*$runtime_qantity;
        $total = $get_price+$totalHide;

        $vat = 5;
        $onlyvat = 0;
        $price_with_vat=0;
        $onlyvat += $vat*($total/100);
        $price_with_vat += $total + ($vat*($total/100));
        $price_with_vat = round($price_with_vat, 2);

        $request->session()->push('cartArr', array("img" => $products["image"], "product_name" => $productname, "org_price" => $orgprice, "description" => $products["description"], "runtimeQnt" => $runtimeqnt, "price" => $get_price, "justVat" => $onlyvat, "vat_with_price" => $price_with_vat, "productOrgID" => $productid));
        return json_encode(array("success" => "ok"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Main  $main
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Main $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Main  $main
     * @return \Illuminate\Http\Response
     */
    public function destroy(Main $main)
    {
        //
    }

    public function search_pro(Request $request)
    {
        $this->validate($request,[
            'search_part_no' => ['required', 'string']
        ]);
        $general = General::all();
        $search_val = $request->input('search_part_no');
        $filterData = DB::table('products')
        ->where('partno','LIKE','%'.$search_val.'%')
        ->orWhere('brand','LIKE','%'.$search_val.'%')
        ->orWhere('model','LIKE','%'.$search_val.'%')
        ->orWhere('year','LIKE','%'.$search_val.'%')
        ->get();
        Session::flash('message', 'yes');
        return view("frontend_view/index")->with(['all_pro' => $filterData, 'general' => $general, 'search_val' => $search_val]);
    }

    public function deleteItem(Request $request,$id){

        Session::forget('cartArr.'.$id);
        return redirect()->back();
        // $value = session('cartArr');
        // if(!empty($value)){
        //     foreach ($value as $key => $item){
        //         if($item['id'] == $id){
        //             echo $item['id'],$id;
        //             unset($value[$index]);
        //             Session::set('cartArr', $id);
        //             $request->session()->forget('cartArr',$id);
        //             // $request->session()->flush([$key]);
        //         }
        //     }
        // }

        // $request->session()->forget('cartArr');

        //return $id;
    }

} // end of controller
