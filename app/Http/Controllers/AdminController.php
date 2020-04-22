<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class AdminController extends Controller
{
    public function index()
    {
    	//echo 'welcome to Admin Panel';
    	return view('admin.admin_login');
    	//return view('admin.dashboard_content');
    }

    /*//this section move to SuperAdminController.php for secure dashboard
    public function dashboard()
    {
    	return view('admin.dashboard_content');
    }//*/

    public function LoginToDashboard(Request $request)
    {
    	//get data from name tag
    	$admin_email =$request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result=DB::table('tbl_admin')
    		->where('admin_email', $admin_email)
    		->where('admin_password',$admin_password)
    		->first(); //first use for get single row.

    		/*/check output
    		echo '<pre>';
    		print_r($result); 
    		exit(); //*/

    		if($result){
    			Session::put('admin_id',$result->admin_id);
    			Session::put('admin_name',$result->admin_name);
    			return Redirect::to('/dashboard');
    		}else{
    			Session::put('message','Email Or Password Invalid');
    			return Redirect::to('/cpanel');
    		}


    	//return view('admin.dashboard_content');
    }

   
}
