<?php

use Illuminate\Support\Facades\Route;
use App\Models\Test1;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['web']], function() {

    Route::get('/add-stock', 'App\Http\Controllers\HomeController@AddStock');
    Route::post('/insertstock', 'App\Http\Controllers\HomeController@InsertStock');
    Route::get('/stock', 'App\Http\Controllers\HomeController@Stock');
    Route::get('/sells', 'App\Http\Controllers\HomeController@Sell');
    Route::get('/customers', 'App\Http\Controllers\HomeController@Customers');
    Route::get('/bill/{bill_no}', 'App\Http\Controllers\HomeController@Bill');
    Route::get('/stock/pdf', 'App\Http\Controllers\HomeController@createPDF');
    Route::post('/insertbill', 'App\Http\Controllers\HomeController@insertBill');

   
 // Login Routes...
     Route::get('/', ['as' => 'login', 'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm']);
     Route::post('/', ['as' => 'login.post', 'uses' => 'App\Http\Controllers\Auth\LoginController@login']);
     Route::post('logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\Auth\LoginController@logout']);
 
 // Registration Routes...
     Route::get('register', ['as' => 'register', 'uses' => 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm']);
     Route::post('register', ['as' => 'register.post', 'uses' => 'App\Http\Controllers\Auth\RegisterController@register']);
 
 // Password Reset Routes...
     Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm']);
     Route::post('password/email', ['as' => 'password.email', 'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail']);
     Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm']);
     Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'App\Http\Controllers\Auth\ResetPasswordController@reset']);
 
 });

//  Route::get('/test', 'App\Http\Controllers\HomeController@AddStock');

 Route::group(['middleware' => ['api']], function() {
    
    Route::get('/test', function(){
        return Test1::all();
    });


 });
