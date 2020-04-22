<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str; //for str::random

use DB; //for sql querybilder
use App\Http\Requests; //for request 
use Illuminate\Support\Facades\Redirect;
use Session; //for session
//session_start(); //start session

class ProductController extends Controller
{
    public function index()
    {
    	//echo 'Add Product';
    	return view('admin.add_product');
    }


    public function all_product()
    {
    	$all_product_info = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id', '=' , 'tbl_category.category_id')
                ->join('tbl_brand', 'tbl_products.brand_id', '=' , 'tbl_brand.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
                ->orderBy('tbl_products.product_id', 'desc')
                //->get(); // get all row from table
                ->paginate(15); //to get number of row with paginate() function

        

    	$manage_product = view('admin.all_product')->with('all_product_info_view', $all_product_info); 

    	return view('template.dashboard_layout')->with('admin.all_product', $manage_product);
    	//return view('admin.all_product'); //view only page without data */

        /*/display data
        echo '<pre>';
        print_r($all_product_info);//*/

    }

    public function save_product(Request $request)
    {
    	//create array to get data
    	$data=array();
    	//$data['product_id']=$request->product_id;
    	$data['pro_name']=$request->pro_name;
    	$data['category_id']=$request->category_id;
    	$data['brand_id']=$request->brand_id;
    	$data['pro_color']=$request->pro_color;
    	$data['pro_size']=$request->pro_size;
    	$data['pro_price']=$request->pro_price;    	
    	$data['pro_desc']=$request->pro_desc;
    	$data['pub_status']=$request->pub_status;
    	$data['created_at']=date('d/m/y');

    	//$data['pro_image']=$request->pro_image;
    	$image = $request->file('pro_image');

    	
    	if($image){ //if image not empty
    		$image_name = Str::random(40); //generate random number //use Illuminate\Support\Str; //
    		//$image_name= str_random(20);
    		$extention = strtolower($image->getClientOriginalExtension()); //get file extention 
    		$image_full_name=$image_name.'.'.$extention; // make new image name with extention
    		$upload_path='UploadImage/product/'; //Define upload Path
    		$image_url=$upload_path.$image_full_name; //make image URL for database
    		$success=$image->move($upload_path,$image_full_name); // image upload to upload path

    		if($success){
    			$data['pro_image'] =$image_url;

    			DB::table('tbl_products')->insert($data); //insert data to DB
		    	Session::put('message','Product added successfully'); //massage after insert
		    	return Redirect::to('/add-product');

    		}

    	}else{ //if image empty
    		$data['pro_image'] ='';

    		DB::table('tbl_products')->insert($data); //insert data to DB
		    Session::put('message','Product added successfully without image'); //massage after insert
		    return Redirect::to('/add-product');//*/

		}
    	/*/display data
    	echo '<pre>';
    	print_r($data);//*/
    }

    

    public function unactive_product($product_id)
    {
    	//echo $product_id;
    	DB::table('tbl_products')
    		->where('product_id',$product_id)
    		->update(['pub_status' => 0 ]);

    	Session::put('message','Product Unactive successfully'); //massage after insert
    	return Redirect::to('/all-product');
    }

    public function active_product($product_id)
    {
    	//echo $product_id;
    	DB::table('tbl_products')
    		->where('product_id',$product_id)
    		->update(['pub_status' => 1 ]);

    	Session::put('message','Product Activated successfully'); //massage after insert
    	return Redirect::to('/all-product');
    }


     public function edit_product($product_id)
    {
    	$product_info = DB::table('tbl_products')
    		->where('product_id',$product_id)
    		->first(); // first use for single row from table

    	$product_data = view('admin.edit_product')->with('product_info_view', $product_info); 

    	return view('template.dashboard_layout')->with('admin.edit_product', $product_data);
    	//load edit product page with data
    }

     public function update_product(Request $request, $product_id)
    {
    	//create array to get data
    	$data=array();
    	$data['pro_name']=$request->pro_name;
    	$data['category_id']=$request->category_id;
    	$data['brand_id']=$request->brand_id;
    	$data['pro_color']=$request->pro_color;
    	$data['pro_size']=$request->pro_size;
    	$data['pro_price']=$request->pro_price;    	
    	$data['pro_desc']=$request->pro_desc;
    	$data['updated_at']=date('d/m/y');		

		$image = $request->file('pro_image');

    	
    	if($image){ //if image not empty

    		//query for existing image
    		$existing_image =DB::table('tbl_products')->select('pro_image')->where('product_id',$product_id)->first();
	    		if(!empty($existing_image->pro_image)) {	    			
	    			@unlink($existing_image->pro_image); //delete file from folder
	    		}//else{echo 'Empty';} 	


	    		$image_name = Str::random(40); //generate random number //use Illuminate\Support\Str; //
	    		//$image_name= str_random(20);
	    		$extention = strtolower($image->getClientOriginalExtension()); //get file extention 
	    		$image_full_name=$image_name.'.'.$extention; // make new image name with extention
	    		$upload_path='UploadImage/product/'; //Define upload Path
	    		$image_url=$upload_path.$image_full_name; //make image URL for database
	    		$success=$image->move($upload_path,$image_full_name); // image upload to upload path

	    		if($success){
	    			$data['pro_image'] =$image_url;

	    			DB::table('tbl_products')->where('product_id', $product_id)->update($data); //update data to DB
			    	Session::put('message','Product Update successfully'); //massage after insert
			    	return Redirect::to('/edit-product/'.$product_id);


    		}//*/

    	}else{ //if image empty
    		//query for existing image
    		$existing_image =DB::table('tbl_products')->select('pro_image')->where('product_id',$product_id)->first();

    		$data['pro_image'] = $existing_image->pro_image; //Existing Image link

    		DB::table('tbl_products')->where('product_id', $product_id)->update($data); //update data to DB
		    Session::put('message','Product Update successfully without image'); //massage after insert
		    return Redirect::to('/edit-product/'.$product_id);//*/
		    //echo 'no Image';

		} 
    }


    public function delete_product($product_id)
    {

        //query for existing image
        $existing_image =DB::table('tbl_products')->select('pro_image')->where('product_id',$product_id)->first();
            if(!empty($existing_image->pro_image)) {                    
                @unlink($existing_image->pro_image); //delete file from folder
            }//else{echo 'Empty';}  

        //echo $product_id;
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->delete();

        Session::put('message','Product deleted successfully'); //massage after insert
        return Redirect::to('/all-product');

        //use bootbox script in main template for delete alert popup function
    }
}
