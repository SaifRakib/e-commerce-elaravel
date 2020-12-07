<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SliderController extends Controller
{
    public function index(){
        return view('admin.add_slider');
    }

    public function save_slider(Request $request){
      
           $data = array();
        
           $image = $request->file('slider_image');
           if($image){
               $image_name = Str::random(20);
               $ext= strtolower($image->getClientOriginalExtension());
               $image_fullname = $image_name.'.'.$ext;
               $upload_path = "images/";
               $image_url =$upload_path.$image_fullname;
               $success = $image->move($upload_path,$image_fullname);
               if($success){
                   $data['slider_image']=$image_url;
                   DB::table('tbl_slider')->insert($data);
                   Session::put('message','Slider Added Succesfully');
                   return redirect('/all-slider');
               }
           }
        //    $data['slider_image']='';
        //    DB::table('tbl_products')->insert($data);
        //    Session::put('message','Product Added Succesfully');
        //    return redirect('/add-product');
    
       }

       public function all_slider(){
      
        $all_slider_info = DB::table('tbl_slider')->get();
    
    
        $manage_slider =view('admin.all_slider')
                        ->with('all_slider_info',$all_slider_info);
    
                        return view('admin_layout')
                        ->with('admin.all_slider', $manage_slider);
       }

       public function delete_slider($slider_id){
       
        DB::table('tbl_slider')
        ->where('slider_id',$slider_id)
        ->delete();
    
         Session::put('message','Slider Deleted Succesfully');
         return redirect('/all-slider');
       }
    



}
