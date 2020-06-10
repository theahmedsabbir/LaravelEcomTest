<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
            'user_id',
            'payment_id',
            'ip_address',
            'name',
            'phone',
            'shipping_address',
            'email',
            'message',
            'is_paid',
            'is_completed',
            'is_seen_by_admin',
            'transaction_id',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    // ##
    public function carts(){
    	return $this->hasMany('App\Models\Cart');
    }

    // ##
    public function payment(){
        return $this->belongsTo('App\Models\Payment');
    }
}
