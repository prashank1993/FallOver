<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');

Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'twitter|facebook|linkedin|google|github|bitbucket');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('add-portfolio', 'UsersController@addPortfolio')->name('add-portfolio');
    Route::post('add-package', 'UsersController@addPackage')->name('add-package');

    // Site Settings
    Route::get('/settings', 'HomeController@SiteSettings')->name('settings');
    Route::post('/settings', 'HomeController@UpdateSetting')->name('update-settings');

    // Orders
    Route::get('/influencer-orders/{slug}/', 'Orders@influencerOrders')->name('influencer-orders');
    Route::get('/brand-orders/{slug}/', 'Orders@brandOrders')->name('brand-orders');


    Route::post('/get-portfolio-details', 'UsersController@getPortfolioDetails')->name('get-portfolio-details');
});

Route::post('get-states', [UsersController::class, 'getStates'])->name('get-states');
