<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});
 Route::post('register', 'App\Http\Controllers\AuthController@register');
 Route::post('login', 'App\Http\Controllers\AuthController@login');
 Route::post('/logout', 'App\Http\Controller\Auth\AuthController@logout')->name('logout.api');
//  Route::post('details', 'App\Http\Controller\Auth\AuthController@details');


     // our routes to be protected will go in here
 Route::middleware('auth:api')->group(function() {
    Route::post('profile', 'App\Http\Controller\Auth\AuthController@profile');
    Route::get('user/{userId}/profile', 'App\Http\Controllers\AuthController@profile');
 });
 

