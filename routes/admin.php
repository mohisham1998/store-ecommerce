<?php

use Illuminate\Support\Facades\Route;

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


/** Prefix for all written routes is 'admin' */


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){



Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin' , 'prefix' => 'admin'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

Route::group(['prefix' => 'settings',],function(){
    Route::get('shipping-methods/{type}','SettingsController@editShipping') -> name('admin.shipping.edit');
    Route::put('shipping-methods/{id}','SettingsController@updateShipping') -> name('admin.shipping.update');

});

});


Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin' , 'prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@authenticate')->name('admin.authenticate');
});
});
