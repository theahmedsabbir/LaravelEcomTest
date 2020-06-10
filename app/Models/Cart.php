<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Cart extends Model
{
    public $fillable = [

            'product_id',
            'user_id',
            'order_id',
            'ip_address',
            'product_quantity'

    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function order(){
    	return $this->belongsTo('App\Models\Order');
    }

    // ##
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    // returning null items in the cart
    public static function totalCarts(){
        

        if( Auth::check() ){
            // search by auth id
            $carts = Cart::where('user_id', Auth::id() )
                          ->where('order_id', NULL )
                          // ->orWhere('ip_address', request()->ip() )
                          ->get();

        }else{
            // search by ip
            $carts = Cart::where( 'ip_address', request()->ip() )
                          ->where('order_id', NULL )
                          ->get();
        }

        return $carts;
    }

    // // returning all items in the cart
    // public static function totalCarts(){
        

    //     if( Auth::check() ){
    //         // search by auth id
    //         $carts = Cart::where('user_id', Auth::id() )
    //                       // ->orWhere('ip_address', request()->ip() )
    //                       ->get();

    //     }else{
    //         // search by ip
    //         $carts = Cart::where( 'ip_address', request()->ip() )
    //                       ->get();
    //     }

    //     return $carts;
    // }

    // counting total items in the cart
    public static function totalItems(){
    	

        if( Auth::check() ){
            // search by auth id
            $carts = Cart::where('user_id', Auth::id() )
                          ->where('order_id', NULL )
                          ->get();

        }else{
            // search by ip
            $carts = Cart::where('ip_address', request()->ip() )
                          ->where('order_id', NULL )
                          ->get();
        }

        $totalItems = 0;

        foreach ($carts as $cart) {
            $totalItems += $cart->product_quantity;
        }

        return $totalItems;
    }
}
