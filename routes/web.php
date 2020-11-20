<?php

Route::get('/', 'User\HomeController@services');
Route::get('services', 'User\HomeController@services');
Route::get('traffics', 'User\HomeController@traffic');
Route::get('leads', 'User\HomeController@leads');

Auth::routes(['login' => true]);
Auth::routes(['register' => true]);
	
Route::group(['prefix' => '','as' => 'user.' ,'namespace' => 'User','middleware' => ['auth']], function () {
   
});


