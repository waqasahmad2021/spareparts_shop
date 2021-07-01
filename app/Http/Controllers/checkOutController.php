<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General;
use App\Models\Products;
use App\Models\placeorders;
use App\Models\Guestusers;
use Illuminate\Support\Facades\Storage;
use Session;

class checkOutController extends Controller
{
    public function index()
    {
        $search_val = "";
        $general = General::all();
        return view("frontend_view/checkout")->with(['general' => $general, 'search_val' => $search_val]);
        // return view("frontend_view/checkout")->with(['all_pro' => $products, 'general' => $general, 'search_val' => $search_val]);
    }

    public function final_checkout(Request $request){
        $this->validate($request,[
            'billing_firstname' => 'required',
            'billing_lastname' => 'required',
            'billing_country' => 'required',
            'billing_street_address' => 'required',
            'billing_town_city' => 'required',
            'billing_stat_country' => 'required',
            'billing_phone' => 'required',
            'billing_email' => 'required',
            'check_method' => 'required',
            'billing_country' => 'required|not_in:0',
        ]);

        $search_val = "";
        $general = General::all();

        $guestuser = new Guestusers;
        $same_as_billing_address = $request->input("same_as_billing_address");
        if($same_as_billing_address == "yes"){
            $guestuser->billing_firstname = $request->input('billing_firstname');
            $guestuser->billing_lastname = $request->input('billing_lastname');
            $guestuser->billing_country = $request->input('billing_country');
            $guestuser->billing_company_name = $request->input('billing_company_name');
            $guestuser->billing_street_address = $request->input('billing_street_address');
            $guestuser->billing_town_city = $request->input('billing_town_city');
            $guestuser->billing_stat_country = $request->input('billing_stat_country');
            $guestuser->billing_phone = $request->input('billing_phone');
            $guestuser->billing_email = $request->input('billing_email');
            $guestuser->shipment_firstname = $request->input('billing_firstname');
            $guestuser->shipment_lastname = $request->input('billing_lastname');
            $guestuser->shipment_country = $request->input('billing_country');
            $guestuser->shipment_street_address = $request->input('billing_street_address');
            $guestuser->shipment_town_city = $request->input('billing_town_city');
            $guestuser->shipment_stat_country = $request->input('billing_stat_country');
            $guestuser->shipment_phone = $request->input('billing_phone');
            $guestuser->shipment_email = $request->input('billing_email');
        }else{
            $guestuser->billing_firstname = $request->input('billing_firstname');
            $guestuser->billing_lastname = $request->input('billing_lastname');
            $guestuser->billing_country = $request->input('billing_country');
            $guestuser->billing_company_name = $request->input('billing_company_name');
            $guestuser->billing_street_address = $request->input('billing_street_address');
            $guestuser->billing_town_city = $request->input('billing_town_city');
            $guestuser->billing_stat_country = $request->input('billing_stat_country');
            $guestuser->billing_phone = $request->input('billing_phone');
            $guestuser->billing_email = $request->input('billing_email');

            $guestuser->shipment_firstname = $request->input('shipment_firstname');
            $guestuser->shipment_lastname = $request->input('shipment_lastname');
            $guestuser->shipment_country = $request->input('shipment_country');
            $guestuser->shipment_street_address = $request->input('shipment_street_address');
            $guestuser->shipment_town_city = $request->input('shipment_town_city');
            $guestuser->shipment_stat_country = $request->input('shipment_stat_country');
            $guestuser->shipment_phone = $request->input('shipment_phone');
            $guestuser->shipment_email = $request->input('shipment_email');
        }
        $guestuser->order_notes = $request->input("order_note");
        $guestuser->save();
        $insertedId = $guestuser->id;
        // $insertedId = 1;

        $productsID = $request->input("proOrgID");
        $totalCheckOutPrice = $request->input("orderTotalCheckOutAmount");
        $runtime_qnt = $request->input("runtime_qnt");

        for($j=0; $j < count($productsID); $j++){
            $placeorder = new placeorders;
        // foreach($productsID as $row_proid){
            $placeorder->guest_user_id = $insertedId;
            $placeorder->product_id = $productsID[$j];
            $placeorder->total_price = $totalCheckOutPrice;
            $placeorder->quantity = $runtime_qnt[$j];
            $placeorder->save();

            $product = Products::find($productsID[$j]);
            $subtractOrgQauntity = ((int)$product->quantity-(int)$runtime_qnt[$j]);
            $product->quantity = $subtractOrgQauntity;
            $product->save();

        }

        $request->session()->flush('cartArr');
        return redirect()->back()->with(['general' => $general, 'search_val' => $search_val]);
    }

}  //end of controller
