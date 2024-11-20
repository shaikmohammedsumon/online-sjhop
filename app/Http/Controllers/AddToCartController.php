<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    public function store($id){
        $product = Product::where('id',$id)->first();

        $usr = Auth::user()->id;
        $total =  $product->price;

        AddToCart::create([
            'user_id' => $usr,
            'product_id' => $id,
            'seler_id' =>$product->seller_id,
            'total' => $total,
            'created_at' =>now(),
        ]);
        return redirect()->route('cart.index')->with('add_cart','Your Product add to cart please see and buy now');
    }
}
