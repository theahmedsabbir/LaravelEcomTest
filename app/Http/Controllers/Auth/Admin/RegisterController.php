<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Models\District;
use App\Models\Division;

use App\Notifications\VerifyRegistration;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * override show registration form.
     *
     * @return void view
     */
    public function showRegistrationForm()
    {

        $divisions = Division::orderBy( 'priority', 'asc' )->get();
        $districts = District::orderBy( 'name', 'asc' )->get();
        return view('auth.register', compact('divisions', 'districts'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => [ 'string', 'max:30', 'nullable' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', '', 'confirmed'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'phone' => ['required', 'numeric'],
            'street_address' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $user = User::create([
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'username'         => str_slug($request->first_name.$request->last_name),
            'phone'            => $request->phone,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'street_address'   => $request->street_address,
            'division_id'      => $request->division_id,
            'district_id'      => $request->district_id,
            'ip_address'       => request()->ip(),
            
            
            'status'           => 0,
            'avatar'           => NULL,
            'shipping_address' => NULL,

            'remember_token'   => str_random(50)
        ]);

        $user->notify(new VerifyRegistration( $user ));

        session()->flash('success', 'A confirmation email has been sent to your link. Please verify your account');

        return redirect('/');
    }
}
