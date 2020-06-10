<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

use Auth;
use App\Models\District;
use App\Models\Division;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){

    	$user = Auth::user();
    	return view( 'Frontend.pages.users.dashboard', compact('user'));
    }

    public function edit(){

    	$user = Auth::user();
    	$divisions = Division::orderBy( 'priority', 'asc' )->get();
        $districts = District::orderBy( 'name', 'asc' )->get();
    	return view( 'Frontend.pages.users.edit', compact('user', 'divisions', 'districts'));
    }

    public function update(Request $request){

    	$user = Auth::user();


    	$this->validate( $request, [    		
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => [ 'string', 'max:30', 'nullable' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,username,'.$user->id ],
            'username' => ['required', 'alpha_dash', 'max:255', 'unique:users,email,'.$user->id ],
            // 'password' => [ 'string', '', 'confirmed'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'phone' => ['required', 'numeric', 'unique:users,phone,'.$user->id ],
            'street_address' => ['string']
    	]);



        $user->first_name       = $request->first_name;
        $user->last_name        = $request->last_name;
        $user->username         = str_slug($request->username);
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        if( !is_null($request->password) || $request->password !="" ){
        	$user->password         = Hash::make($request->password);
        }
        $user->street_address   = $request->street_address;
        $user->division_id      = $request->division_id;
        $user->district_id      = $request->district_id;
        $user->ip_address       = request()->ip();
        $user->shipping_address = $request->shipping_address;

        $user->save();

        session()->flash('success', 'Your profile information has been updated successfully');

    	return back();
    }
}
