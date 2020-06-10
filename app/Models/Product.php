<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function images(){
    	return $this->hasMany('App\Models\ProductImage');
    }
    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }
    public function brand(){
    	return $this->belongsTo('App\Models\Brand');
    }
}
