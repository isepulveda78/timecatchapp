<?php

Auth::routes(['verify' => true ]);

Route::get('/logout-manual', function () {
    request()->session()->invalidate();
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/tasks', 'TaskController@alltasks')->name('tasks');

Route::get('/login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

Route::get('/{any}', 'TaskController@alltasks')->where('any', '.*');





