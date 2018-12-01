<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberController extends Controller
{
    public static function generateRandom($digits) {
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while ($i < $digits) {
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }

        return $pin;
    }

    public static function validate_phone($phone) {
        if (preg_match("/^\+98([0-9]{10})$/", $phone, $matches) || preg_match("/^09([0-9]{9})$/", $phone, $matches) || preg_match("/^9([0-9]{9})$/", $phone, $matches)) {
            preg_match("/09([0-9]{9})$/", $phone, $num);

            return $num[0];
        } else {
            return null;
        }
    }

    public static function toEnglish($str) {
        return str_replace(['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰'], ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], $str);
    }
}
