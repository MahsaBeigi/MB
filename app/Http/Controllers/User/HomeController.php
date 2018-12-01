<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
//    public function __construct() {
//        $this->middleware(['auth', 'Verified']);
//    }

    public function index() {
        $user = Auth::guard('user')->user();

        $response = [
            'method' => 'PATCH',
            'user' => $user,
        ];

        return view('user.home.details', ['response' => $response]);
    }
}
