<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
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
Route::post('/log', [LoginController::class, 'log'])->name('log');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'categories','middleware' => 'apiAuth'], function ()
    {
        Route::get('/index', 'CategoriesController@index');
    });
Route::group(['prefix'=>'subcategories','middleware' => 'apiAuth'], function ()
   {
        Route::get('/index', 'SubCategoriesController@index');
   });
Route::group(['prefix'=>'products','middleware' => 'apiAuth'], function ()
   {
        Route::get('/index', 'ProductController@index');
        Route::get('/history', 'ProductHistoryController@index');

   });
Route::group(['prefix'=>'products_line','middleware' => 'apiAuth'], function ()
   {
        Route::get('/index', 'ProductLineController@index');
        Route::get('/current_product_attachment', 'ProductLineController@CurrentProductAttachment');

   });
Route::group(['prefix'=>'user','middleware' => 'apiAuth'], function ()
   {
        Route::post('/update', 'LoginController@updateImage');

   });
Route::group(['prefix'=>'login'], function ()
   {
        Route::post('/', 'LoginController@login');

   });

