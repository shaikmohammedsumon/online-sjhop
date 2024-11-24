<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\AddToCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderProductController extends Controller
{
    // public function index(){
    //     $checkouts = Checkout::get();
    //     $carts = AddToCart::get();

    //     foreach($checkouts as $checkout){
    //         // echo  $checkout->addToCart_ID ."<br>";

    //         $explode = explode(',',$checkout->addToCart_ID);
    //         foreach($explode as $view_cart_id){
    //             $cart_ID = $view_cart_id;

    //             echo "<p>" .$cart_ID  ."</p>" ."<br>";

    //             foreach($carts as $cart){
    //                 if($cart->id == $cart_ID){
    //                     return $cart->id;
    //                 }
    //             }
    //         }



    //     }

    //     // return view('dashboard.order_product.newOrderProduct');
    // }


    public function index(){
        $checkouts = Checkout::get();
        $carts = AddToCart::get();

        $matchedCarts = []; // মিলিত cart IDs জমা করতে একটি অ্যারে

        foreach($checkouts as $checkout){
            $explode = explode(',', $checkout->addToCart_ID);

            foreach($explode as $view_cart_id){
                $cart_ID = $view_cart_id;

                foreach($carts as $cart){
                    if($cart->id == $cart_ID){
                        $matchedCarts[] = $cart->id; // মিলিত cart ID জমা করুন
                    }
                }
            }
        }

        // চেক করুন User ID অ্যারের ভেতরে আছে কিনা
        if (in_array(Auth::user()->role == 'admin' || Auth::user()->role == 'maneger' ||  Auth::user()->role == 'seller', $matchedCarts)) {
            // whereIn ব্যবহার করে ডেটা আনুন
            $view_product_details = AddToCart::whereIn('id', $matchedCarts)->latest()->get();
            return view('dashboard.order_product.newOrderProduct', compact('view_product_details'));
        }else {
            // যদি মিল না পাওয়া যায়
            return redirect()->back()->with('error', 'No matching products found.');
        }
    }


}
