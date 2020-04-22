<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

use Cart; //use cart class for use cart function

class CartController extends Controller
{
    public function add_to_cart(Request $request){

    	//get data from add-to-cart form
    	$qty = $request->qty;
    	$product_id = $request->product_id;


    	$product_info = DB::table('tbl_products')->where('product_id',$product_id)->first();

		$data['qty'] = $qty;
		$data['id'] = $product_info->product_id;
		$data['name'] = $product_info->pro_name;
		$data['price'] = $product_info->pro_price;
		$data['weight'] = '200'; //recomanded
		$data['options']['image'] = $product_info->pro_image;
		$data['options']['size'] = $product_info->pro_size;
		$data['options']['color'] = $product_info->pro_color;

		Cart::add($data);  //add data to cart
		return Redirect::to('/cart');

    }

    //show cart with category
    public function show_cart(){

    	$all_category_info = DB::table('tbl_category')->where('pub_status', 1)->get();

    	$manage_category_info = view('pages.cart')->with('all_category_info', $all_category_info); 
    	return view('template.home_layout')->with('pages.cart', $manage_category_info);

    }

    //delete single cart item
    public function delete_to_cart($rowId){

        Cart::update($rowId,0);  //replace rowId to 0
        return Redirect::to('/cart');

    }

    //Update qty cart item
    public function update_cart(Request $request){

        $qty = $request->quantity;
        $rowId = $request->rowId;

        Cart::update($rowId,$qty);  //update qty
        return Redirect::to('/cart');

    }


}
