<?php

Route::group(['namespace' => 'User'], function () {
    Route::get('/home', 'HomeController@index')->name('home');//->middleware('verified');

    Route::get('todoLists', 'TodoController@index')->name('todoLists');
    Route::get('todoList/create', 'TodoController@create')->name('todo.create');
    Route::post('todoList', 'TodoController@store')->name('todo.store');
    Route::get('todoList/{todo}/edit', 'TodoController@edit')->name('todo.edit');
    Route::patch('todoList/{todo}', 'TodoController@update')->name('todo.patch');
    // Route::delete('todoList/{id}', 'TodoController@destroy')->name('todo.delete');
    Route::get('todoList/{id}', 'TodoController@destroy')->name('todo.delete');

    Route::get('tasks', 'TaskController@index')->name('Tasks');
    Route::get('task/create', 'TaskController@create')->name('task.create');
    Route::post('task', 'TaskController@store')->name('task.store');
    Route::get('task/{task}/edit', 'TaskController@edit')->name('task.edit');
    Route::patch('task/{task}', 'TaskController@update')->name('task.patch');
    Route::delete('task/{task}', 'TaskController@destroy')->name('task.delete');
});

