<?php

namespace App\Http\Controllers;

use App\CodeRegistering;
use Illuminate\Http\Request;
use App\Http\Controllers\SmsController as sms;

class CodeRegisteringController extends Controller
{
    public static function isAvailable($phone) {
        $user = CodeRegistering::where("phone", $phone)->first();
        if ((time() - (int)$user->sentDate) < 60) {
            if ((int)$user->times <= 1) {
                return [true, null];
            } else {
                return [false, 60 - (time() - (int)$user->sentDate)];
            }
        }

        return [true, null];
    }

    public static function setUpCode($phone) {
        //It must send msg too , using Sms model
        if (!self::issetPhone($phone)) {
            $user = new CodeRegistering;
            $user->phone = $phone;
        } else {
            $user = CodeRegistering::where("phone", $phone)->first();
        }
        if (!self::issetPhone($phone)) {
            $user->times = -1;
        }
        $user->times = $user->times + 1;
        $user->code = mt_rand(10000, 99999);
        $user->sendDate = time();
        $msg = (string)$user->code;
        //return Sms::sendCode($phone, $msg);
        if (Sms::sendCode($phone, $msg)) {
            $user->save();

            return true;
        } else {
            return false;
        }
    }

    public static function issetPhone($phone) {
        if (CodeRegistering::where("phone", $phone)->count() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function verify($phone, $code) {
        if ($phone == null) {
            return response()->json(['status' => 502, 'Message' => 'Bad Request'], 200);
        }
        $user = CodeRegistering::where("phone", $phone)->first();
        if ($user == null) {
            return [false, 2];
        }
        if ((time() - (int)$user->sendDate) > 1000) {
            return [false, 1];
        }
        if ($user->code == $code) {
            return [true, 0];
        }

        return [false, 0];
    }
}
