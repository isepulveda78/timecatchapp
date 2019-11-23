<?php

Route::middleware('auth:api')->group( function(){

    Route::get('/friends', 'TaskController@friends');

    Route::get('/tasks', 'TaskController@index');

    Route::post('/task', 'TaskController@store');

    Route::get('/task/{task}', 'TaskController@show');

    Route::patch('/task/{task}/clockin', 'TaskController@clockin');

    Route::patch('/task/{task}/clockout', 'TaskController@clockout');

    Route::patch('/task/{task}', 'TaskController@update');

    Route::delete('/task/{task}', 'TaskController@destroy');

}); 