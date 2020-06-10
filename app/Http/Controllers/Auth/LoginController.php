<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Notifications\VerifyRegistration;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = "/admin";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // overriding login function 

    public function login(Request $request)
    {
        $this->validate( $request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // find this user by email

        $user = User::where( 'email', $request->email )->first();

        if ( !is_null( $user )) {
            
            if( $user->status == 1 ){
                // login this user 
                if( Auth::guard('web')->attempt( [ 'email'=>$request->email, 'password'=>$request->password ], $request->filled('remember')) ){
                    // log him now 
                    return redirect()->intended(route('index'));
                }else{
                    session()->flash('sticky_error','Username or Password Mismatch');
                    return back();
                }
            }else{
                // send him a token again 
                if( !is_null($user) ){
                    $user->notify( new VerifyRegistration( $user ));

                    session()->flash('success', 'You need to verify you email. We have sent you a new verification email');
                    return redirect('/');
                }else{
                    // redirect him to login page 
                    session()->flash('sticky_error', 'Please login first');
                    return redirect()->route('login');
                }
            }
        } else {
            // no user found --> go to register 
            
            session()->flash('sticky_error','Data Not Found. Please try again !!');
            return redirect()->route('login');
            
        }

    }
}
