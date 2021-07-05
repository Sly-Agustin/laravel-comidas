<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        if( $request->is('api/*')){
            if (Auth::guard('api')){
                $user = Auth::guard('api')->user();

                if ($user) {
                    $user->api_token = null;
                    $user->save();
                }

                return response()->json(['data' => 'User logged out.'], 200);
            }
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /*public function login(Request $request)
    {
        if( $request->is('api/*')){
            LoginController::validateLogin($request);

            if ($this->attemptLogin($request)) {
                $user = $this->guard()->user();
                $user->generateToken();

                return response()->json([
                    'data' => $user->toArray(),
                ]);
            }

            return $this->sendFailedLoginResponse($request);
        }
    }*/

}
