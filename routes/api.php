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


Route::group(['middleware' => ['can:do_everything']], function () {
    
Route::post('customers' , 'CustomerController@store');
Route::post('customers/{id}' , 'CustomerController@show');
Route::post('all/customers' , 'CustomerController@index');
Route::patch('update/customers/{id}' , 'CustomerController@update');
Route::patch('update/customers/{id}/status' , 'CustomerController@updateStatus');
Route::delete('all/customers' , 'CustomerController@delete');

Route::post('employees' , 'EmployeeController@store');
Route::post('employees/{id}' , 'EmployeeController@show');
Route::post('all/employees' , 'EmployeeController@index');
Route::post('update/employees/{id}' , 'EmployeeController@update');
Route::post('update/employees/{id}/status' , 'EmployeeController@updateStatus');
Route::delete('all/employees' , 'EmployeeController@delete');

Route::post('drivers' , 'DriverController@store');
Route::post('drivers/{id}' , 'DriverController@show');
Route::post('all/drivers' , 'DriverController@index');
Route::post('update/customers/{id}' , 'DriverController@update');
Route::post('update/customers/{id}/status' , 'DriverController@updateStatus');
Route::delete('all/customers' , 'DriverController@delete');

Route::post('loads' , 'LoadController@store');
Route::post('loads/{id}' , 'LoadController@show');
Route::post('all/loads' , 'LoadController@index');
Route::post('update/customers/{id}' , 'LoadController@update');
Route::post('update/customers/{id}/status' , 'LoadController@updateStatus');
Route::delete('all/customers' , 'LoadController@delete');

});

