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
}
