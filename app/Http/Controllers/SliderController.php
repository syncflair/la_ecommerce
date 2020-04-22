<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str; //for str::random

use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class SliderController extends Controller
{
    public function index()
    {
    	//echo 'Add brand';
    	return view('admin.add_slider');
    }

    public function all_slider()
    {
    	$all_slider_info = DB::table('tbl_slider')->get(); // get all row from table

    	$manage_slider = view('admin.all_slider')->with('all_slider_info_view', $all_slider_info); 

    	return view('template.dashboard_layout')->with('admin.all_slider', $manage_slider);
    	//return view('admin.all_slider'); //view only page without data
    }

    public function save_slider(Request $request)
    {
        //return $request->all(); //to print all data for test purpose

        //Validation
        $validation = $this->validate($request, [
            'slider_name' =>'required|min:2|max:50',
            'slider_image' =>'required'
        ]);


    	$data=array();
    	$data['slider_name']=$request->slider_name;
    	$data['slider_status']=$request->slider_status;
    	$data['created_at']=date('d/m/y');

    	//$data['slider_image']=$request->slider_image;
    	$image = $request->file('slider_image');

    	//if ($validation) { //validation check 	
    

    	if($image){ //if image not empty
    		$image_name = Str::random(40); //generate random number //use Illuminate\Support\Str; //
    		//$image_name= str_random(20);
    		$extention = strtolower($image->getClientOriginalExtension()); //get file extention 
    		$image_full_name=$image_name.'.'.$extention; // make new image name with extention
    		$upload_path='UploadImage/slider/'; //Define upload Path
    		$image_url=$upload_path.$image_full_name; //make image URL for database
    		$success=$image->move($upload_path,$image_full_name); // image upload to upload path

    		if($success){
    			$data['slider_image'] =$image_url;

    			DB::table('tbl_slider')->insert($data); //insert data to DB
		    	Session::put('message','Slider added successfully'); //massage after insert
		    	return Redirect::to('/add-slider');

    		}

    	}else{ //if image empty
    		$data['slider_image'] ='';

    		DB::table('tbl_slider')->insert($data); //insert data to DB
		    Session::put('message','Slider added successfully without image'); //massage after insert
		    return Redirect::to('/add-slider');//*/

		}

		// } //validation check

    	/*/display data
    	echo '<pre>';
    	print_r($data);//*/ 
       
       // }  	

    }


    public function unactive_slider($slider_id)
    {
    	//echo $slider_id;
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->update(['slider_status' => 0 ]);

    	Session::put('message','Slider Unactive successfully'); //massage after insert
    	return Redirect::to('/all-slider');
    }

    public function active_slider($slider_id)
    {
    	//echo $slider_id;
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->update(['slider_status' => 1 ]);

    	Session::put('message','Slider Activated successfully'); //massage after insert
    	return Redirect::to('/all-slider');
    }



     public function edit_slider($slider_id)
    {
    	$slider_info = DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->first(); // first use for single row from table

    	$slider_data = view('admin.edit_slider')->with('slider_info_view', $slider_info); 

    	return view('template.dashboard_layout')->with('admin.edit_slider', $slider_data);
    	//load edit slider page with data
    }

    public function update_slider(Request $request, $slider_id)
    {
    	//create array to get data
    	$data=array();
    	$data['slider_name']=$request->slider_name;
    	$data['updated_at']=date('d/m/y');		

		$image = $request->file('slider_image');

    	
    	if($image){ //if image not empty

    		//query for existing image
    		$existing_image =DB::table('tbl_slider')->select('slider_image')->where('slider_id',$slider_id)->first();
	    		if(!empty($existing_image->slider_image)) {	    			
	    			@unlink($existing_image->slider_image); //delete file from folder
	    		}//else{echo 'Empty';} 	


	    		$image_name = Str::random(40); //generate random number //use Illuminate\Support\Str; //
	    		//$image_name= str_random(20);
	    		$extention = strtolower($image->getClientOriginalExtension()); //get file extention 
	    		$image_full_name=$image_name.'.'.$extention; // make new image name with extention
	    		$upload_path='UploadImage/slider/'; //Define upload Path
	    		$image_url=$upload_path.$image_full_name; //make image URL for database
	    		$success=$image->move($upload_path,$image_full_name); // image upload to upload path

	    		if($success){
	    			$data['slider_image'] =$image_url;

	    			DB::table('tbl_slider')->where('slider_id', $slider_id)->update($data); //update data to DB
			    	Session::put('message','Slider Update successfully'); //massage after insert
			    	return Redirect::to('/edit-slider/'.$slider_id);


    		}//*/

    	}else{ //if image empty
    		//query for existing image
    		$existing_image =DB::table('tbl_slider')->select('slider_image')->where('slider_id',$slider_id)->first();

    		$data['slider_image'] = $existing_image->slider_image; //Existing Image link

    		DB::table('tbl_slider')->where('slider_id', $slider_id)->update($data); //update data to DB
		    Session::put('message','Slider Update successfully without image'); //massage after insert
		    return Redirect::to('/edit-slider/'.$slider_id);//*/
		    //echo 'no Image';

		} 
    }


    public function delete_slider($slider_id)
    {
		//query for existing image
		$existing_image =DB::table('tbl_slider')->select('slider_image')->where('slider_id',$slider_id)->first();
		if(!empty($existing_image->slider_image)) {	    			
			@unlink($existing_image->slider_image); //delete file from folder
		}//else{echo 'Empty';}


        //echo $slider_id;
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->delete();

        Session::put('message','Slider deleted successfully'); //massage after insert
        return Redirect::to('/all-slider');

        //use bootbox script in main template for delete alert popup function
    }
}
