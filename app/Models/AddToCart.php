<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    protected $guarded = [''];

    public function addCurtProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function byproductUserDetails(){
        return $this->hasOne(Checkout::class,'byUser_Id','user_id');
    }

}
