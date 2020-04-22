<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //for sql querybilder
use Session; //for session

class HomeController extends Controller
{
    ////product show in home_content.blade.php paage
    public function index()
    {
    	$all_published_product = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id', '=' , 'tbl_category.category_id')
                ->join('tbl_brand', 'tbl_products.brand_id', '=' , 'tbl_brand.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
                ->where('tbl_products.pub_status',1)
                ->orderBy('tbl_products.product_id', 'desc')
                ->limit(9)
                ->get(); // get all row from table        

    	$manage_published_product = view('pages.home_content')->with('all_published_product_view', $all_published_product); 

    	return view('template.home_layout')->with('pages.home_content', $manage_published_product);
    	//return view('pages.home_content'); //*/
    }

    public function TestPage(){

        return view('pages.test');
    }

    //product by category in shop.blade.php paage
    public function product_by_category($category_id){

        //echo $category_id;

       $all_product_by_category = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id', '=' , 'tbl_category.category_id')
                ->join('tbl_brand', 'tbl_products.brand_id', '=' , 'tbl_brand.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
                ->where('tbl_products.pub_status',1)
                ->where('tbl_products.category_id', $category_id)
                ->orderBy('tbl_products.product_id', 'desc')
                ->limit(20)
                //->get(); // get all row from table   
                ->paginate(5); //to get number of row with paginate() function     

        $manage_all_product_by_category = view('pages.shop')->with('all_product_by_category', $all_product_by_category); 

        return view('template.home_layout')->with('pages.shop', $manage_all_product_by_category); //*/

    }

    //product by brand in shop.blade.php paage
    public function product_by_brand($brand_id){
       // echo $brand_id;
        $all_product_by_brand = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id', '=' , 'tbl_category.category_id')
                ->join('tbl_brand', 'tbl_products.brand_id', '=' , 'tbl_brand.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
                ->where('tbl_products.pub_status',1)
                ->where('tbl_products.brand_id', $brand_id)
                ->orderBy('tbl_products.product_id', 'desc')
                ->limit(20)
                //->get(); // get all row from table  
                ->paginate(5); //to get number of row with paginate() function     

        $manage_all_product_by_brand = view('pages.shop')->with('all_product_by_brand', $all_product_by_brand); 

        return view('template.home_layout')->with('pages.shop', $manage_all_product_by_brand);
        //*/
    }


    //single page product details view
    public function product_view_by_id($product_id){
          $single_product_details = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id', '=' , 'tbl_category.category_id')
                ->join('tbl_brand', 'tbl_products.brand_id', '=' , 'tbl_brand.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
                ->where('tbl_products.pub_status',1)
                ->where('tbl_products.product_id', $product_id)
                //->orderBy('tbl_products.product_id', 'desc')
                ->first(); // get all row from table  

        $manage_single_product_view = view('pages.product_details')->with('single_product_details', $single_product_details); 

        return view('template.home_layout')->with('pages.product_details', $manage_single_product_view);
    }
}
