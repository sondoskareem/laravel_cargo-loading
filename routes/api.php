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
Route::post('companies' , 'CompanyController@store');


Route::group(['middleware' => ['can:do_everything']], function () {

        
    Route::get('companies' , 'CompanyController@show');
    Route::post('update/companies/{id}' , 'CompanyController@update');
        
    Route::post('customers' , 'CustomerController@store');
    Route::post('customers/{id}' , 'CustomerController@show');
    Route::post('all/customers' , 'CustomerController@index');
    Route::post('update/customers/{id}' , 'CustomerController@update');
    Route::post('update/customers/{id}/status' , 'CustomerController@updateStatus');
    Route::delete('delete/customers/{id}' , 'CustomerController@destroy');

    Route::post('employees' , 'EmployeeController@store');
    Route::post('employees/{id}' , 'EmployeeController@show');
    Route::post('all/employees' , 'EmployeeController@index');
    Route::post('update/employees/{id}' , 'EmployeeController@update');
    Route::post('update/employees/{id}/status' , 'EmployeeController@updateStatus');
    Route::delete('delete/employees/{id}' , 'EmployeeController@destroy');

    Route::post('drivers' , 'DriverController@store');
    Route::post('drivers/{id}' , 'DriverController@show');
    Route::post('all/drivers' , 'DriverController@index');
    Route::post('update/drivers/{id}' , 'DriverController@update');
    Route::post('update/drivers/{id}/status' , 'DriverController@updateStatus');
    Route::delete('delete/drivers/{id}' , 'DriverController@destroy');


    Route::post('loads' , 'LoadController@store');
    Route::post('loads/{id}' , 'LoadController@show');
    Route::post('all/loads' , 'LoadController@index');
    Route::post('update/loads/{id}' , 'LoadController@update');
    Route::post('update/loads/{id}/status' , 'LoadController@updateStatus');
    Route::delete('delete/loads/{id}' , 'LoadController@destroy');

    Route::post('stops' , 'StopsController@store');
    Route::post('update/stops/{id}' , 'StopsController@update');
    Route::delete('delete/stops/{id}' , 'StopsController@destroy');

    Route::post('commodity' , 'CommodityController@store');
    Route::post('update/commodity/{id}' , 'CommodityController@update');
    Route::delete('delete/commodity/{id}' , 'CommodityController@destroy');

    Route::post('factoring' , 'FactoringController@store');
    Route::post('all/factoring' , 'FactoringController@index');
    Route::post('update/factoring/{id}' , 'FactoringController@update');
    Route::delete('delete/factoring/{id}' , 'FactoringController@destroy');

    Route::post('equipment' , 'EquipmentController@store');
    Route::post('all/equipment' , 'EquipmentController@index');
    Route::post('update/equipment/{id}' , 'EquipmentController@update');
    Route::delete('delete/equipment/{id}' , 'EquipmentController@destroy');

    Route::post('representative' , 'RepresentativeController@store');
    Route::post('all/representative' , 'RepresentativeController@index');
    Route::post('update/representative/{id}' , 'RepresentativeController@update');
    Route::delete('delete/representative/{id}' , 'RepresentativeController@destroy');
});

