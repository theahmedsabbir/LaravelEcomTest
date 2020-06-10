<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;

use Auth;

class CheckoutsController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy( 'priority', 'asc' )->get();
        return view('Frontend.pages.checkout', compact('payments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'shipping_address' => 'required',
            'payment_method' => 'required',
        ]);


        $transaction_id = "";


        // if transaction is not cash in 
        if( $request->payment_method != "cash_in" ){
            // if payment method is bkash
            if( $request->payment_method == "bkash" ){
                
                if( $request->transaction_bkash == NULL || empty($request->transaction_bkash )){
                   session()->flash('sticky_error', 'You have to provide a transcation id to complete your order');
                   return back();
                }else{
                    $transaction_id = $request->transaction_bkash;
                }
            //else if payment method is rocket
            }else if( $request->payment_method == "rocket" ){
                
                if( $request->transaction_rocket == NULL || empty($request->transaction_rocket )){
                   session()->flash('sticky_error', 'You have to provide a transcation id to complete your order');
                   return back();
                }else{
                    $transaction_id = $request->transaction_rocket;
                }
            }
        }

        $order = new Order;
        $payment_id = Payment::where('short_name', $request->payment_method)->first()->id;

        $order->name = $request->name;
        if(Auth::check()){            
            $order->user_id = Auth::user()->id; 
        }     
        $order->payment_id       = $payment_id;          
        $order->ip_address       = request()->ip();            
        $order->name             = $request->name;                
        $order->phone            = $request->phone;                   
        $order->shipping_address = $request->shipping_address;                       
        $order->email            = $request->email;                          
        $order->message          = $request->message;    

        // dd($transaction_id);                      
        
        if( $transaction_id != ""){
            $order->transaction_id   = $transaction_id;
        }

        $order->save();

        // to blank cart
        foreach( Cart::totalCarts() as $cart ){
            $cart->order_id = $order->id;
            $cart->save();
        }

        session()->flash('success', "Thank You. Your order has been successfully recieved. Please wait untill an admin confirms it. ");

        return redirect()->route('index');

    }
}
