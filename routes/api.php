<?php

Route::middleware('auth:api')->group( function(){
    /** Task Messages */
    Route::post('/postmessage', 'TaskMessageController@postMessage');

    Route::post('/like', 'TaskMessageController@getLike');


     /** User's routes */
    
     Route::get('/userinfo', 'UserController@index');

     Route::get('/user_tasks/{user}', 'UserController@tasksCount');

     Route::get('/user/{user}', 'UserController@show');

     Route::patch('/user/{user}', 'UserController@update');

     Route::delete('/user/{user}', 'UserController@destroy');


     /** Task's routes */

    Route::get('/friends', 'TaskController@friends');

    Route::get('/tasks', 'TaskController@index');

    Route::post('/task', 'TaskController@store');

    Route::get('/task/{task}', 'TaskController@show');

    Route::get('/task/{task}/clocks', 'TaskController@clocks');

    Route::patch('/task/{task}', 'TaskController@update');

    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::get('/tasks/count', 'TaskController@getTasks');

    Route::get('/tasks/tasksWithFriends', 'TaskController@tasksWithFriends');

    Route::get('/task/taskWithFriends/{task}', 'TaskController@taskWithFriends');

    Route::patch('/task/calculate_task/{task}', 'TaskController@calculateTime');

    /** Project's routes */

    Route::get('/project_tasks', 'ProjectController@userTasks');

    Route::get('/projects', 'ProjectController@index');

    Route::post('/project', 'ProjectController@store');

    Route::get('/project/{project}', 'ProjectController@show');

    Route::patch('/project/{project}', 'ProjectController@update');

    Route::delete('/project/{project}', 'ProjectController@destroy');

    Route::get('/projects/count', 'ProjectController@getProjects');

    Route::patch('/projects/{project}/calculate', 'ProjectController@calculateTime');

    Route::get('/projects/tasksWithFriends', 'ProjectController@tasksWithFriends');

    /** Clock routes */

    Route::get('/clocks', 'ClockController@index');

    Route::post('/clock', 'ClockController@store');

    Route::patch('/clock/{clock}', 'ClockController@update');

    Route::delete('/clock/{clock}', 'ClockController@destroy');

}); 