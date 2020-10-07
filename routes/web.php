<?php

use Illuminate\Support\Facades\Route;

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


//Route::get('/test', 'App\Http\Controllers\HomeController@test');
Route::get('pay', 'App\Http\Controllers\PayOrderController@store');



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{vue_capture?}', function() {
    return view('dashboard');
})->where('vue_capture', '[\/\w\.-]*');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
