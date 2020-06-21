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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', 'AuthController@login');
Route::post('/auth/logout', 'AuthController@logout');
Route::post('auth/refresh', 'AuthController@refresh');
Route::post('auth/me', 'AuthController@me');

Route::post('customers' , 'CustomerController@store');
Route::post('customers/{id}' , 'CustomerController@show');
Route::post('all/customers' , 'CustomerController@index');

Route::post('employees' , 'EmployeeController@store');
Route::post('employees/{id}' , 'EmployeeController@show');
Route::post('all/employees' , 'EmployeeController@index');