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

Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::put('/profile/change-password', 'ProfileController@changePassword')->name('profile.change-password');
Route::post('/profile/avatar/change', 'ProfileController@changeAvatar')->name('profile.change-avatar');
Route::get('/profile/avatar/{size?}', 'ProfileController@avatar')->name('profile.avatar');
Route::get('/profile/{form?}', 'ProfileController@index')->name('profile');

// Clinics
Route::post('/clinics', 'ClinicController@store')->name('clinic.store');
Route::put('/clinics/{clinic}', 'ClinicController@update')->name('clinic.update');

// Orders
Route::get('/orders', 'OrdersController@index')->name('orders')->middleware('can:view-orders');
Route::get('/orders/{order}/confirm', 'OrdersController@confirmOrder')->name('orders.confirm')->where('order', '^\d+$');
Route::post('/orders/{order}/confirm', 'OrdersController@confirmOrderStore')->name('orders.store')->where('order', '^\d+$');
Route::get('/orders/{order}/force-integration', 'OrdersController@forceIntegration')->name('orders.forceIntegration')->where('order', '^\d+$');
Route::get('/orders/{order}/approve-project', 'OrdersController@verifyProject')->name('orders.approve.view')->where('order', '^\d+$');
Route::get('/orders/{order}/download-project-file/{fileId}', 'OrdersController@downloadProjectFile')
    ->name('orders.downloadProjectFile')
    ->where(['order', '^\d+$', 'fileId' => '^\d+$']);
Route::post('/orders/{order}/approve-project', 'OrdersController@approveProject')->name('orders.approve')->where('order', '^\d+$');
Route::post('/orders/{order}/reprove-project', 'OrdersController@reproveProject')->name('orders.reprove')->where('order', '^\d+$');
Route::get('/orders/{order}/payments', 'OrdersController@payments')->name('orders.payments')->where('order', '^\d+$');
Route::get('/orders/{order}/payment-return', 'OrdersController@paymentReturn')->name('orders.paymentReturn')->where('order', '^\d+$');
Route::post('/orders/{order}/pay/rede', 'OrdersController@payWithRede')->name('orders.pay.rede')->where('order', '^\d+$');
Route::get('/orders/{order}/files', 'OrdersController@filesForm')->name('orders.filesForm')->middleware('can:place-orders');
Route::post('/orders/{order}/upload', 'OrdersController@uploadFile')->name('orders.uploadFile')->middleware('can:place-orders');
Route::get('/orders/{order}/download/{file}', 'OrdersController@downloadFile')->name('orders.downloadFile');
Route::post('/orders/{order}/finish', 'OrdersController@finishOrder')->name('orders.finish');
Route::get('/orders/{order}/thankYou', 'OrdersController@thankYou')->name('orders.thankYou');


// Products
Route::get('/orders/aligner', 'Products\OrderAlignerController@create')->name('order-aligner')->middleware('can:place-orders');
Route::post('/orders/aligner', 'Products\OrderAlignerController@store')->name('order-aligner.store')->middleware('can:place-orders');

Route::get('/orders/surgery', 'Products\OrderSurgeryController@create')->name('order-surgery')->middleware('can:place-orders');
Route::post('/orders/surgery', 'Products\OrderSurgeryController@store')->name('order-surgery.store')->middleware('can:place-orders');

Route::get('/orders/implant-guiada', 'Products\OrderImplantGuiadaController@create')->name('order-implant-guiada')->middleware('can:place-orders');
Route::post('/orders/implant-guiada', 'Products\OrderImplantGuiadaController@store')->name('order-implant-guiada.store')->middleware('can:place-orders');

Route::get('/orders/implant-rog', 'Products\OrderImplantRogController@create')->name('order-implant-rog')->middleware('can:place-orders');
Route::post('/orders/implant-rog', 'Products\OrderImplantRogController@store')->name('order-implant-rog.store')->middleware('can:place-orders');

Route::get('/orders/esthetic', 'Products\OrderEstheticController@create')->name('order-esthetic')->middleware('can:place-orders');
Route::post('/orders/esthetic', 'Products\OrderEstheticController@store')->name('order-esthetic.store')->middleware('can:place-orders');

Route::get('/orders/aligner-pp', 'Products\OrderAlignerPPController@create')->name('order-aligner-pp')->middleware('can:place-orders');
Route::post('/orders/aligner-pp', 'Products\OrderAlignerPPController@store')->name('order-aligner-pp.store')->middleware('can:place-orders');

// Dentists
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

// Patients
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


// addresses
Route::get('/addresses/create', 'AddressesController@create')->name('addresses.create');
Route::post('addresses', 'AddressesController@store')->name('addresses.store');
Route::get('addresses/{address}/edit', 'AddressesController@edit')->name('addresses.edit');
Route::put('addresses/{address}', 'AddressesController@update')->name('addresses.update');

