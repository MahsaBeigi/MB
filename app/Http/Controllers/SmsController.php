<?php

namespace App\Http\Controllers;

use App\Sms;
use Illuminate\Http\Request;
use SoapClient;

class SmsController extends Controller
{
    public static function sendCode($phone, $msg) {
        $resp = self::send_msg($phone, $msg);

        $sms = new Sms;
        $sms->Phone = $phone;
        $sms->Msg = $msg;
        $sms->SendTime = time();
        $sms->Code = $msg;
        $sms->Status = $resp;
        $sms->save();

        return $sms->Status;
    }

    public static function send_msg($phone, $msg) {
        $client = new SoapClient("http://37.130.202.188/class/sms/wsdlservice/server.php?wsdl");
        $user = "baharcompany110";
        $pass = "baharcompany110";
        $fromNum = "98100020400";
        $toNum = [$phone];
        $pattern_code = 767;
        $input_data = [
            "code" => $msg,
        ];

        $result = $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
        if (is_numeric($result)) {
            return 200;
        } else {
            return 0;
        }
        return $client->SendSMS($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
//        echo $status;
//        $url = "37.130.202.188/services.jspd";
//
//        $rcpt_nm = [$phone];
//        $param = [
//            'uname' => 'baharcompany110',
//            'pass' => 'baharcompany110',
//            'from' => +98100020400,
//            'message' => $msg,
//            'to' => json_encode($rcpt_nm),
//            'op' => 'send',
//        ];
//
//        $handler = curl_init($url);
//        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
//        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
//        $response2 = curl_exec($handler);
//
//        $response2 = json_decode($response2);
//        $res_code = $response2[0];
//        $res_data = $response2[1];
//
//        return $res_data;
    }

    public static function validate_phone($phone) {
        if (preg_match("/^\+98([0-9]{10})$/", $phone, $matches) || preg_match("/^09([0-9]{9})$/", $phone, $matches) || preg_match("/^9([0-9]{9})$/", $phone, $matches)) {
            preg_match("/09([0-9]{9})$/", $phone, $num);

            return $num[0];
        } else {
            return null;
        }
    }
}
