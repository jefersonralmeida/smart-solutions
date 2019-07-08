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

Route::get('/dentists', function(Request $request) {

    $perPage = $request->query('perpage', 15);

    $filters = [
        'city' => sanitizeString($request->query('city', '')),
        'state' => sanitizeString($request->query('state', '')),
    ];

    $filters = array_filter($filters, function ($item) {
        return $item;
    });

    $builder = \App\Dentist::withoutGlobalScope(\App\Scopes\CurrentClinicScope::class);

    foreach ($filters as $key => $value) {
        $builder->where($key, 'like', "%$value%");
    }

   $columns = [
       'name',
       'email',
       'city',
       'state',
       'phone',
       'cellphone'
   ];

    if ($perPage === '0') {
        return $builder->get($columns)->toArray();
    }
    return $builder->paginate($perPage, $columns);
});

