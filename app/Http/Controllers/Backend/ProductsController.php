<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;
use File;

use App\Models\Product;
use App\Models\ProductImage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    public function index(){
    	$products = Product::orderBy( 'id', 'desc' )->get();
    	return view('Backend.pages.product.index')->with( 'products', $products );
    }
    
    public function create(){
    	
    	return view('Backend.pages.product.create');
    }

    public function store(Request $request){

    	// validation 
    	$request->validate([
			'title'       => 'required|max:150',
			'description' => 'required',
			'price'       => 'required|numeric',
			'quantity'    => 'required|numeric',
			'category_id' => 'required|numeric',
			'brand_id'    => 'required|numeric',
	    ]);

    	// product data insertion 		
		$product              = new Product;
		
		$product->title       = $request->title; 
		$product->description = $request->description; 
		$product->price       = $request->price; 
		$product->quantity    = $request->quantity; 
		
		$product->category_id = $request->category_id; 
		$product->brand_id    = $request->brand_id; 
		$product->admin_id    = 1;

    	$product->slug = str_slug($request->title);

    	$product->save();

    	// image insertion
    	if( !is_null($request->product_image) && count($request->product_image) > 0 ){
    		$i = 0;
    		foreach ($request->product_image as $image) {

	    		// making the image through new package
				// $image = $request->file('product_image');
				$i++;
				$img = time(). "-$i" . '.' . $image->getClientOriginalExtension();
				$location = 'images/products/'.$img;
				Image::make($image)->save($location);
				
				$productImage = new ProductImage;
				$productImage->product_id = $product->id;
				$productImage->image = $img;

				$productImage->save();
    			
    		}
    	}

    	return redirect()->route('admin.product.index');
    }
    
    public function edit( $id ){
    	$product = Product::find( $id );
    	return view('Backend.pages.product.edit')->with( 'product', $product );
    }


    public function update(Request $request, $id){

    	// validation 
    	$request->validate([
			'title'       => 'required|max:150',
			'description' => 'required',
			'price'       => 'required|numeric',
			'quantity'    => 'required|numeric',
			'category_id' => 'required|numeric',
			'brand_id'    => 'required|numeric',
	    ]);

    	// product data insertion 		
		$product              = Product::find( $id );
		
		$product->title       = $request->title; 
		$product->description = $request->description; 
		$product->price       = $request->price; 
		$product->quantity    = $request->quantity; 
		
		$product->category_id = $request->category_id; 
		$product->brand_id    = $request->brand_id; 
		
    	$product->save();

    	return redirect()->route('admin.product.index');
    }

    public function delete( $id ){

    	$delete_product = Product::find($id);

    	if( !is_null($delete_product) ){
    		// find images of this product // if any

    		// dd(count($delete_product->images)> 0);
    		if(isset($delete_product->images) && count($delete_product->images) > 0 ){
    			foreach ($delete_product->images as $image) {
    				// delete each image from database 
    				$image->delete();
    				// deleta each images from file location 
    				if( File::exists('images/products/'.$image->image )){
    					File::delete('images/products/'.$image->image );
    				}
    			}
    		}
    		// then delete product
    		$delete_product->delete();
    	}

    	session()->flash( 'success', 'Product deleted successfully' );
    	return back();
    }
}


/*


			echo "<pre>";
			print_r();
			echo "</pre>";



    	// image insertion
    	if( count($request->product_image) > 0 ){
    		$i = 0;
    		foreach ($request->product_image as $image) {

	    		// making the image through new package
				// $image = $request->file('product_image');
				$i++;
				$img = time(). "-$i" . '.' . $image->getClientOriginalExtension();
				$location = 'images/products/'.$img;
				Image::make($image)->save($location);
				
				$productImage = new ProductImage;
				$productImage->product_id = $product->id;
				$productImage->image = $img;

				$productImage->save();
    			
    		}
    	}

