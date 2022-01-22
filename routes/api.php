<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Articles;
use App\Http\Controllers\JWTAuthController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/////////
Route::post('login', [App\Http\Controllers\ApiController::class, 'authenticate']);
Route::post('register', [App\Http\Controllers\ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    // Route::get('logout', [ApiController::class, 'logout']);
    // Route::get('get_user', [ApiController::class, 'get_user']);
    // Route::get('products', [ProductController::class, 'index']);
    // Route::get('products/{id}', [ProductController::class, 'show']);
    // Route::post('create', [ProductController::class, 'store']);
    // Route::put('update/{product}',  [ProductController::class, 'update']);
    // Route::delete('delete/{product}',  [ProductController::class, 'destroy']);
    Route::get('articles', function() {
        return response()->json(Articles::all());
    });
    Route::get('articles/{article_no}', function($article_no) {
        // $article_no="823-525";
        return response()->json(Articles::where('article_no',$article_no)->get());
    });
});