<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Slider;

class PagesController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('priority', 'asc')->get();
    	$products = Product::orderBy('id', 'desc')->paginate(3);
    	return view('Frontend.pages.index', compact('products', 'sliders'));
    }    

    public function contact(){
    	return view('Frontend.pages.contact');        
    } 

    public function search(Request $request){
    	$search = $request->search;

    	$products = Product::orWhere('title', 'like', '%'.$search.'%' ) 
    					->orWhere('description', 'like', '%'.$search.'%')  
    					->orWhere('price', 'like', '%'.$search.'%')  
    					->orWhere('quantity', 'like', '%'.$search.'%')  
    					->orWhere('slug', 'like', '%'.$search.'%')  
    					->orderBy('id', 'desc')
    					->paginate(3);
    					
    	return view('Frontend.pages.products.search', compact('products', 'search'));
    }
}
