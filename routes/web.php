<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route without controller
/*Route::get('/', function () {
    return view('pages.home_content');
}); */

/*--------------------------------------------------------------------------
| Frontend Route
|--------------------------------------------------------------------------*/
Route::get('/', 'HomeController@index'); //call index methode in HomeController
Route::get('/test', 'HomeController@TestPage'); //call index methode in HomeController

Route::get('/product-by-category/{category_id}', 'HomeController@product_by_category'); // by category
Route::get('/product-by-brand/{brand_id}', 'HomeController@product_by_brand'); //by brand
Route::get('/product-view/{product_id}', 'HomeController@product_view_by_id'); //Single product view

//cart Route
Route::post('/add-to-cart', 'CartController@add_to_cart'); 
Route::get('/cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
Route::post('/update-cart', 'CartController@update_cart');

//Checkout
Route::get('/checkout', 'CheckoutController@go_to_checkout');
Route::post('/add-shipping-address', 'CheckoutController@add_shipping_address');
Route::get('/go-to-payment', 'CheckoutController@go_to_payment');
Route::post('/make-payment', 'CheckoutController@make_payment');

Route::get('/success', 'CheckoutController@order_success');


//Customer 
Route::post('/customer-registration', 'CustomerController@customer_registration');
Route::get('/go-to-login', 'CustomerController@customer_login_check');
Route::post('/customer-login', 'CustomerController@customer_login');
Route::get('/customer-logout', 'CustomerController@customer_logout');



/*--------------------------------------------------------------------------
| Backend Route
|--------------------------------------------------------------------------*/
Route::get('/logout', 'SuperAdminController@logout'); //Logout
Route::get('/cpanel', 'AdminController@index'); //call index methode in AdminController
Route::post('/login-to-dashboard', 'AdminController@LoginToDashboard'); //Login from action
Route::get('/dashboard', 'SuperAdminController@DashboardLoginCheck'); //Get Dashboard After successfuly login

//Category route
Route::get('/add-category', 'CategoryController@index'); //Call add Category page
Route::get('/all-category', 'CategoryController@all_category'); 
Route::post('/save-category', 'CategoryController@save_category'); 
Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category'); //unactiver publication status
Route::get('/active-category/{category_id}', 'CategoryController@active_category'); //active publication status
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category'); //Edit category
Route::post('/update-category/{category_id}', 'CategoryController@update_category'); //Update category
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category'); //Delete category


//Slider route
Route::get('/add-slider', 'sliderController@index'); //Call add slider page
Route::get('/all-slider', 'sliderController@all_slider'); 
Route::post('/save-slider', 'sliderController@save_slider'); 
Route::get('/unactive-slider/{slider_id}', 'sliderController@unactive_slider'); //unactiver slider status
Route::get('/active-slider/{slider_id}', 'sliderController@active_slider'); //active slider status
Route::get('/edit-slider/{slider_id}', 'sliderController@edit_slider'); //Edit slider
Route::post('/update-slider/{slider_id}', 'sliderController@update_slider'); //Update slider
Route::get('/delete-slider/{slider_id}', 'sliderController@delete_slider'); //Delete slider


//Brand Route
Route::get('/add-brand', 'BrandController@index'); //Call add brand page
Route::get('/all-brand', 'BrandController@all_brand'); 
Route::post('/save-brand', 'BrandController@save_brand'); 
Route::get('/unactive-brand/{brand_id}', 'BrandController@unactive_brand'); 
Route::get('/active-brand/{brand_id}', 'BrandController@active_brand'); 
Route::get('/edit-brand/{brand_id}', 'BrandController@edit_brand');
Route::post('/update-brand/{brand_id}', 'BrandController@update_brand'); 
Route::get('/delete-brand/{brand_id}', 'BrandController@delete_brand');

//Product Route
Route::get('/add-product', 'ProductController@index'); //Call add product page
Route::get('/all-product', 'ProductController@all_product');
Route::post('/save-product', 'ProductController@save_product'); 
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product'); 
Route::get('/active-product/{product_id}', 'ProductController@active_product'); 
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product'); 
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

//Order Route
Route::get('/all-order', 'OrderController@all_order');
Route::get('/view-order/{order_id}', 'OrderController@view_order');


//ajax and Yajra dataTable  for Contact
Route::get('all-contact/destroybulk', 'ContactController@destroy_multiple')->name('all-contact.destroybulk');//destroybulk route must be add before the resource route. For extra methed in resource controller
Route::resource('all-contact','ContactController');
//Route::get('/get-contact', 'ContactController@get_contact')->name('get-contact'); //get-contact url in ajax
//Route::get('all-contact/destroy/{id}', 'ContactController@destroy'); // --work with url:"all-contact/destroy/"+id,












