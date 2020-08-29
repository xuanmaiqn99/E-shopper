<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start(); 

class CheckoutController extends Controller
{
    public function login_checkout(Request $request){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        return view('page.checkout.login_checkout')
        ->with('category',$cate_product)
        ->with('brand',$brand_product);
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = $request->customer_password;

        $customer_id = DB::table('customer')->insertGetId($data);

        Session::put('customer_id',$customer_id); 
        //khi ng dung dky, dang nhap, no se sinh ra 1 phien giao dich
        Session::put('customer_name',$request->customer_name); 
        return Redirect('/checkout');
    }

    public function checkout(){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        return view('page.checkout.checkout')
        ->with('category',$cate_product)
        ->with('brand',$brand_product);
    }
}
