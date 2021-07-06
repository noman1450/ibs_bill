<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');

//Group List 
Route::resource('/coagroup',		    'Account\MasterSetup\ChartOfAccountGroupController');
Route::post('/coagrouplist', 		    'Account\MasterSetup\ChartOfAccountGroupController@getGroupList');


//UsersController
Route::resource('users',				'User\UsersController');
Route::post('userslocationlist',		'User\UsersController@userslocationlist');
Route::get('reset',	            		'User\UsersController@reset');
Route::post('users_list',	            'User\UsersController@users_list');
Route::get('users/{id}/cancel/',		'User\UsersController@cancel');
Route::get('users/{id}/reactive/',		'User\UsersController@reactive');
Route::get('users/{id}/edit/',	    	'User\UsersController@edit');
Route::get('users/{id}/reset/',	    	'User\UsersController@reset');
Route::get('resetmypassword',	    	'User\UsersController@resetmypassword');
Route::post('password_reset',	        'User\UsersController@password_reset');




Route::get('role',                      'User\RoleController@role');
Route::post('role_list',          	    'User\RoleController@role_list');
Route::post('role_store',         	    'User\RoleController@role_store');

// Permission Controller

Route::resource('permission',  		    'User\PermissionsController');
Route::get('getpermissionlist', 		'User\PermissionsController@getpermissionlist');

Route::get('role_permission',           'User\RolePermissionsController@role_permission_display');
Route::post('submit_role_permission',   'User\RolePermissionsController@submit_role_permission');

Route::get('assigned_roles',            'User\AssignedRoleController@user_role_display');
Route::get('permission/{id}/user_role', 'User\AssignedRoleController@submit_user_role');
Route::post('add_user_role',            'User\AssignedRoleController@add_user_role');



Route::resource('branchs',				'MasterSetting\BranchController');
Route::get('branch',					'MasterSetting\BranchController@getBranch');


 
Route::resource('services',				'MasterSetting\ServiceConfiqController');
Route::get('service',					'MasterSetting\ServiceConfiqController@getService');
Route::get('services/{id}/reactive/',		'MasterSetting\ServiceConfiqController@reactive');
Route::get('services/{id}/cancel/',		'MasterSetting\ServiceConfiqController@cancel');






Route::get('employeeidcard',		'MasterSetting\EmployeeJoinController@employeeidcard');

Route::post('employeeidcardlistdata', 'MasterSetting\EmployeeJoinController@employeeidcardlistdata');

Route::post('submitemployeeidcard',	'MasterSetting\EmployeeJoinController@submitemployeeidcard');






Route::get('dueCollection',				'MasterSetting\DueCollectionController@cllientdueinfo');

Route::get('customer_name_list', 'MasterSetting\DueCollectionController@customer_name_list');
Route::get('client_information_data_list', 'MasterSetting\DueCollectionController@client_information_data_list');




Route::resource('companys',	            'MasterSetting\CompanyController');
Route::get('company',					'MasterSetting\CompanyController@getCompany');

