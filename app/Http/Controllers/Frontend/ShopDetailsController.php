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
            $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','buyProducts','featured'));

        }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->latest()->paginate(9);
            $featured  = Product::where('status', 'active')->latest()->get();
            return view('frontend.shop.index',compact('products','categorys','featured'));
        }
    }

    public function shop_category($category){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$category)->latest()->paginate(9);
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','buyProducts','featured'));
         }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$category)->latest()->paginate(9);
            $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','featured'));
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
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','return_rangeInput','buyProducts','featured'));
         }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')
            ->where('price' ,'<=', $request->rangeInput)
            ->latest()->paginate(9)
            ->appends(['rangeInput' => $request->rangeInput]);
            $return_rangeInput = $request->rangeInput;
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','return_rangeInput','featured'));
         }
    }

    public function index($id){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $shopDetails = Product::where('id', $id)->first();
            $categorys = Category::where('status', 'active')->latest()->get();
            $relateds  = Product::where('category', $shopDetails->category)->latest()->get();
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shopDetails.index',compact('shopDetails','relateds','categorys','buyProducts','featured'));
         }else{
            $shopDetails = Product::where('id', $id)->first();
            $categorys = Category::where('status', 'active')->latest()->get();
            $relateds  = Product::where('category', $shopDetails->category)->latest()->get();
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shopDetails.index',compact('shopDetails','relateds','categorys','featured'));
         }
    }


    public function index_profile($id){
        if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $productquery = AddToCart::where('id',$id)->first();
            $shopDetails = Product::where('id', $productquery->product_id)->first();

            $comment = AddToCart::where('id',$id)
            ->where('user_id',$user)
            ->where('confirmation','complete')
            ->first();

            $categorys = Category::where('status', 'active')->latest()->get();
            $relateds  = Product::where('category', $shopDetails->category)->latest()->get();
            $featured  = Product::where('status', 'active')->latest()->take(3)->get();

            // return $comment . "<br>" . $user . "<br>". $id . "<br>";
            return view('frontend.shopDetails.index',compact('shopDetails','comment','relateds','categorys','buyProducts','featured'));
        }else{

            $user = Auth::user()->id;
            $productquery = AddToCart::where('id',$id)->first();
            $shopDetails = Product::where('id', $productquery->product_id)->first();


            $categorys = Category::where('status', 'active')->latest()->get();
            $relateds  = Product::where('category', $shopDetails->category)->latest()->get();
            $featured  = Product::where('status', 'active')->latest()->take(3)->get();

           return view('frontend.shopDetails.index',compact('shopDetails','relateds','categorys','featured'));
        }
   }




    public function fruitlist(Request $request){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $selects = $request->fruitlist;
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$request->fruitlist)->latest()->paginate(9);
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','selects','buyProducts','featured'));
         }else{
            $selects = $request->fruitlist;
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('category' ,$request->fruitlist)->latest()->paginate(9);
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','selects','featured'));
         }

        // return $request;
    }


    public function product_section($section){
         if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();

            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('product_category',$section)->latest()->paginate(9);
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','buyProducts','featured'));
        }else{
            $categorys = Category::where('status', 'active')->latest()->get();
            $products = Product::where('status', 'active')->where('product_category',$section)->latest()->paginate(9);
             $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','featured'));
        }

    }




    public function shop_search(Request $request){
        $search = $request->search;
        if(Auth::check()){
            $products = Product::where('name','LIKE','%' .$request->search .'%')->latest()->paginate(9);
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','buyProducts','featured'));
        }else{
            $products = Product::where('name','LIKE','%' .$request->search .'%')->latest()->paginate(9);
            $categorys = Category::where('status', 'active')->latest()->get();
            $return_rangeInput = $request->rangeInput;
            $featured  = Product::where('status', 'active')->latest()->take(3)->get();
            return view('frontend.shop.index',compact('products','categorys','featured'));
        }

   }




}
