<?php

use Illuminate\Support\Facades\Route;
use App\PostcardSendingService;
use App\Postcard;

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

// Route for Service Container
Route::get('pay', 'App\Http\Controllers\PayOrderController@store');

// Route for View Composer
Route::get('channels', 'App\Http\Controllers\ChannelController@index');
Route::get('posts/create', 'App\Http\Controllers\PostController@create');

// Route for Facades
Route::get('/postcards', function (){

    $postcardService = new PostcardSendingService('us', 4, 6);

    $postcardService->hello('Hello from coder', 'test@test.com');
});

Route::get('/facades', function (){

    Postcard::hello('dang test', 'lxbinh90@gmail.com');
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{vue_capture?}', function() {
    return view('dashboard');
})->where('vue_capture', '[\/\w\.-]*');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
