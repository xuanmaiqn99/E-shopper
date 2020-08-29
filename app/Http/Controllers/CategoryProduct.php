<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start(); 

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('category_product')->insert($data);
        Session::put('message','Them danh muc san pham thanh cong');
        return Redirect::to('add-category-product');
    }

    public function active_category_product($id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id',$id)->update(['category_status'=>1]); //la mang []
        Session::put('message','Kich hoat danh muc san pham thanh cong');
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id',$id)->update(['category_status'=>0]);
        Session::put('message','Khong kich hoat danh muc san pham');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($id){
        $this->AuthLogin();
        $edit_category_product = DB::table('category_product')->where('category_id',$id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request,$id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('category_product')->where('category_id',$id)->update($data);
        Session::put('message','Cap nhat danh muc san pham thanh cong');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($id){   //request de lay yeu cau du lieu
        
        $this->AuthLogin(); 
        DB::table('category_product')->where('category_id',$id)->delete();
        Session::put('message','Xoa danh muc san pham thanh cong');
        return Redirect::to('all-category-product');
    }

    //End function admin page

    public function show_category_home($id){

        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();
        // $all_product = DB::table('products')->where('product_status','1')->orderby('product_id', 'desc')->limit(4)->get();
        
        $category_by_id = DB::table('products')->join('category_product','products.category_id','=','category_product.category_id')->where('products.category_id',$id)->get();

        $category_name = DB::table('category_product')->where('category_product.category_id',$id)->limit(1)->get(); //limit 1 lay san pham dau tien, first(1) lay ra dong dau tien
        
        return view('page.category.show_category')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name);
    }
    
}
