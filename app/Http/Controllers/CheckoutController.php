<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        // return Auth::user()->name . Auth::user()->id;
        if(Auth::check()){
            $user = Auth::user()->id;
            $buyProducts = AddToCart::where('user_id', $user )->latest()->get();
            return view('frontend.checkout.index',compact('buyProducts'));
        }else{
            return view('frontend.checkout.index');
        }
    }


    public function store(Request $request){
        $request->validate([
            'byUser_Id' => 'required',
            'addToCart_ID' => 'required',
            'byUserFirstName' => 'required',
            'byUserLastName' => 'required',
            // 'companyName' => 'required',
            'address' => 'required',
            'town_city' => 'required',
            // 'country' => 'required',
            'postConde' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'description' => 'required',
            'payment_method' => 'required',
        ]);

        if($request->companyName){
            Checkout::create([
                'byUser_Id' => Auth::user()->id,
                'addToCart_ID' => $request->addToCart_ID,
                'byUserFirstName' => $request->byUserFirstName,
                'byUserLastName' => $request->byUserLastName,
                'companyName' => $request->companyName,
                'address' => $request->address,
                'town_city' => $request->town_city,
                'country' => $request->country,
                'postConde' => $request->postConde,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'payment_method' => $request->payment_method,
                'created_at' => now(),
            ]);
            return redirect()->route('cart.index')->with('bySeccess','your product by Seccess');
        }else{
            Checkout::create([
                'byUser_Id' => Auth::user()->id,
                'addToCart_ID' => $request->addToCart_ID,
                'byUserFirstName' => $request->byUserFirstName,
                'byUserLastName' => $request->byUserLastName,
                // 'companyName' => $request->companyName,
                'address' => $request->address,
                'town_city' => $request->town_city,
                'country' => 'Bangladesh',
                'postConde' => $request->postConde,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'payment_method' => $request->payment_method,
                'created_at' => now(),
            ]);
            return redirect()->route('cart.index')->with('bySeccess','your product by Seccess');
        }
    }



}
