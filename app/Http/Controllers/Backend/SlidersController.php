<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Slider;

use Image;
use File;


class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

	public function index(){
		$sliders = Slider::orderBy( 'priority', 'asc' )->get();
		return view('Backend.pages.slider.index', compact('sliders'));
	}
	
	// public function create(){

	// 	return view('Backend.pages.slider.create');
	// }

	public function store(Request $request){


		$this->validate($request, [
			
			'title' => 'required',
			'image' => 'required|image',
			'priority' => 'required|numeric',
			'button_link' => 'nullable|url',


		]);


		$slider = new Slider;

		$slider->title       = $request->title;
		$slider->button_text = $request->button_text;
		$slider->button_link = $request->button_link;
		$slider->priority    = $request->priority;

    	// to insert image 

		if( $request->hasFile('image') ){
			
			$main_image          = $request->file('image');
			
			$image_original_name = $main_image->getClientOriginalName();
			
			$image_name = pathinfo( $image_original_name, PATHINFO_FILENAME);
			$image_ext  = pathinfo( $image_original_name, PATHINFO_EXTENSION);
			
			$image_unique    = time() . $image_name . '.' . $image_ext;


			$location = 'images/sliders/'.$image_unique;
			// dd($location);

			Image::make($main_image)->save($location);

			$slider->image = $image_unique;
		}

		$slider->save();

		session()->flash('success', 'A new Slider has been added successfully!!!');

    	return redirect()->route('admin.slider.index');

	}

	public function update(Request $request, $slider_id){


		$this->validate($request, [
			
			'title' => 'required',
			'image' => 'nullable|image',
			'priority' => 'required|numeric',
			'button_link' => 'nullable|url',


		]);


		$slider = Slider::find($slider_id);

		$slider->title       = $request->title;
		$slider->button_text = $request->button_text;
		$slider->button_link = $request->button_link;
		$slider->priority    = $request->priority;

    	// to insert image 

		if( $request->hasFile('image') ){

			// delete old slider image 
			if( File::exists( 'images/sliders/'.$slider->image )){
				File::delete( 'images/sliders/'.$slider->image );
			}
			
			$main_image          = $request->file('image');
			
			$image_original_name = $main_image->getClientOriginalName();
			
			$image_name = pathinfo( $image_original_name, PATHINFO_FILENAME);
			$image_ext  = pathinfo( $image_original_name, PATHINFO_EXTENSION);
			
			$image_unique    = time() . $image_name . '.' . $image_ext;

			$location = 'images/sliders/'.$image_unique;

			Image::make($main_image)->save($location);

			$slider->image = $image_unique;
		}

		$slider->save();

		session()->flash('success', 'Slider has been updated successfully!!!');

    	return redirect()->route('admin.slider.index');

	}

	public function delete($id){
		
		$slider = Slider::find( $id );

		if( !is_null( $slider ) ){

			// delete images of this slider

			if( File::exists( 'images/sliders/'.$slider->image )){
				File::delete( 'images/sliders/'.$slider->image );
			}

			// delete slider
			$slider->delete();

			session()->flash("success", "Slider has been deleted successfully");
		}

		return back();
	}
}



