<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Brand;

use Image;
use File;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
	public function index(){
		$brands = Brand::orderBy( 'id', 'desc' )->get();
		return view('Backend.pages.brand.index', compact('brands'));
	}
	
	public function create(){

		return view('Backend.pages.brand.create');
	}

	public function store(Request $request){


		$this->validate($request, [

			'name' => 'required',
			'image' => 'nullable|image', 


		],[

			'name.required' => 'You must insert a brand name',
			'image.image'	=> 'Are you kidding? You have to give a image with jpg, jpeg, or png extention !!',
		]);


		$brand = new Brand;

		$brand->name = $request->name;
		$brand->description = $request->description;


    	// to insert image 

		if( $request->hasFile('image') ){
			
			$main_image          = $request->file('image');
			
			$image_original_name = $main_image->getClientOriginalName();
			
			$image_name = pathinfo( $image_original_name, PATHINFO_FILENAME);
			$image_ext  = pathinfo( $image_original_name, PATHINFO_EXTENSION);
			
			$image_unique    = time() . $image_name . '.' . $image_ext;

			$location = 'images/brands/'.$image_unique;

			Image::make($main_image)->save($location);

			$brand->image = $image_unique;
		}

		$brand->save();

		session()->flash('success', 'A new Brand has been added successfully you dumbo !!!');

    	return redirect()->route('admin.brand.index');

	}

	public function edit( $brand_id ){

		$c_brand = Brand::find( $brand_id );

		return view('Backend.pages.brand.edit', compact('c_brand'));
	}


	public function update(Request $request, $brand_id){


		$this->validate($request, [

			'name' => 'required',
			'image' => 'nullable|image', 

		],[

			'name.required' => 'You must insert a brand name',
			'image.image'	=> 'Are you kidding? You have to give a image with jpg, jpeg, or png extention !!',

		]);


		$brand = Brand::find( $brand_id );

		$brand->name = $request->name;
		$brand->description = $request->description;


    	// to insert image 

		if( $request->hasFile('image') ){
			
			// insert old image 
			if( File::exists('images/brands/'. $brand->image ) ){
				File::delete('images/brands/'. $brand->image );
			}

			
			// insert new image 
			$main_image          = $request->file('image');
			
			$image_original_name = $main_image->getClientOriginalName();
			
			$image_name = pathinfo( $image_original_name, PATHINFO_FILENAME);
			$image_ext  = pathinfo( $image_original_name, PATHINFO_EXTENSION);
			
			$image_unique    = time() . $image_name . '.' . $image_ext;

			$location = 'images/brands/'.$image_unique;

			Image::make($main_image)->save($location);

			$brand->image = $image_unique;
		}

		$brand->save();

		session()->flash('success', 'Brand Update successfully, Understand !!!');

    	return redirect()->route('admin.brand.index');

	}

	public function delete($id){
		$brand_del = Brand::find( $id );

		if( !is_null($brand_del) ){

			// delete parent brand images 

			$brandImgLoc = 'images/brands/'.$brand_del->image;

			if( !is_null($brand_del->image) && File::exists( $brandImgLoc )){
				File::delete( $brandImgLoc );
			}

			// delete parent brand
			$brand_del->delete();

			session()->flash("success", "Brand has been deleted successfully");
		}

		return back();
	}
}


/*



					echo "<pre>";
					var_dump();
					echo "<pre/>";
