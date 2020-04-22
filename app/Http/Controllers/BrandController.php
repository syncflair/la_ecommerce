<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class BrandController extends Controller
{
     public function index()
    {
    	//echo 'Add brand';
    	return view('admin.add_brand');
    }

    public function all_brand()
    {
    	$all_brand_info = DB::table('tbl_brand')->get(); // get all row from table

    	$manage_brand = view('admin.all_brand')->with('all_brand_info_view', $all_brand_info); 

    	return view('template.dashboard_layout')->with('admin.all_brand', $manage_brand);
    	//return view('admin.all_brand'); //view only page without data
    }

    public function save_brand(Request $request)
    {
        //return $request->all(); //to print all data for test purpose

        //Validation
        $validation = $this->validate($request, [
            'brand_name' =>'required|min:2|max:20',
            'brand_desc' => 'max:50'
        ]);


        //if($validation){
        
    	//create array to get data
    	$data=array();
    	$data['brand_id']=$request->brand_id;
    	$data['brand_name']=$request->brand_name;
    	$data['brand_desc']=$request->brand_desc;
    	$data['pub_status']=$request->pub_status;
    	$data['created_at']=date('d/m/y');

    	DB::table('tbl_brand')->insert($data); //insert data to DB
    	Session::put('message','Brand added successfully'); //massage after insert
    	return Redirect::to('/add-brand'); //*/

    	/*/display data
    	echo '<pre>';
    	print_r($data);//*/ 
       
       // }  	

    }


    public function unactive_brand($brand_id)
    {
    	//echo $brand_id;
    	DB::table('tbl_brand')
    		->where('brand_id',$brand_id)
    		->update(['pub_status' => 0 ]);

    	Session::put('message','Brand Unactive successfully'); //massage after insert
    	return Redirect::to('/all-brand');
    }

    public function active_brand($brand_id)
    {
    	//echo $brand_id;
    	DB::table('tbl_brand')
    		->where('brand_id',$brand_id)
    		->update(['pub_status' => 1 ]);

    	Session::put('message','Brand Activated successfully'); //massage after insert
    	return Redirect::to('/all-brand');
    }



     public function edit_brand($brand_id)
    {
    	$brand_info = DB::table('tbl_brand')
    		->where('brand_id',$brand_id)
    		->first(); // first use for single row from table

    	$brand_data = view('admin.edit_brand')->with('brand_info_view', $brand_info); 

    	return view('template.dashboard_layout')->with('admin.edit_brand', $brand_data);
    	//load edit brand page with data
    }

    public function update_brand(Request $request, $brand_id)
    {
    	//create array to get data
    	$data=array();
    	$data['brand_name']=$request->brand_name;
    	$data['brand_desc']=$request->brand_desc;
    	$data['updated_at']=date('d/m/y');

    	DB::table('tbl_brand')
    			->where('brand_id',$brand_id)
    	->update($data); //update data to DB


    	Session::put('message','Brand Update successfully'); //massage after insert
    	return Redirect::to('/all-brand');//*/

    	/*/display data
    	echo '<pre>';
    	print_r($data);//*/ 
    }


    public function delete_brand($brand_id)
    {
        //echo $brand_id;
        DB::table('tbl_brand')
            ->where('brand_id',$brand_id)
            ->delete();

        Session::put('message','Brand deleted successfully'); //massage after insert
        return Redirect::to('/all-brand');

        //use bootbox script in main template for delete alert popup function
    }
}
