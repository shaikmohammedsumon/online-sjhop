<?php

namespace App\Http\Controllers\Frontend;

use App\Models\AddToCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart_view(){
        $user = Auth::user()->id;
        $buyProducts = AddToCart::where('user_id', $user )->latest()->get();
        return view('frontend.cart.index',compact('buyProducts'));
    }


    public function delete($id){
        $delete = AddToCart::where('id',$id)->first();
        AddToCart::find($delete->id)->delete();
        return back()->with('delete',"this Product is Deleted");
    }

    public function quantityUp( $id){
        $AddToCart = AddToCart::where('id',$id)->first();
        $product = Product::where('id',$AddToCart->product_id)->first();


        AddToCart::find($AddToCart->id)->update([
            'quantity' => $AddToCart->quantity + '1',
            'total' => $AddToCart->total + $product->price,
            'updated_at' =>now(),
        ]);
        return back();

    }

    public function quantityDown($id){
        $AddToCart = AddToCart::where('id',$id)->first();
        $product = Product::where('id',$AddToCart->product_id)->first();

        if($AddToCart->quantity == '1'){
            return back();
        }else{
            AddToCart::find($AddToCart->id)->update([
                'quantity' => $AddToCart->quantity - '1',
                'total' => $AddToCart->total - $product->price,
                'updated_at' =>now(),
            ]);
            return back();

        }
    }
}
