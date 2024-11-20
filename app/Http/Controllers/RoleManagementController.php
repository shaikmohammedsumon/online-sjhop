<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function manager_index(){
        $users = User::where('role','maneger')->get();
        return view('dashboard.rolemanagement.manager',compact('users'));
    }


    public function manager_role(Request $request, $id){
        $user = User::where('id',$id)->first();
        
        if($user->role == 'maneger'){
            User::find($user->id)->update([
                'role' =>$request->role,
                'updated_at' =>now(),
            ]);
            return back()->with('role_update',"User To $request->role update Successful");
        }
    }



    public function seller_index(){
        $users = User::where('role','seller')->get();
        return view('dashboard.rolemanagement.seller',compact('users'));
    }


    public function seller_role(Request $request, $id){

        $user = User::where('id',$id)->first();

        if($user->role == 'seller'){
            User::find($user->id)->update([
                'role' =>$request->role,
                'updated_at' =>now(),
            ]);
            return back()->with('role_update',"User To $request->role update Successful");
        }
    }
    public function index(){
        $users = User::where('role','user')->get();
        return view('dashboard.rolemanagement.user',compact('users'));
    }


    public function user_role(Request $request, $id){

        $user = User::where('id',$id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'role' =>$request->role,
                'updated_at' =>now(),
            ]);
            return back()->with('role_update',"User To $request->role update Successful");
        }
    }
}
