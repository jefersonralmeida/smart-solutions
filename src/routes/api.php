<?php

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

//Route::middleware('auth:api')->group(function() {
Route::group([], function() {
    Route::get('/notifications', 'NotificationsController@index');
    Route::get('/shipping-info/{provider}/{zipCode}', 'ShippingController@info')
        ->where('zipCode', '^\d{8}$')
        ->middleware(['cache', 'cacheFor:1800']);
});

