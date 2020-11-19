<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([ 'prefix' => 'admin','middleware' => 'admin','namespace' => 'Admin'], function () {

	Route::get('/','AdminController@index');
	
	Route::get('logout', 'AdminController@logout');
	
	Route::post('user/enable-disable',array('uses'=>'UsersController@enableDisableUser'));
	Route::post('user/delete_user/{id}', 'UsersController@delete_user')->name('users.delete');
	
	//Dashboard
	Route::get('dashboard',array('uses'=>'DashboardController@index'));
	
	Route::post('update-profile/{user_id}', 'UsersController@profileUpdate');//UPDATE USER
	Route::post('update-basic-profile/{user_id}', 'UsersController@updateBasicProfile');//UPDATE Basic USER
	Route::post('reset-password/{user_id}', 'UsersController@passwordUpdate');
	//roles
	Route::get('roles',array('uses'=>'RolesController@roles'));
	Route::post('roles/edit/{request_id}', 'RolesController@roles_edit'); //Edit request
	Route::get('role/create/',array('uses'=>'RolesController@role_create')); //Edit User
	Route::post('role/delete_role/{request_id}',array('uses'=>'RolesController@role_delete')); //Edit User
	Route::post('/create-role-permissions/',array('uses'=>'RolesController@role_permission_create')); //Edit User
	Route::post('/update-role-permissions/',array('uses'=>'RolesController@role_permission_update')); //Edit User
	
	Route::post('uploads/logo/{request_id}',array('uses'=>'SettingsController@uploadLogo'));
	Route::post('fetch/logo/{request_id}',array('uses'=>'SettingsController@getLogo'));
	Route::post('delete/logo/{request_id}',array('uses'=>'SettingsController@deleteLogo'));
	
	
	//cms pages
	Route::get('cms-pages',array('uses'=>'CmsController@index'));
	Route::get('cms-pages/edit/{request_id}', 'CmsController@cms_page_edit'); //Edit request
	Route::get('cms-pages/create/',array('uses'=>'CmsController@cms_page_create')); //Edit User
	Route::post('cms-pages/delete_page/{request_id}',array('uses'=>'CmsController@page_delete')); //Edit User
	Route::post('cms-page-new',array('uses'=>'CmsController@cms_page_new')); //Edit User
	Route::post('cms-page-update',array('uses'=>'CmsController@cms_page_update')); //Edit User
	
	// Global Setting 
	Route::get('settings',array('uses'=>'SettingsController@index'));
	Route::get('site-settings',array('uses'=>'SettingsController@site_settings'));
	Route::post('update/email/{request_id}',array('uses'=>'SettingsController@update_email_settings'));
	Route::post('update/site/{request_id}',array('uses'=>'SettingsController@update_site_settings'));
	
	
	
	//EMAIL TEMPLATE 
	Route::get('emails',array('uses'=>'EmailController@index'));
	Route::get('email/edit/{template_id}',array('uses'=>'EmailController@email_template_edit'));
	Route::post('email/update',array('uses'=>'EmailController@email_template_update'));
	
	
	// customers
	Route::get('customers',array('uses'=>'CustomersController@customers'));
	Route::post('customers',array('uses'=>'CustomersController@customers'));
	Route::post('update-customer/{request_id}', 'CustomersController@update_customer'); //Edit User
	Route::post('customer/edit/{request_id}', 'CustomersController@customer_edit'); //Edit User
	
	Route::get('customer/create/',array('uses'=>'CustomersController@customer_create')); //Edit User
	Route::post('create-new-customer', 'CustomersController@customer_create_new'); //Edit User
	Route::post('customer/delete_customer/{request_id}',array('uses'=>'CustomersController@customer_delete')); //Edit User
	Route::post('customer/mark_as_district_head/{request_id}',array('uses'=>'CustomersController@mark_as_district_head')); //Edit User
	Route::post('customer/mark_as_state_head/{request_id}',array('uses'=>'CustomersController@mark_as_state_head')); //Edit User
	Route::post('export_customers',array('uses'=>'CustomersController@export_customers')); //Edit User
	
	Route::post('export_users_customers/{id}',array('as'=>'ajax.pagination','uses'=>'UsersController@exportListingCustomers'));
	Route::post('export_users',array('as'=>'ajax.pagination','uses'=>'UsersController@exportUsers'));
	
	Route::get('download-certificate/{request_id}',array('uses'=>'CustomersController@downloadCertificate')); //Edit User
	Route::get('manage-customer/{id}', 'CustomersController@manageCustomer');
	Route::post('customer/view/{request_id}', 'CustomersController@customer_view'); //Edit User
	
	Route::post('confirmModal', 'CommonController@confirmModal');
	
	Route::get('account', 'UsersController@account');
	
	Route::get('logout', 'UsersController@logout');
});	

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
	Route::post('checklogin','AdminController@checklogin');
	// Route::post('sendpassword','AdminController@sendpassword');
	Route::get('/login', 'AdminController@login');
	// Route::get('forgotpassword', 'AdminController@forgotpassword');

});