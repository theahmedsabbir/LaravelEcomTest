<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

use Image;
use File;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

	public function index(){
		$categories = Category::orderBy( 'id', 'desc' )->get();
		return view('Backend.pages.category.index', compact('categories'));
	}
	
	public function create(){

		$parent_categories = Category::orderBy( 'id', 'desc' )->where('parent_id', NULL)->get();
		return view('Backend.pages.category.create', compact('parent_categories'));

	}

	public function store(Request $request){


		$this->validate($request, [

			'name' => 'required',
			'image' => 'nullable|image', 


		],[

			'name.required' => 'You must insert a category name',
			'image.image'	=> 'Are you kidding? You have to give a image with jpg, jpeg, or png extention !!',


		]);

		$category = new Category;

		$category->name = $request->name;
		$category->description = $request->description;
		if( $request->parent_id == ''){
			$category->parent_id = NULL;
		}else{
			$category->parent_id = $request->parent_id;
		}



    	// to insert image 

		if( $request->hasFile('image') ){
			
			$main_image          = $request->file('image');
			
			$image_original_name = $main_image->getClientOriginalName();
			
			$image_name = pathinfo( $image_original_name, PATHINFO_FILENAME);
			$image_ext  = pathinfo( $image_original_name, PATHINFO_EXTENSION);
			
			$image_unique    = time() . $image_name . '.' . $image_ext;

			$location = 'images/categories/'.$image_unique;

			Image::make($main_image)->save($location);

			$category->image = $image_unique;
		}

		$category->save();

		session()->flash('success', 'A new Category has been added successfully you dumbo !!!');

    	return redirect()->route('admin.category.index');

	}

	public function edit( $category_id ){

		$c_category = Category::find( $category_id );
		$parent_categories = Category::orderBy('id', 'desc')->where('parent_id', NULL)->get();

		return view('Backend.pages.category.edit', compact('c_category', 'parent_categories'));
	}


	public function update(Request $request, $cat_id){


		$this->validate($request, [

			'name' => 'required',
			'image' => 'nullable|image', 


		],[

			'name.required' => 'You must insert a category name',
			'image.image'	=> 'Are you kidding? You have to give a image with jpg, jpeg, or png extention !!',


		]);

		$category = Category::find( $cat_id );

		$category->name = $request->name;
		$category->description = $request->description;
		if( $request->parent_id == ''){
			$category->parent_id = NULL;
		}else{
			$category->parent_id = $request->parent_id;
		}



    	// to insert image 

		if( $request->hasFile('image') ){
			
			// insert old image 
			if( File::exists('images/categories/'. $category->image ) ){
				File::delete('images/categories/'. $category->image );
			}

			
			// insert new image 
			$main_image          = $request->file('image');
			
			$image_original_name = $main_image->getClientOriginalName();
			
			$image_name = pathinfo( $image_original_name, PATHINFO_FILENAME);
			$image_ext  = pathinfo( $image_original_name, PATHINFO_EXTENSION);
			
			$image_unique    = time() . $image_name . '.' . $image_ext;

			$location = 'images/categories/'.$image_unique;

			Image::make($main_image)->save($location);

			$category->image = $image_unique;
		}

		$category->save();

		session()->flash('success', 'Category Update successfully, Understand !!!');

    	return redirect()->route('admin.category.index');

	}

	public function delete($id){
		$cat_to_del = Category::find( $id );

		if( !is_null($cat_to_del) ){

			// if parent category, then delete all it's sub images and sub-cats
			if( $cat_to_del->parent == NULL ){
				$sub_cats = Category::all()->where('parent_id', $cat_to_del->id);


				foreach ($sub_cats as $sub_cat) {

					// delete all subcategory images 
					$cat_img_loc = 'images/categories/'.$sub_cat->image;

					if( !is_null($sub_cat->image) && File::exists( $cat_img_loc )){
						File::delete( $cat_img_loc );
					}

					// delete all sub categories

					$sub_cat->delete();
				}

			}

			// delete parent category images 

			$cat_img_loc2 = 'images/categories/'.$cat_to_del->image;

			if( !is_null($cat_to_del->image) && File::exists( $cat_img_loc2 )){
				File::delete( $cat_img_loc2 );
			}

			// delete parent category
			$cat_to_del->delete();

			session()->flash("success", "Category has been deleted successfully");
		}

		return back();
	}
}


/*



					echo "<pre>";
					var_dump();
					echo "<pre/>";
