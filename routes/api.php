<?php

Route::middleware('auth:api')->group( function(){
     /** User's routes */
    
     Route::get('/userinfo', 'UserController@index');


     /** Task's routes */

    Route::get('/friends', 'TaskController@friends');

    Route::get('/tasks', 'TaskController@index');

    Route::post('/task', 'TaskController@store');

    Route::get('/task/{task}', 'TaskController@show');

    Route::patch('/task/{task}/clockin', 'TaskController@clockin');

    Route::patch('/task/{task}/clockout', 'TaskController@clockout');

    Route::patch('/task/{task}', 'TaskController@update');

    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::get('/tasks/count', 'TaskController@getTasks');

    Route::get('/tasks/tasksWithFriends', 'TaskController@tasksWithFriends');



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

}); 