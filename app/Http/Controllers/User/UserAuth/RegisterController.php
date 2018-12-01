<?php

namespace App\Http\Controllers\User\UserAuth;

use App\User;
use Illuminate\Http\Request;
use Jrean\UserVerification\UserVerification;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NumberController as N;
use App\Http\Controllers\CodeRegisteringController as CodeRegistering;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/User/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('user.guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request) {
        //        UserVerification::generate($user);
//        UserVerification::send($user, 'My Custom E-mail Subject');
        $this->validator($request->all())->validate();
        //
        $phone = $request->phone;
        $code = $request->code;
        $pass = $request->password;

        $register = self::registerCodeVerify($phone, $code, $pass);

        if ($register['status'] == 200) {
            $user=$this->create($request->all());

            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $pass], $request->remember)) {
                // if successful, then redirect to their intended location
                return redirect()->intended('/user/home');
            }
            $message = $register['Message'];

            return redirect()->route('users.login')->with('error', $message);
            // with('message', $register['response']['Message'])->with('phone', $register['response']['phone'])->with('password', $register['response']['password']);
        } else {
            $error = $register['Message'];

            return back()->with('error', $error);
        }
        // return back()->withAlert('ثبت نام با موفقیت انجام شد');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm() {
        return view('user.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() {
        return Auth::guard('user');
    }

    public function sendRegisterCode($phone) {
        if (N::validate_phone($phone) == null) {
            return response()->json(['status' => 500, 'Message' => 'شماره تلفن نامعتبر است'], 200);
        } else {
            $phone = N::validate_phone($phone);
        }

        if (User::issetUser($phone)) {
            $user = User::where('phone', $phone)->first();
            if ($user->isBlocked()) {
                return response()->json([
                    'status' => 333,
                    'Message' => 'شماره تلفن درسیستم مسدود شده است با پشتیبانی تماس بگیرید',
                    'reason' => $user->block_reason,
                ]);
            }

            //login ----------------------------------------------------

            if (CodeRegistering::issetPhone($phone)) {
                if (CodeRegistering::isAvailable($phone)[0]) {
                    //return CodeRegistering::setupCode($phone);
                    if (CodeRegistering::setupCode($phone)) {
                        return response()->json(['status' => 200, 'Message' => 'پیام با موفقیت ارسال شد'], 200);
                    } else {
                        return response()->json(['status' => 0, 'Message' => 'مشکل در ارسال پیام دوباره تلاش کنید'], 200);
                    }
                } else {
                    return response()->json(['status' => 429, 'Message' => 'دوباره تلاش کنید', 'time' => CodeRegistering::isAvailable($phone)[1]], 200);
                }
            } else {
                if (CodeRegistering::setupCode($phone)) {
                    //return CodeRegistering::setupCode($phone);

                    return response()->json(['status' => 200, 'Message' => 'پیام با موفقیت ارسال شد'], 200);
                } else {
                    return response()->json(['status' => 0, 'Message' => 'مشکل در ارسال پیام دوباره تلاش کنید'], 200);
                }
            }
            //------------------------------------------------login
        }

        if (CodeRegistering::issetPhone($phone)) {
            if (CodeRegistering::isAvailable($phone)[0]) {
                //return CodeRegistering::setupCode($phone);
                if (CodeRegistering::setupCode($phone)) {
                    return response()->json(['status' => 200, 'Message' => 'پیام با موفقیت ارسال شد '], 200);
                } else {
                    return response()->json(['status' => 0, 'Message' => 'مشکل در ارسال پیامک دوباره تلاش کنید'], 200);
                }
            } else {
                return response()->json(['status' => 429, 'Message' => 'دوباره تلاش کنید', 'time' => CodeRegistering::isAvailable($phone)[1]], 200);
            }
        } else {
            //return CodeRegistering::setupCode($phone);
            if (CodeRegistering::setupCode($phone)) {
                return response()->json(['status' => 200, 'Message' => 'پیام با موفقیت ارسال شد '], 200);
            } else {
                return response()->json(['status' => 0, 'Message' => 'مشکل در ارسال پیامک دوباره تلاش کنید'], 200);
            }
        }
    }

    public static function registerCodeVerify($phone, $code, $password) {
        /*if ($phone == null || Auth::guard('user')->user()->check()) {
            return response()->json(['status' => 502, 'Message' => 'Bad Request'], 200);
        }*/

        $verify = CodeRegistering::verify($phone, $code);
        if ($verify[0]) {
            $Message = 'ثبت نام شما با موفقیت انجام شد.';

            return ['status' => 200, 'Message' => $Message];
            // Auth::guard("user")->login($user, true);

            // return response()->json(['status' => 200, 'Message' => 'Verify successfully', 'token' => $user->api_token], 200);
        } else {
            if ($verify[1] == 0) {
                return ['status' => 0, 'Message' => 'کد وارد شده اشتباه است'];
            } else {
                if ($verify[1] == 1) {
                    return ['status' => 0, 'Message' => 'زمان ارسال کد به پایان رسیده دوباره تلاش کنید .'];
                }
            }
        }
    }
}
