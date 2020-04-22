<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class SuperAdminController extends Controller
{
	//function for admin authentication check
	public function AdminAuthCheck()
	{
		$admin_id=Session::get('admin_id');
		if($admin_id){
			return;
		}else{
			return Redirect::to('/cpanel')->send(); //send() is fource send function
		}
	}

	public function DashboardLoginCheck()
	{
		$this->AdminAuthCheck(); // Here use $this becouse AdminAuthCheck() function is diclared in this class
		return view('admin.dashboard_content');
		//return Redirect::to('admin.dashboard_content');

	}

     public function logout()
    {
    	/*/ One way to session by items
    	Session::put('admin_id',null);
    	Session::put('admin_name',null); //*/

    	Session::flush(); //distroy Session

    	return Redirect::to('/cpanel');
    }
}
