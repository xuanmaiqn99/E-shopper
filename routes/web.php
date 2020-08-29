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

// Route::get('/', function () {
//     return view('layout');
// });

//Frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');

//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{id}','ProductController@detail_product');

//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//Category Product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{id}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/active-category-product/{id}','CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{id}','CategoryProduct@unactive_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{id}','CategoryProduct@update_category_product');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{id}','BrandProduct@delete_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/active-brand-product/{id}','BrandProduct@active_brand_product');
Route::get('/unactive-brand-product/{id}','BrandProduct@unactive_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{id}','BrandProduct@update_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{id}','ProductController@edit_product');
Route::get('/delete-product/{id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/active-product/{id}','ProductController@active_product');
Route::get('/unactive-product/{id}','ProductController@unactive_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{id}','ProductController@update_product');

//Cart
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
//gui bang phuong thuc POST roi nen ko can truyen bien rowId
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');


