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

Route::get('/', function () {

    return view('welcome');
});

//===
//= This is route for chatfuel webhook
//===
Route::get('/chatfuelWebhook', function () {
	
	return '{
		 "messages": [
		   {"text": "Welcome to the Chatfuel Rockets!"},
		   {"text": "What are you up to?"}
		 ]
		}';
    //return "Fisher, please go away.";
});
