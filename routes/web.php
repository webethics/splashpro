<?php


Route::get('/', 'User\HomeController@home_page');
Route::get('services', 'User\HomeController@services');
Route::get('traffic', 'User\HomeController@traffic');
Route::get('leads', 'User\HomeController@leads');
Route::get('error', 'User\HomeController@error');
Route::get('vseo', 'User\HomeController@vseo');


Route::get('/{token}', 'User\HomeController@home_page');
Route::get('services/{token}', 'User\HomeController@services');
Route::get('traffic/{token}', 'User\HomeController@traffic');
Route::get('leads/{token}', 'User\HomeController@leads');
Route::get('vseo/{token}', 'User\HomeController@vseo');
Route::get('error', 'User\HomeController@error');

Route::post('update-plan','User\HomeController@updatePlan');

/* 
Auth::routes(['login' => true]);
Auth::routes(['register' => true]);

 */