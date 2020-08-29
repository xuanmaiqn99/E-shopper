<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('products')->where('product_id',$productId)->first();
        // echo '<pre>';  //xem truoc mang kq
        // print_r ($product_info);
        // echo '</pre>';

        // Cart::add('293ad', 'Product 1', 1, 9.99);
        // Cart::destroy();//huy phien session
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        $data['weight'] = '123';

        Cart::add($data);

        // Cart::destroy();
        return Redirect::to ('/show-cart');
        // return view('page.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function show_cart(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        return view('page.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);

    }

    public function delete_cart($rowId){
        Cart::update($rowId,0);  //dua so luong ve 0, tuc la ko ton tai mat hang
        return Redirect::to ('/show-cart');
    }

    public function update_cart_quantity(Request $request){
    //gui bang hinh thuc POST qua nen minh se lay gia tri     
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity; 
        Cart::update($rowId,$qty);
        return Redirect::to ('/show-cart');

    }
}
