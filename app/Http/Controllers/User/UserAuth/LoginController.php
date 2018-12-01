<?php

namespace App\Http\Controllers\User\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;

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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('user.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() {
        return view('user.auth.login');
    }

    public function login(Request $request) {
        // Validate the registering data
        if (!$request->has('url')) {
            $this->validate($request, [
                'username' => 'required|string',
                'password' => 'required|string',
            ]);
        }

        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['email' => $request->username, 'password' => $request->password])) {
            // return Auth::guard('userpanel')->user()->username;
            if ($request->has('url')) {
                return redirect()->intended($request->url);
            }

            // if successful, then redirect to their intended location
            return redirect()->intended($this->redirectTo);
        }

        return back()->with('error', 'نام کاربری یا گذرواژه اشتباه است');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() {
        return Auth::guard('user');
    }

    public function logoutToPath() {
        Auth::logout('user');

        return 'user/login';
    }
}
