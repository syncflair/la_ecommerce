<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;
use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class OrderController extends Controller
{
    public function all_order(){

    	$all_order_info = DB::table('tbl_order')
    			->join('tbl_customer', 'tbl_order.customer_id', '=' , 'tbl_customer.customer_id')
    			->join('tbl_payment', 'tbl_order.payment_id', '=' , 'tbl_payment.payment_id')
                ->select('tbl_order.*', 'tbl_customer.customer_name', 'tbl_payment.payment_method', 'tbl_payment.payment_status')
                ->orderBy('tbl_order.order_id', 'desc')
                //->get(); // get all row from table
                ->paginate(15); //to get number of row with paginate() function

        

    	$manage_order = view('admin.all_order')->with('all_order_info_view', $all_order_info); 

    	return view('template.dashboard_layout')->with('admin.all_order', $manage_order);
    	
    }

    public function view_order($order_id){


    	$order_by_id = DB::table('tbl_order')
    			->join('tbl_customer', 'tbl_order.customer_id', '=' , 'tbl_customer.customer_id')
    			->join('tbl_payment', 'tbl_order.payment_id', '=' , 'tbl_payment.payment_id')
                ->join('tbl_shipping', 'tbl_order.ship_id', '=' , 'tbl_shipping.ship_id')
                ->where('tbl_order.order_id', $order_id)
                ->select('tbl_order.*', 'tbl_customer.*', 'tbl_payment.payment_method', 'tbl_payment.payment_status', 'tbl_shipping.*')
                ->first(); // get all row from table

        

    	$manage_order_by_id = view('admin.view_order')->with('order_by_id_view', $order_by_id); 

    	return view('template.dashboard_layout')->with('admin.view_order', $manage_order_by_id); //*/

    //return view('admin.view_order');

    }
}
