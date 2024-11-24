<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\AddToCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopDetailsController extends Controller
{

    public function shop(){
        if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys','buyProducts'));
        }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys'));
        }
    }

    public function shop_category($category){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$category)->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys','buyProducts'));
         }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$category)->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys'));
         }
    }


    public function shop_price(Request $request){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')
            ->where('price' ,'<=', $request->rangeInput)
            ->latest()->paginate(9)
            ->appends(['rangeInput' => $request->rangeInput]);
            $return_rangeInput = $request->rangeInput;
            return view('frontend.shop.index',compact('products','categorys','return_rangeInput','buyProducts'));
         }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')
            ->where('price' ,'<=', $request->rangeInput)
            ->latest()->paginate(9)
            ->appends(['rangeInput' => $request->rangeInput]);
            $return_rangeInput = $request->rangeInput;
            return view('frontend.shop.index',compact('products','categorys','return_rangeInput'));
         }
    }

    public function index($id){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $shopDetails = Product::where('id', $id)->first();
            $categorys = Category::where('status', 'active')->latest()->get();
            $relateds  = Product::where('category', $shopDetails->category)->latest()->get();
            return view('frontend.shopDetails.index',compact('shopDetails','relateds','categorys','buyProducts'));
         }else{
            $shopDetails = Product::where('id', $id)->first();
            $categorys = Category::where('status', 'active')->latest()->get();
            $relateds  = Product::where('category', $shopDetails->category)->latest()->get();
            return view('frontend.shopDetails.index',compact('shopDetails','relateds','categorys'));
         }
    }


    public function fruitlist(Request $request){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $selects = $request->fruitlist;
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$request->fruitlist)->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys','selects','buyProducts'));
         }else{
            $selects = $request->fruitlist;
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$request->fruitlist)->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys','selects'));
         }

        // return $request;
    }


    public function product_section($section){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('product_category',$section)->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys','buyProducts'));
        }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('product_category',$section)->latest()->paginate(9);
            return view('frontend.shop.index',compact('products','categorys'));
        }

    }


}
