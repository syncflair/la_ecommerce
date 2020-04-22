<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;
use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class CheckoutController extends Controller
{
	 /*/login check
    public function customer_login_check(){

    	return view('pages.login');
    }//*/

    //go to checkout
    public function go_to_checkout(){

    	$customer_id =Session::get('customer_id');
        $shipping_id_exist = DB::table('tbl_shipping')->where('customer_id', $customer_id)->first();
        
        if( @$shipping_id_exist->ship_id != NULL ){
        	return view('pages.payment');
        }else{
        	return view('pages.checkout');
        }
    }

    public function add_shipping_address(Request $request){

    	$data=array();
    	$data['customer_id']= $request->customer_id;
    	$data['ship_name']= $request->ship_name;
    	$data['ship_email']= $request->ship_email;
    	$data['ship_address']= $request->ship_address;
    	$data['ship_mobile_phone']= $request->ship_mobile_phone;
    	$data['zip_code']= $request->zip_code;
    	$data['ship_city']= $request->ship_city;
    	$data['created_at']=date('d/m/y');

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	if($shipping_id){
	    	Session::put('shipping_id',$shipping_id);

	    	return Redirect::to('/go-to-payment');
    	}

    	/*echo "<pre>";
    	print_r($data);//*/
    }

    public function go_to_payment(){
    	return view('pages.payment');
    }

    public function make_payment(Request $request){
    	$customer_id = Session::get('customer_id');
    	$payment_method = $request->payment_method;

    	//Get Ship_id
    	if( Session::get('ship_id') != NULL ){
           $ship_id =Session::get('ship_id'); 
        }else{
            $customer_id =Session::get('customer_id');
            $shipping_id_exist = DB::table('tbl_shipping')->where('customer_id', $customer_id)->first();
            @$ship_id = $shipping_id_exist->ship_id;
        }

        //insert into payment table and also get payment_id
        $pdata=array();
        $pdata['payment_method']= $payment_method;
        $pdata['payment_status']= 'Pending';
        $payment_id = DB::table('tbl_payment')->insertGetId($pdata);


        //insert into order table and also get order_id
        $odata=array();
        $odata['customer_id'] = $customer_id;
        $odata['ship_id'] = $ship_id;
        $odata['payment_id'] = $payment_id;
        $odata['order_total'] = Cart::total();  //get from cart content 
        $odata['order_status'] = 'Pending';
        $order_id = DB::table('tbl_order')->insertGetId($odata);


        //inser into order details table useing loop.. Some Data get from cart content
        $CartContent = Cart::content();	//cart content
        $oddata = array();

        foreach ($CartContent as $value) {
        	$oddata['order_id'] = $order_id;
        	$oddata['product_id'] = $value->id;
        	$oddata['product_name'] = $value->name;
        	$oddata['product_price'] = $value->price;
        	$oddata['product_sales_qty'] = $value->qty;

        	$InsertData = DB::table('tbl_order_details')->insert($oddata);
        	
        }



        if($payment_method == 'cash_on_delivery' ){
			Session::put('message','Your order place successfuly. Please make payment after delivery of your product.! '); //massage after insert

			Cart::destroy();
			return Redirect::to('/success');
		}elseif ($payment_method == 'Bkash') {
			Session::put('message','Your order place successfuly. Please payment to 01714073558 this Bkash And Send us your reference number.'); //massage after insert

			Cart::destroy();
			return Redirect::to('/success');
		}elseif ($payment_method == 'master_card') {
			Session::put('message','Your order place successfull by Mastercard. We will get back to you soon! '); //massage after insert

			Cart::destroy();
			return Redirect::to('/success');
		}else{
			Session::put('message','Something wrong! Try Again! '); //massage after insert
			return Redirect::to('/go-to-payment');
		}
    	
    }

    public function order_success(){
    	return view('pages.success');
    }


}
