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

    Route::get('all-influencer', 'UsersController@allInfluencer')->name('users.all-influencer');
    Route::get('all-brand', 'UsersController@allBrand')->name('users.all-brand');
    Route::get('user-add', 'UsersController@brandusercreate')->name('brand.user-add');
    Route::post('brandusersave', 'UsersController@brandusersave')->name('brandusersave');
    Route::get('user-edit/{$id}', 'UsersController@brandedit')->name('user-edit');
    Route::get('brand-user-edit/{$id}', 'UsersController@showBrandUser')->name('brand-user-edit');
    Route::resource('category', 'CategoryController');
    Route::resource('services', 'ServiceController');


    // Site Settings
    Route::get('/settings', 'HomeController@SiteSettings')->name('settings');
    Route::post('/settings', 'HomeController@UpdateSetting')->name('update-settings');

    // Orders
    Route::get('/influencer-orders/{slug}/', 'Orders@influencerOrders')->name('influencer-orders');
    Route::get('/brand-orders/{slug}/', 'Orders@brandOrders')->name('brand-orders');


    Route::post('/get-portfolio-details', 'UsersController@getPortfolioDetails')->name('get-portfolio-details');
    Route::post('/delete-portfolio', 'UsersController@deletePortfolio')->name('delete-portfolio');
});

Route::post('get-states', [UsersController::class, 'getStates'])->name('get-states');
Route::get('/clear-cache', function () {
    // 
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});
