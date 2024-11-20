<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{

    public function view(){
        return view('dashboard.profile.index');
    }


    public function name_update(Request $request){
        $old_name = Auth::user()->name;
        $request->validate([
            'name' => 'required',
        ]);

        User::find(Auth::user()->id)->update([
            'name' =>$request->name,
            'updated_at' => now(),
        ]);
        return back()->with('name_update',"Name update Successful old name is $old_name and new name is $request->name");
    }


    public function password_update(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',

        ]);

        if(Hash::check($request->old_password,Auth::user()->password)){
            User::find(Auth::user()->id)->update([
                'password' =>$request->password,
                'updated_at' => now(),
            ]);
            return back()->with('name_update',"password update Successful");
        }else{
            return back()->withErrors(['old_password' => "Old Password dous't match"])->withInput();
        }
    }

    public function image_update( Request $request){
        $manager = new ImageManager(new Driver());
        $user = Auth::user()->image;

        $request->validate([
            'image' => 'required|image',
        ]);


        if(Auth::user()->image == 'defualt.jpg'){

            $newName = Auth::user()->name.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/upload/profile/'.$newName));

            User::find(Auth::user()->id)->update([
                'image' => $newName,
                'updated_at' => now(),
            ]);

            return back()->with('name_update',"profile Image update Successful");

        }else{

            $oldPath = base_path('public/upload/profile/'.$user);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }

            $newName = Auth::user()->name.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/upload/profile/'.$newName));

            User::find(Auth::user()->id)->update([
                'image' => $newName,
                'updated_at' => now(),
            ]);

            return back()->with('name_update',"profile Image update Successful");
        }

    }







}
