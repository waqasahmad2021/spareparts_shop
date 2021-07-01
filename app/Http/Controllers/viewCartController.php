<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\General;
use Illuminate\Support\Facades\Storage;
use Session;

class viewCartController extends Controller
{
    public function index()
    {
        $search_val = "";
        $general = General::all();
        return view("frontend_view/view_cart")->with(['general' => $general, 'search_val' => $search_val]);
        //return view("frontend_view/view_cart")->with(['all_pro' => $products, 'general' => $general, 'search_val' => $search_val]);
    }

    public function updateCart(Request $request){
        $proid = $request->input('proid');
        $runtimeQnt = $request->input("updateqnt");
        // return count($proid);
        // $global_pro_arr = [];
        // $test_arr = [];

        $request->session()->flush('cartArr');
        $i = 0;
        for($i; $i<count($proid); $i++){
            // echo $proid[$i];
            // echo $runtimeQnt[$i];
            $products = Products::find($proid[$i]);
            // $global_pro_arr[] = $products;

            $total = 0;
            $productid = $products["id"];
            $productname = $products["brand"];
            $orgprice = $products["price"];
            // $data_org_qnt = $request->input("data_org_qnt");
            $runtime_qantity = $runtimeQnt[$i];
            // $totalHide = $request->input("totalHide");
            // $runtimeqnt = $runtime_qantity;
            $get_price = $products["price"]*$runtime_qantity;
            $vat = 5;
            $onlyvat = 0;
            $price_with_vat=0;
            $onlyvat += $vat*($orgprice/100);
            $price_with_vat += $orgprice + ($vat*($orgprice/100));
            $price_with_vat = round($price_with_vat, 2);

            // $test_arr[] = array("img" => $products["image"], "product_name" => $productname, "org_price" => $orgprice, "description" => $products["description"], "runtimeQnt" => $runtime_qantity, "price" => $get_price, "justVat" => $onlyvat, "vat_with_price" => $price_with_vat, "productOrgID" => $productid);

            $request->session()->push('cartArr', array("img" => $products["image"], "product_name" => $productname, "org_price" => $orgprice, "description" => $products["description"], "runtimeQnt" => $runtime_qantity, "price" => $get_price, "justVat" => $onlyvat, "vat_with_price" => $price_with_vat, "productOrgID" => $productid));

        }
        // return json_encode(array("success" => "ok"));
        // dd($test_arr);
        return redirect()->back()->with('success', 'Recored Created.');
    }


} //end of controller
