<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Cart;
class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $quantity = $request->quantity;
        $product_id =$request->product_id;
        $product_info = DB::table('tbl_products')
                    ->where('product_id',$product_id)
                    ->first();

           $data['quantity'] = $quantity;   
           $data['id'] = $product_info->product_id; 
           $data['name'] = $product_info->product_name; 
           $data['price'] = $product_info->product_price; 
           $data['attributes']['images']= $product_info->product_image; 


           Cart::add($data);
           return Redirect::to('/show-cart');


    }


    public function show_cart(){
        $all_publish_category = DB::table('tbl_category')->get();

        $manage_publish_category =view('pages.add_to_cart')
                    ->with('all_publish_category',$all_publish_category);

                    return view('index')
                    ->with('pages.add_to_cart', $manage_publish_category);
                                

    }


   public function delete_to_cart($id){
    Cart::remove($id);
    return Redirect::to('show-cart');
   }

   public function update_cart(Request $request){
    $id=$request->id;
    // $quantity = $request->quantity;
     

    \Cart::update($id, array('quantity' => array(
        'relative' => false,
        'value' => $request->quantity
    ), ));
    return Redirect::to('show-cart');
   }


}
