<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('membership', 'SubscriptionController@store')->middleware('apikey');
Route::put('membership/{id}', 'SubscriptionController@update')->middleware('apikey');
//Route::get('membership/{}', 'SubscriptionController@show')->middleware('apikey');


Route::middleware('classcode')->group(function (){

    Route::get('test', function () {
        return response()->json(['timestamp' => Carbon::now()->format('yy-m-d h:m:s')], 200);
    });

    Route::post('sync', 'ResultsController@store');
});

Route::get('ip', function (Request $request) {
    return response()->json(['ip' => request()->ip()]);
});

