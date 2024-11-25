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

    public function store_details(Request $request,$id){
        $product = Product::where('id',$id)->first();

        $usr = Auth::user()->id;
        $total =  $product->price * $request->quantity;

        AddToCart::create([
            'user_id' => $usr,
            'product_id' => $id,
            'seler_id' =>$product->seller_id,
            'quantity' =>$request->quantity,
            'total' => $total,
            'created_at' =>now(),
        ]);
        return redirect()->route('cart.index')->with('add_cart','Your Product add to cart please see and buy now');
    }

    public function confirm(Request $request,$id){
        $addcart = AddToCart::where('id',$id)->first();

        if( $addcart->confirmation == 'deactive'){
            AddToCart::find($addcart->id)->update([
                'confirmation' => 'approve',
            ]);
            return back();
        }else{
            AddToCart::find($addcart->id)->update([
                'confirmation' => $request->confirmation,
            ]);
            return back();
        }
    }
}
