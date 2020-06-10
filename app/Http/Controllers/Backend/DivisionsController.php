<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Division;
use App\Models\District;

class DivisionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

	public function index(){
		$divisions = Division::orderBy( 'priority', 'asc' )->get();
		return view('Backend.pages.division.index', compact('divisions'));
	}
	
	public function create(){

		return view('Backend.pages.division.create');
	}

	public function store(Request $request){


		$this->validate($request, [

			'name' => 'required',
			'priority' => 'required|numeric',


		],[

			'name.required' => 'You must insert a division name',
			'priority.required' => 'You must insert a division priority',
		]);


		$division = new Division;

		$division->name        = $request->name;
		$division->priority = $request->priority;

		$division->save();

		session()->flash('success', 'A new Division has been added successfully!!!');

    	return redirect()->route('admin.division.index');

	}

	public function edit( $division_id ){

		$c_division = Division::find( $division_id );

		if ( !is_null($c_division) ) {
			return view('Backend.pages.division.edit', compact('c_division'));
		} else {
			return redirect()->route('admin.division.index');
		}
	}


	public function update(Request $request, $division_id){
		
		$this->validate($request, [

			'name' => 'required',
			'priority' => 'required|numeric',


		],[

			'name.required' => 'You must insert a division name',
			'priority.required' => 'You must insert a division priority',
		]);


		$division = Division::find($division_id);

		$division->name        = $request->name;
		$division->priority = $request->priority;

		$division->save();

		session()->flash('success', 'Division updated successfully!!!');

    	return redirect()->route('admin.division.index');

	}

	public function delete($id){
		$division_del = Division::find( $id );

		if( !is_null($division_del) ){

			// delete districts under these division

			$child_districts = District::where('division_id', $division_del->id )->get();

			foreach ($child_districts as $child_district) {
				$child_district->delete();
			}

			// delete division
			$division_del->delete();

			session()->flash("success", "Division has been deleted successfully");
		}

		return back();
	}
}



