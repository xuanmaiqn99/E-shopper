<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class ProductController extends Controller
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
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->orderby('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('products')
        ->join('category_product','category_product.category_id','=','products.category_id')
        ->join('brand','brand.brand_id','=','products.brand_id')
        ->orderby('products.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        // $data['product_image'] = $request->product_image;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            // phan tach chuoi vd:mai.png se tach thanh mai va png
            $new_image = $name_image.rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('products')->insert($data);
            Session::put('message', 'Them san pham thanh cong');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';    //ng dung ko chon san pham se trong 
        DB::table('products')->insert($data);
        Session::put('message', 'Them san pham thanh cong');
        return Redirect::to('all-product');
    }

    public function active_product($id)
    {
        $this->AuthLogin();
        DB::table('products')->where('product_id', $id)->update(['product_status' => 1]); //la mang []
        Session::put('message', 'Kich hoat san pham thanh cong');
        return Redirect::to('all-product');
    }

    public function unactive_product($id)
    {
        $this->AuthLogin();
        DB::table('products')->where('product_id', $id)->update(['product_status' => 0]);
        Session::put('message', 'Khong kich hoat san pham');
        return Redirect::to('all-product');
    }

    public function edit_product($id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('products')->where('product_id', $id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('cate_product',$cate_product)->with('brand_product',$brand_product);  //with edit product: ten goi ham foreach
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        // $data['product_image'] = $request->product_image;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            // phan tach chuoi vd:mai.png se tach thanh mai va png
            $new_image = $name_image.rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('products')->where('product_id',$id)->update($data);
            Session::put('message', 'Cap nhat san pham thanh cong');
            return Redirect::to('all-product');  
        }
        // $data['product_image'] = '';  //ng dung ko chon san pham se trong, nay la update nen bo di 
        DB::table('products')->where('product_id', $id)->update($data);
        Session::put('message', 'Cap nhat san pham thanh cong');
        return Redirect::to('all-product');
    }

    public function delete_product($id)
    {   //request de lay yeu cau du lieu
        $this->AuthLogin();
        DB::table('products')->where('product_id', $id)->delete();
        Session::put('message', 'Xoa san pham thanh cong');
        return Redirect::to('all-product');
    }

    //end function admin page

    public function detail_product($id){
        $cate_product = DB::table('category_product')->where('category_status','1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','1')->orderby('brand_id', 'desc')->get();

        $detail_product = DB::table('products')
        ->join('category_product','category_product.category_id','=','products.category_id')
        ->join('brand','brand.brand_id','=','products.brand_id')
        ->where('products.product_id',$id)->get();

        foreach($detail_product as $key=> $value){
            $category_id = $value->category_id;
        }

        $related_product = DB::table('products')
        ->join('category_product','category_product.category_id','=','products.category_id')
        ->join('brand','brand.brand_id','=','products.brand_id')
        ->where('category_product.category_id',$category_id)
        ->whereNotIn('products.product_id',[$id])->get();
    //    where not in : tru san pham da co roi ->[$id]
        return view('page.product.show_detail')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('product_detail',$detail_product)
        ->with('relate',$related_product);
    }
}
