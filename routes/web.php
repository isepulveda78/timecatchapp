<?php

Auth::routes(['verify' => true ]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/tasks', 'TaskController@alltasks')->name('tasks');

Route::get('/login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

Route::get('/{any}', 'TaskController@alltasks')->where('any', '.*');





