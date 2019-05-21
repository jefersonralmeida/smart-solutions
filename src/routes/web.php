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

Route::get('/', 'HomeController@root');

Route::get('/home', 'HomeController@index')->name('home')->middleware('can:view-dashboard');

Route::get('/notifications/{notification}', 'NotificationsController@read')->name('notifications.read');

Route::get('/profile/{form?}', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::post('/clinic', 'ClinicController@store')->name('clinic.store');
Route::put('/clinic', 'ClinicController@update')->name('clinic.update');

Route::get('/orders', 'OrdersController@index')->name('orders')->middleware('can:view-orders');
Route::get('/orders/aligner', 'OrderAlignerController@create')->name('order-aligner')->middleware('can:place-orders');
Route::post('/orders/aligner', 'OrderAlignerController@store')->name('order-aligner.store')->middleware('can:place-orders');

Route::get('/orders/{order}/confirm', 'OrdersController@confirmOrder')->name('orders.confirm')->where('order', '^\d+$');
Route::post('/orders/{order}/confirm', 'OrdersController@confirmOrderStore')->name('orders.store')->where('order', '^\d+$');
Route::get('/orders/{order}/force-integration', 'OrdersController@forceIntegration')->name('orders.forceIntegration')->where('order', '^\d+$');

// dentists
Route::get('/dentists', 'DentistsController@index')->name('dentists')->middleware('can:view-dentists');
Route::get('/dentists/{dentist}', 'DentistsController@view')
    ->where('dentist', '\d+')
    ->name('dentists.view')
    ->middleware('can:view-dentists');
Route::get('/dentists/create', 'DentistsController@create')->name('dentists.create')->middleware('can:view-dentists');
Route::post('/dentists', 'DentistsController@store')->name('dentists.store')->middleware('can:view-dentists');
Route::get('/dentists/edit/{dentist}', 'DentistsController@edit')->name('dentists.edit')->middleware('can:view-dentists');
Route::put('/dentists/{dentist}', 'DentistsController@update')->name('dentists.update')->middleware('can:view-dentists');
Route::delete('/dentists/{dentist}', 'DentistsController@destroy')->name('dentists.destroy')->middleware('can:view-dentists');

Route::get('/dentists/dispatch-cro-validation/{dentist}', 'DentistsController@dispatchCroValidation')->name('dentists.dispatch-cro-validation');
Route::get('/dentists/dispatch-orders-integration/{dentist}', 'DentistsController@dispatchOrdersIntegration')->name('dentists.dispatch-orders-integration');
// end of dentists

Route::get('/patients', 'PacientsController@index')->name('patients')->middleware('can:view-patients');
Route::get('/patients/{patient}', 'PacientsController@view')
    ->where('patient', '\d+')
    ->name('patients.view')
    ->middleware('can:view-patients');
Route::get('/patients/create', 'PacientsController@create')->name('patients.create')->middleware('can:view-patients');
Route::post('/patients', 'PacientsController@store')->name('patients.store')->middleware('can:view-patients');
Route::get('/patients/edit/{patient}', 'PacientsController@edit')->name('patients.edit')->middleware('can:view-patients');
Route::put('/patients/{patient}', 'PacientsController@update')->name('patients.update')->middleware('can:view-patients');
Route::delete('/patients/{patient}', 'PacientsController@destroy')->name('patients.destroy')->middleware('can:view-patients');
Route::bind('deletedPatient', function ($value) {
    return \App\Patient::onlyTrashed()->where('id', $value)->first() ?? abort(404);
});
Route::get('/patients/restore/{deletedPatient}', 'PacientsController@restore')->name('patients.restore')->middleware('can:view-patients');
