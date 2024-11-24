<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\AddToCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FroentendController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();
            $products = Product::where('status', 'active')->latest()->take(8)->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
            return view("frontend.home.index",compact('categorys','products','organics','buyProducts'));
        }else{

            $products = Product::where('status', 'active')->latest()->take(8)->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
            return view("frontend.home.index",compact('categorys','products','organics'));
        }

    }


    public function all_product(){
        if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();
            $products = Product::where('status', 'active')->latest()->take(8)->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
            return view("frontend.home.index",compact('categorys','products','organics','buyProducts'));
        }else{
            $products = Product::where('status', 'active')->latest()->take(8)->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
            return view("frontend.home.index",compact('categorys','products','organics'));
        }
    }


    public function category_product($title){
        if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->where('processing','deactive')->get();
            $products = Product::where('status', 'active')->where('category',$title)->latest()->take(8)->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
            return view("frontend.home.index",compact('categorys','products','organics','buyProducts'));
        }else{
            $products = Product::where('status', 'active')->where('category',$title)->latest()->take(8)->get();
            $categorys = Category::where('status', 'active')->latest()->get();
            $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
            return view("frontend.home.index",compact('categorys','products','organics'));
        }
    }
}
