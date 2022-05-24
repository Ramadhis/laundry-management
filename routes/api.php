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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
 
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::get('out','API\AndroidcoreController@get_all_outlet');
    Route::get('dis','API\AndroidcoreController@get_all_diskon');
    Route::get('pak','API\AndroidcoreController@get_all_paket');
    Route::get('member','API\AndroidcoreController@get_all_member');
    Route::get('trans','API\AndroidcoreController@get_all_trans');
    Route::get('users','API\AndroidcoreController@get_all_user');
});
Route::post('out/add','API\AndroidcoreController@outlet_add');