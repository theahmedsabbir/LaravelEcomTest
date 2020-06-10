<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;

use App\Models\Product;
use App\Models\ProductImage;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
    	return view('Backend.pages.index');
    }
}






























/*


			echo "<pre>";
			print_r();
			echo "</pre>";

