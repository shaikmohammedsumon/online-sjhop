<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [''];

    public function oneProduct(){
        return $this->hasOne(Product::class,'category','title');
    }
}
