<?php

/** Users table route */
Route::prefix('users')->group(function () {
    Route::post('/create', 'UserApiController@createUser');
    Route::get('/', 'UserApiController@getAllUsers');
    Route::get('/details/{iUserId}', 'UserApiController@getUser');
    Route::get('/count', 'UserApiController@getAllCountUsers');
    Route::post('/update/{iUserId}', 'UserApiController@updateUser');
    Route::post('/delete/{iUserId}', 'UserApiController@deleteUser');
});
