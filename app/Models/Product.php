<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [''];

    public function oneUser(){
        return $this->hasOne(User::class,'id','seller_id');
    }
}
