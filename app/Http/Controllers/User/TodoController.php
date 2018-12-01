<?php

namespace App\Http\Controllers\User;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index() {
        $user = Auth::guard('user')->user();
        $options = [
            'title' => ' لیست کارها'.$user->name,
            'buttons' => [
                [
                    'text' => 'ایجاد لیست جدید',
                    'to' => route('user.todo.create'),
                    'icon' => '',
                ],
            ],
        ];

        $header = ['عنوان', 'توضیحات', 'وضعیت ', ''];
        $todo = $user->todo;
        $rows = [];

        foreach ($todo as $item) {
            $row = &$rows[];
            $row[] = ['text' => $item->title];
            $row[] = ['text' => $item->description];

            $row[] = ['text' => $item->get_status($item->status)];

            $row[] = [
                'pivot' => [
                    [
                        'icon' => 'fa fa-newspaper-o',
                        'text' => ' ویرایش ',
                        'button' => false,
                        'btnClass' => 'btn-warning',
                        'url' => route('user.todo.edit', ['todo' => $item->id]),
                    ],
                    [
                        'icon' => 'fa fa-trash-o',
                        'text' => 'حذف',
                        'button' => true,
                        'btnClass' => 'btn-outline-danger',
                        'action' => route('user.todo.delete', ['id' => $item->id]),
                        'id' => $item->id,
                    ],

                ],
            ];
        }

        return view('user.layouts.index', compact('header', 'rows', 'options'));
    }

    public function create() {
        $options = [
            'title' => 'لیست  جدید',
            'method' => 'POST',
            'action' => route('user.todo.store'),
            'fields' => new Todo(),
        ];

        return view('user.todo.create', compact('options'));
    }

    public function store(Request $request) {
        $user = Auth::guard('user')->user();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 1,
            'user_id' => $user->id,
        ]);

        return redirect()->route('user.todoLists');
    }

    public function edit(Todo $todo) {
        $options = [
            'title' => 'ویرایش لیست کارها ',
            'method' => 'PATCH',
            'action' => route('user.todo.patch', [$todo->id]),
            'fields' => $todo,
        ];

        return view('user.todo.create', compact('options'));
    }

    public function update(Request $request, Todo $todo) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $todo->update($request->all());

        return redirect()->route('user.todoLists');
    }

    public function destroy(Todo $todo) {
        $task = $todo->task;
        if (count($task) == 0) {
            $todo->delete();
        }

        return redirect()->route('user.todoLists');
    }
}
