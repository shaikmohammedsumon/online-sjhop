<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FroentendController extends Controller
{
    public function index(){
        $products = Product::where('status', 'active')->latest()->take(8)->get();
        $categorys = Category::where('status', 'active')->latest()->get();
        $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
        return view("frontend.home.index",compact('categorys','products','organics'));

    }


    public function all_product(){
        $products = Product::where('status', 'active')->latest()->take(8)->get();
        $categorys = Category::where('status', 'active')->latest()->get();
        $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
        return view("frontend.home.index",compact('categorys','products','organics'));
    }


    public function category_product($title){
        // return $title;
        // die();
        $products = Product::where('status', 'active')->where('category',$title)->latest()->take(8)->get();
        $categorys = Category::where('status', 'active')->latest()->get();
        $organics = Product::where('resh_organic_vegetables', 'active')->latest()->get();
        return view("frontend.home.index",compact('categorys','products','organics'));
    }
}
