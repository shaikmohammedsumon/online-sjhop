<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestAuthController extends Controller
{
    public function profile(){
        return view('frontend.auth.profile');
    }
    public function registe(){
        return view('frontend.auth.registe');
    }

    public function registe_post(Request $request){
        // return view('frontend.auth.registe');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => 'required',
            'phone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'created_at' =>now(),
        ]);

        return redirect()->route('gest.login')->with('email',$request->email)->with('password',$request->password);
    }

    public function login(){
        return view('frontend.auth.login');
    }

    public function login_post(Request $request){
        
        $request->validate([
            "*" => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('gest.profile');
        }else{
            return back()->withErrors(['email' => "user is not valid"])->withInput();
        }
    }
}
