<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [''];

    public function userComment(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
