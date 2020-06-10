<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Cart;

use Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Cart::totalItems() > 0 ){
            return view( 'Frontend.pages.cart' );
        }else{
            return view( 'Frontend.pages.cart-blank' );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [

            'product_id' => 'required'

        ],[

            'product_id.required' => 'Order should include a product'

        ]);

        if( Auth::check() ){
            // search by auth id
            $cart = Cart::where( 'product_id', $request->product_id )
                        ->where('user_id', Auth::id() )
                        ->where('order_id', NULL) 
                        ->first();

        }else{
            // search by ip
            $cart = Cart::where( 'product_id', $request->product_id )
                        ->where('ip_address', request()->ip() )
                        ->where('order_id', NULL) 
                        ->first();
        }


        if( !is_null( $cart ) ){
            // existing cart --> just update product quantity
            $cart->increment( 'product_quantity' );
        }else{
            // a new cart will open
            $cart = new Cart;

            if( Auth::check() ){
                $cart->user_id = Auth::id();
            }

            $cart->product_id = $request->product_id;
            $cart->ip_address = request()->ip(); //127.0.0.1
            $cart->save();
        }

        return json_encode( ['status' => 'success', 'message' => 'Item added to cart', 'totalItems' => Cart::totalItems()] );



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cart = Cart::find($request->id);
        

        if( !is_null($cart) ){

            $cart->product_quantity = $request->product_quantity;
            $cart->save();
        }else{
            session()->flash('sticky_error', 'Sorry !! couldnt update');
            return redirect()->route('cart.index');
        }


        session()->flash('success', 'Item Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cart = Cart::find($request->id);
        

        if( !is_null($cart) ){
            $cart->delete();
        }else{
            session()->flash('sticky_error', 'Sorry !! couldnt delete');
            return redirect()->route('cart.index');
        }

        session()->flash('success', 'Item Updated Successfully');
        return back();
        
    }
}
