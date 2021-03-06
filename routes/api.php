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

Route::get('/', function() {
    return response()->json(['message'=>'Ingressos API', 'status'=>'Connected']);
});

Route::post('auth/login', 'AuthController@autenticate');

Route::resource('jobs', 'JobsController');
Route::resource('companies', 'CompaniesController');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
