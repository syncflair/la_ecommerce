<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class CategoryController extends Controller
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

    public function index()
    {
        $this->AdminAuthCheck();
    	//echo 'Add Category';
    	return view('admin.add_category');
    }

    public function all_category()
    {
        $this->AdminAuthCheck();

    	$all_category_info = DB::table('tbl_category')->get(); // get all row from table

    	$manage_category = view('admin.all_category')->with('all_category_info_view', $all_category_info); 

    	return view('template.dashboard_layout')->with('admin.all_category', $manage_category);
    	//return view('admin.all_category'); //view only page without data
    }

    public function save_category(Request $request)
    {
        $this->AdminAuthCheck();
    	//create array to get data
    	$data=array();
    	$data['category_id']=$request->category_id;
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['pub_status']=$request->pub_status;
    	$data['created_at']=date('d/m/y');

    	DB::table('tbl_category')->insert($data); //insert data to DB
    	Session::put('message','Category added successfully'); //massage after insert
    	return Redirect::to('/add-category');

    	/*/display data
    	echo '<pre>';
    	print_r($data);//*/   	

    }


    public function unactive_category($category_id)
    {
    	//echo $category_id;
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['pub_status' => 0 ]);

    	Session::put('message','Category Unactive successfully'); //massage after insert
    	return Redirect::to('/all-category');
    }

    public function active_category($category_id)
    {
    	//echo $category_id;
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['pub_status' => 1 ]);

    	Session::put('message','Category Activated successfully'); //massage after insert
    	return Redirect::to('/all-category');
    }



     public function edit_category($category_id)
    {
        $this->AdminAuthCheck();
    	$category_info = DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->first(); // first use for single row from table

    	$category_data = view('admin.edit_category')->with('category_info_view', $category_info); 

    	return view('template.dashboard_layout')->with('admin.edit_category', $category_data);
    	//load edit category page with data
    }

    public function update_category(Request $request, $category_id)
    {
        $this->AdminAuthCheck();
    	//create array to get data
    	$data=array();
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['updated_at']=date('d/m/y');

    	DB::table('tbl_category')
    			->where('category_id',$category_id)
    	->update($data); //update data to DB


    	Session::put('message','Category Update successfully'); //massage after insert
    	return Redirect::to('/all-category');//*/

    	/*/display data
    	echo '<pre>';
    	print_r($data);//*/ 
    }


    public function delete_category($category_id)
    {
        $this->AdminAuthCheck();
        //echo $category_id;
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->delete();

        Session::put('message','Category deleted successfully'); //massage after insert
        return Redirect::to('/all-category');

        //use bootbox script in main template for delete alert popup function
    }


}
