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





Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){



Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin' , 'prefix' => 'admin'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');


//******************************* ADMIN SETTINGS *******************************

    Route::group(['prefix' => 'settings',], function () {
        Route::get('shipping-methods/{type}', 'SettingsController@editShipping')->name('admin.shipping.edit');
        Route::put('shipping-methods/{id}', 'SettingsController@updateShipping')->name('admin.shipping.update');


    });
//******************************* END ADMIN DASHBOARD *******************************


//******************************* ADMIN PROFILE *******************************

    Route::group(['prefix' => 'profile'], function () {
        Route::get('edit', 'ProfileController@editProfile')->name('admin.edit.profile');
        Route::put('update', 'ProfileController@updateProfile')->name('admin.update.profile');
    });

//******************************* END ADMIN PROFILE *******************************


//******************************* ADMIN PROFILE *******************************

    Route::group(['prefix' => 'profile'], function () {
        Route::get('edit', 'ProfileController@editProfile')->name('admin.edit.profile');
        Route::put('update', 'ProfileController@updateProfile')->name('admin.update.profile');
    });

//******************************* END ADMIN PROFILE *******************************


//******************************* ADMIN MAIN CATEGORIES *******************************
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/{type}', 'CategoriesController@index')->name('admin.categories');
        Route::get('create/{type}', 'CategoriesController@create')->name('admin.categories.create');
        Route::post('store', 'CategoriesController@store')->name('admin.categories.store');
        Route::get('edit/{id}', 'CategoriesController@edit')->name('admin.categories.edit');
        Route::post('update/{id}', 'CategoriesController@update')->name('admin.categories.update');
        Route::get('delete/{id}', 'CategoriesController@destroy')->name('admin.categories.delete');


//******************************* END ADMIN MAIN CATEGORIES *******************************
    });
});


Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin' , 'prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@authenticate')->name('admin.authenticate');
});
});
