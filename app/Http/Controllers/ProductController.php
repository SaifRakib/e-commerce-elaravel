<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProductController extends Controller
{
   public function index(){
    $this->AdminAuthCheck();
       return view('admin.add_product');
   }

   public function save_product(Request $request){
    $this->AdminAuthCheck();
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['category_id'] = $request->category_id; 
       $data['manufacture_id'] = $request->manufacture_id; 
       $data['product_short_description'] = $request->product_short_description; 
       $data['product_long_description'] = $request->product_long_description; 
       $data['product_price'] = $request->product_price; 
       $data['product_size'] = $request->product_size; 
       $data['product_color'] = $request->product_color; 
       $image = $request->file('product_image');
       if($image){
           $image_name = Str::random(20);
           $ext= strtolower($image->getClientOriginalExtension());
           $image_fullname = $image_name.'.'.$ext;
           $upload_path = "images/";
           $image_url =$upload_path.$image_fullname;
           $success = $image->move($upload_path,$image_fullname);
           if($success){
               $data['product_image']=$image_url;
               DB::table('tbl_products')->insert($data);
               Session::put('message','Product Added Succesfully');
               return redirect('/add-product');
           }
       }
       $data['product_image']='';
       DB::table('tbl_products')->insert($data);
       Session::put('message','Product Added Succesfully');
       return redirect('/add-product');

   }


   public function all_product(){
    $this->AdminAuthCheck();
    $all_product_info = DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->get();


    $manage_product =view('admin.all_product')
                    ->with('all_product_info',$all_product_info);

                    return view('admin_layout')
                    ->with('admin.all_product', $manage_product);
   }

   public function delete_product($product_id){
    $this->AdminAuthCheck();
    DB::table('tbl_products')
    ->where('product_id',$product_id)
    ->delete();

     Session::put('message','Product Deleted Succesfully');
     return redirect('/all-product');
   }


   public function AdminAuthCheck(){
    $admin_id = Session::get('admin_id');

    if($admin_id){
      return;
    }else{
      return Redirect::to('/admin')->send();
    }
  }

}
