<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class HomeController extends Controller
{
    function index(){

    $all_publish_product = DB::table('tbl_products')
                        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->limit(9)
                        ->get();


    $manage_publish_product =view('pages.home_content')
                    ->with('all_publish_product',$all_publish_product);

                    return view('index')
                    ->with('pages.home_content', $manage_publish_product);



    
    }


   public function show_product_by_category($category_id){
    $product_by_category = DB::table('tbl_products')
    ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    ->where('tbl_category.category_id',$category_id)
    ->limit(18)
    ->get();


    $manage_product_by_category =view('pages.category_by_product')
    ->with('product_by_category',$product_by_category);

    return view('index')
    ->with('pages.category_by_product', $manage_product_by_category);
    }




    public function show_product_by_manufacture($manufacture_id){
        $product_by_manufacture = DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
        ->where('tbl_manufacture.manufacture_id',$manufacture_id)
        ->limit(18)
        ->get();
    
    
        $manage_product_by_manufacture =view('pages.manufacture_by_product')
        ->with('product_by_manufacture',$product_by_manufacture);
    
        return view('index')
        ->with('pages.manufacture_by_product', $manage_product_by_manufacture);
        }


       public function product_details_by_id($product_id){
        $product_by_details = DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
        ->where('tbl_products.product_id',$product_id)
        ->limit(18)
        ->first();
    
    
        $manage_product_by_details =view('pages.product_details')
        ->with('product_by_details',$product_by_details);
    
        return view('index')
        ->with('pages.product_details', $manage_product_by_details);

        }
    


}
