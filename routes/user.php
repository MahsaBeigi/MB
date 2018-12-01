<?php

Route::group(['namespace' => 'User'], function () {
    Route::get('/home', 'HomeController@index')->name('home');//->middleware('verified');


});

