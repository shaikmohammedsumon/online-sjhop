<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request, $id){
        $request->validate([
            '*' => 'required',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'review' => $request->review,
            'created_at' => now(),
        ]);
        return back()->with('comment',"Comment Successful");

    }
}
