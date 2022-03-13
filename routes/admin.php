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
    Route::group(['prefix' => 'main_categories'], function () {
        Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');

        Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
        Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');

        Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');

        Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.delete');

        Route::get('status/{id}', 'MainCategoriesController@changeStatus')->name('admin.maincategories.status');

//******************************* END ADMIN MAIN CATEGORIES *******************************
    });
});


Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin' , 'prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@authenticate')->name('admin.authenticate');
});
});
