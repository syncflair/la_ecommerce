<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class CustomerController extends Controller
{

	//login check
    public function customer_login_check(){

    	return view('pages.login');
    }

    public function customer_registration(Request $request){
    	$data=array();
    	$data['customer_name']= $request->customer_name;
    	$data['customer_email']= $request->customer_email;
    	$data['mobile_number']= $request->mobile_number;
    	$data['password']= md5($request->password);
    	$data['created_at']=date('d/m/y');

    	$customer_id = DB::table('tbl_customer')->insertGetId($data);
    		//insertGetId($data); //this function use for insert and get inserted id

    	if($customer_id){
	    	Session::put('customer_id',$customer_id);
	    	Session::put('customer_name', $request->customer_name);

	    	return Redirect::to('/checkout');
    	}
    }

    public function customer_login(Request $request){

    	
    	$customer_email =$request->customer_email;
    	$customer_password = md5($request->customer_password);

    	$result=DB::table('tbl_customer')
    		->where('customer_email', $customer_email)
    		->where('password',$customer_password)
    		->first(); //first use for get single row.

    	if($result){
			Session::put('customer_id',$result->customer_id);
			Session::put('customer_name',$result->customer_name);

			return Redirect::to('/checkout');
		}else{
			Session::put('message','Something is wrong! Please try again'); //massage after insert
			return Redirect::to('/go-to-login');
		} //*/

    }

    public function customer_logout(){

    	Session::flush(); //distroy Session
    	return Redirect::to('/');
    }
}
