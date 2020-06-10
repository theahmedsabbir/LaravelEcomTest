<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\District;
use App\Models\Division;

class DistrictsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
	public function index(){
		$districts = District::orderBy( 'name', 'asc' )->get();
		return view('Backend.pages.district.index', compact('districts'));
	}
	
	public function create(){

		$divisions = Division::orderBy('priority', 'asc')->get();
		return view('Backend.pages.district.create', compact('divisions'));
	}

	public function store(Request $request){


		$this->validate($request, [

			'name' => 'required',
			'division_id' => 'required|numeric',


		],[

			'name.required' => 'You must insert a district name',
			'division_id.required' => 'You must insert a district id',
		]);


		$district = new District;

		$district->name        = $request->name;
		$district->division_id = $request->division_id;

		$district->save();

		session()->flash('success', 'A new District has been added successfully!!!');

    	return redirect()->route('admin.district.index');

	}

	public function edit( $district_id ){

		$divisions = Division::orderBy('priority', 'asc')->get();
		$c_district = District::find( $district_id );

		if ( !is_null($c_district) ) {
			return view('Backend.pages.district.edit', compact('c_district', 'divisions'));
		} else {
			return redirect()->route('admin.district.index');
		}
	}


	public function update(Request $request, $district_id){


		$this->validate($request, [

			'name'        => 'required',
			'division_id' => 'required|numeric',


		],[

			'name.required'        => 'You must insert a district name',
			'division_id.required' => 'You must insert a district id',
		]);


		$district = District::find( $district_id );

		$district->name        = $request->name;
		$district->division_id = $request->division_id;

		$district->save();

		session()->flash('success', 'District Updated successfully!!!');

    	return redirect()->route('admin.district.index');

	}

	public function delete($id){
		$district_del = District::find( $id );

		if( !is_null($district_del) ){

			// delete district
			$district_del->delete();

			session()->flash("success", "District has been deleted successfully");
		}

		return back();
	}
}



