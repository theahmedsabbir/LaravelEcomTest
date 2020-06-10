<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent(){
    	return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    
    public function products(){
    	return $this->hasMany( Product::class );
    }


    public static function ParentOrNotCategory( $category_id , $parent_id ){
    	$categories = Category::where( 'id', $category_id )->where( 'parent_id', $parent_id )->get();

    	$count = count($categories);

    	if( $count > 0 ){
    		return true;
    	}else{
    		return false;
    	}
    }
}
