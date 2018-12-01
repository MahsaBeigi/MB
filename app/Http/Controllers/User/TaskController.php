<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $options = [
            'title' => 'وظیفه ها',
            'buttons' => [
                [
                    'text' => 'ایجاد وظیفه جدید',
                    'to' => route('user.task.create'),
                    'icon' => '',
                ],
            ],
        ];
        $user = Auth::guard('user')->user();

        // $task = $user->todo->task;
        $rows = [];

        return $task;
    }
}
