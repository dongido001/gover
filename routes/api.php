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

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::get('/customers', 'MessageController@getCustomers');
    Route::get('/customer/{customer_id}', 'MessageController@getLogsByCustomer');
});

//===
//= This is route for chatfuel webhook that responds to governor related questions
//===
Route::post('/getGovernor', "WebhookController@getGovernor");

//===
//= This is route for chatfuel webhook that responds to date
//===
Route::get('/getDate', "WebhookController@getDate");
