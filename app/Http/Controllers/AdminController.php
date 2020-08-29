<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Http\RedirectResponse;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start(); 


class AdminController extends Controller
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
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        // echo '123';
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
                            //table admin
               
        // echo '<pre>';  //xem truoc
        // print_r ($result);
        // echo '</pre>';
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_name);
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message','Password or email invalid. Enter again, pls.');
            return Redirect::to('/admin');
        }
        // return view('admin.dashboard');
    }

    public function logout() { 
        // echo 'thanh cong';
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
