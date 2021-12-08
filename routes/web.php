<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/test', 'HomeController@test')->name('test');

    Route::get('/pdf', function() {
        return view('mails.pdf');
    });

//Group List
    Route::post('/coagrouplist', 'Account\MasterSetup\ChartOfAccountGroupController@getGroupList');
    Route::resource('/coagroup', 'Account\MasterSetup\ChartOfAccountGroupController');

//UsersController
    Route::post('userslocationlist', 'User\UsersController@userslocationlist');
    Route::get('reset', 'User\UsersController@reset');
    Route::post('users_list', 'User\UsersController@users_list');
    Route::get('users/{id}/cancel/', 'User\UsersController@cancel');
    Route::get('users/{id}/reactive/', 'User\UsersController@reactive');
    Route::get('users/{id}/edit/', 'User\UsersController@edit');
    Route::get('users/{id}/reset/',	'User\UsersController@reset');
    Route::get('resetmypassword', 'User\UsersController@resetmypassword');
    Route::post('password_reset', 'User\UsersController@password_reset');
    Route::resource('users', 'User\UsersController');

    Route::get('role', 'User\RoleController@role');
    Route::post('role_list', 'User\RoleController@role_list');
    Route::post('role_store', 'User\RoleController@role_store');

// Permission Controller

    Route::get('getpermissionlist', 'User\PermissionsController@getpermissionlist');

    Route::get('role_permission', 'User\RolePermissionsController@role_permission_display');
    Route::post('submit_role_permission', 'User\RolePermissionsController@submit_role_permission');

    Route::get('assigned_roles', 'User\AssignedRoleController@user_role_display');
    Route::get('permission/{id}/user_role', 'User\AssignedRoleController@submit_user_role');
    Route::post('add_user_role', 'User\AssignedRoleController@add_user_role');

    Route::resource('permission', 'User\PermissionsController');

    Route::get('branch', 'MasterSetting\BranchController@getBranch');
    Route::resource('branchs', 'MasterSetting\BranchController');

    Route::get('service', 'MasterSetting\ServiceConfiqController@getService');
    Route::get('services/{id}/reactive/', 'MasterSetting\ServiceConfiqController@reactive');
    Route::get('services/{id}/cancel/',	'MasterSetting\ServiceConfiqController@cancel');
    Route::resource('services', 'MasterSetting\ServiceConfiqController');

    Route::get('employeeidcard', 'MasterSetting\EmployeeJoinController@employeeidcard');

    Route::post('employeeidcardlistdata', 'MasterSetting\EmployeeJoinController@employeeidcardlistdata');

    Route::get('submitemployeeidcard/{id}',	'MasterSetting\EmployeeJoinController@submitemployeeidcard')->name('submitemployeeidcard');
    Route::get('view_employee_id_card/{id}',	'MasterSetting\EmployeeJoinController@view');

    Route::get('dueCollection',	'MasterSetting\DueCollectionController@cllientdueinfo');
    Route::post('collectduesubmit',	'MasterSetting\DueCollectionController@collectduesubmit');

    Route::get('customer_name_list', 'MasterSetting\DueCollectionController@customer_name_list');
    Route::get('client_information_data_list', 'MasterSetting\DueCollectionController@client_information_data_list');

    Route::get('company', 'MasterSetting\CompanyController@getCompany');
    Route::resource('companys', 'MasterSetting\CompanyController');
});
