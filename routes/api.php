<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group(['namespace' => 'Admin\API', 'prefix' => 'v1','middleware' => []], function () {
    Route::get('users', 'UsersController@index');
    Route::post('calendar/make-holiday-request', 'CalendarController@makeHolidayRequest');
    Route::post('calendar/submit-holiday-requests', 'CalendarController@submitHolidayRequests');
    Route::post('calendar/cancel-holiday-request', 'CalendarController@cancelHolidayRequest');
    Route::post('accept-holiday-requests', 'CalendarController@acceptHolidayRequests');
    Route::post('decline-holiday-requests', 'CalendarController@declineHolidayRequests');
    Route::post('/accept-holiday-request', 'CalendarController@acceptHolidayRequest');
    Route::post('/decline-holiday-request', 'CalendarController@declineHolidayRequest');
    Route::post('/delete-declined-holiday-request', 'CalendarController@deleteDeclinedHolidayRequest');
    Route::get('/get-requests', 'CalendarController@getRequests');
    Route::get('/check-weekend-availablity', 'CalendarController@checkWeekendAvailablity');
    Route::post('/toggle-weekend-availability', 'CalendarController@toggleWeekendAvailability');
});
