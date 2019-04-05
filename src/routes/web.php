<?php

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

Auth::routes();

Route::get('/', function() {
    $loggedUser = Auth()->user();
    $route = $loggedUser !== null && Auth::user()->can('view-dashboard') ? 'home' : 'profile';
    return redirect($route);
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('can:view-dashboard');

Route::get('/notifications/{notification}', 'NotificationsController@read')->name('notifications.read');

Route::get('/profile/{form?}', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::post('/clinic', 'ClinicController@store')->name('clinic.store');
Route::put('/clinic', 'ClinicController@update')->name('clinic.update');

Route::get('/orders', 'OrdersController@index')->name('orders')->middleware('can:view-orders');

Route::get('/order/aligner', 'OrderAlignerController@create')->name('order-aligner')->middleware('can:place-orders');

Route::get('/dentists', 'DentistsController@index')->name('dentists')->middleware('can:view-dentists');
Route::get('/dentists/create', 'DentistsController@create')->name('dentists.create')->middleware('can:view-dentists');
Route::post('/dentists', 'DentistsController@store')->name('dentists.store')->middleware('can:view-dentists');
Route::get('/dentists/edit/{dentist}', 'DentistsController@edit')->name('dentists.edit')->middleware('can:view-dentists');
Route::put('/dentists/{dentist}', 'DentistsController@update')->name('dentists.update')->middleware('can:view-dentists');
Route::delete('/dentists/{dentist}', 'DentistsController@destroy')->name('dentists.destroy')->middleware('can:view-dentists');

Route::get('/dentists/dispatch-cro-validation/{dentist}', 'DentistsController@dispatchCroValidation')->name('dentists.dispatch-cro-validation');
