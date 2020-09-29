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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');

});

Route::apiResource('/employee', 'App\Http\Controllers\Api\EmployeeController');
Route::apiResource('/supplier', 'App\Http\Controllers\Api\SupplierController');
Route::apiResource('/category', 'App\Http\Controllers\Api\CategoryController');
Route::apiResource('/product', 'App\Http\Controllers\Api\ProductController');
Route::apiResource('/expense', 'App\Http\Controllers\Api\ExpenseController');
Route::apiResource('/customer', 'App\Http\Controllers\Api\CustomerController');

Route::post('/salary/paid/{id}', 'App\Http\Controllers\Api\SalaryController@paid');
Route::get('/salary', 'App\Http\Controllers\Api\SalaryController@allSalary');
Route::get('/salary/view/{id}', 'App\Http\Controllers\Api\SalaryController@viewSalary');
Route::get('/edit/salary/{id}', 'App\Http\Controllers\Api\SalaryController@editSalary');
Route::post('/salary/update/{id}', 'App\Http\Controllers\Api\SalaryController@salaryUpdate');

Route::put('/stock/update/{id}', 'App\Http\Controllers\Api\ProductController@stockUpdate');
