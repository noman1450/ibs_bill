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


    // select2 controller



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

    // process_service
    Route::get('process_service', 'MasterSetting\ProcessServiceController@index');
    Route::post('get-process_service-data', 'MasterSetting\ProcessServiceController@getData');
    Route::post('process_service',	'MasterSetting\ProcessServiceController@store');
    Route::get('process_service/{id}/show', 'MasterSetting\ProcessServiceController@show')->name('process_service.show');
    Route::get('view_process_service/{id}',	'MasterSetting\ProcessServiceController@view');
    Route::get('process_service/send_mail/{id}',	'MasterSetting\ProcessServiceController@send_mail');
    Route::get('process_service/{id}/edit',	'MasterSetting\ProcessServiceController@edit');
    Route::patch('process_service/{id}/update',	'MasterSetting\ProcessServiceController@update')->name('process_service.update');

    // process_service_view
    Route::get('process_service_view', 'MasterSetting\CombindInvoiceGenerateController@index');
    Route::post('get-process_service_view-data', 'MasterSetting\CombindInvoiceGenerateController@getData');
    Route::post('process_service_generate', 'MasterSetting\CombindInvoiceGenerateController@generate');


    Route::get('dueCollection',	'MasterSetting\DueCollectionController@cllientdueinfo');
    Route::post('collectduesubmit',	'MasterSetting\DueCollectionController@collectduesubmit');

    Route::get('customer_name_list', 'MasterSetting\DueCollectionController@customer_name_list');
    Route::get('client_information_data_list', 'MasterSetting\DueCollectionController@client_information_data_list');

    Route::get('company', 'MasterSetting\CompanyController@getCompany');
    Route::resource('companys', 'MasterSetting\CompanyController');

    // Customer or Client Controller
    Route::get('get-customer_information-data', 'MasterSetting\CustomerInformationController@getData');
    Route::resource('customer_information', 'MasterSetting\CustomerInformationController');
    // ! Customer or Client Controller
});
