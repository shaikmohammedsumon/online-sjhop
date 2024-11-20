<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    protected $guarded = [''];

    public function addCurtProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    // public function 

}
