<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

use Illuminate\Http\Request;

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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'LoginController@index')->name('login');

//

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/activate-account/{token}', 'UsersController@editActivateAccount')->name('activate.account');
    Route::post('/activate-account/{token}', 'UsersController@storeActivateAccount');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/requests', 'CalendarController@requests')->name('requests');
    Route::resource('/users', 'UsersController');
    Route::get('/users/{id}/restore', 'UsersController@restore');
    Route::get('/calendar', 'CalendarController@index')->name('calendar');
    Route::get('/requests-calendar', 'CalendarController@requestsCalendar')->name('requests.calendar');
    Route::get('/users/{user}/update-password', 'UsersController@editPassword')->name('password.edit');
    Route::post('/users/{user}/update-password', 'UsersController@storePassword')->name('password.store');
});
Auth::routes(['register' => false]);
