<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start(); 

class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('brand')->insert($data);
        Session::put('message','Them thuong hieu san pham thanh cong');
        return Redirect::to('add-brand-product');
    }

    public function active_brand_product($id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$id)->update(['brand_status'=>1]); //la mang []
        Session::put('message','Kich hoat danh muc san pham thanh cong');
        return Redirect::to('all-brand-product');
    }

    public function unactive_brand_product($id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$id)->update(['brand_status'=>0]);
        Session::put('message','Khong kich hoat thuong hieu san pham');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('brand')->where('brand_id',$id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('brand')->where('brand_id',$id)->update($data);
        Session::put('message','Cap nhat thuong hieu san pham thanh cong');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($id){   //request de lay yeu cau du lieu
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$id)->delete();
        Session::put('message','Xoa thuong hieu san pham thanh cong');
        return Redirect::to('all-brand-product');
    }  

    //End function admin page

    public function show_brand_home($id){

        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        // $all_product = DB::table('products')->where('product_status','1')->orderby('product_id', 'desc')->limit(4)->get();
        
        $brand_by_id = DB::table('products')->join('brand','products.brand_id','=','brand.brand_id')->where('products.brand_id',$id)->get();
        $brand_name = DB::table('brand')->where('brand.brand_id',$id)->limit(1)->get(); 
        
        return view('page.brand.show_brand')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name);
    }
}
