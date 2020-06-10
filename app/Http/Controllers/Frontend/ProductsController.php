<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductsController extends Controller
{      
	public function index(){
		$products = \App\Models\Product::orderBy('id', 'desc')->paginate(3);
		return view('Frontend.pages.products.index')->with('products', $products);
	}    

	public function show( $slug ){
		$product = Product::where( 'slug', $slug )->first();

		if( !is_null( $product )){
			return view( 'Frontend.pages.products.show', compact('product') );
		}else{
			session()->flash( 'errors', 'Sorry!! No product found in this URL');
			return redirect()->route( 'products' );
		}
	}
}
// end of class
