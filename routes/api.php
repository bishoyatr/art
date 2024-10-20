<?php

use App\Http\Controllers\notificationsController;
use App\Http\Controllers\otherApiController;
use App\Http\Controllers\otherTypesController;
use App\Http\Controllers\SendMailController;
use App\Models\OtherCategories;
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


// Route::get('ok',function(){
//      return ' Hello';
// });

Route::post('/log', [LoginController::class, 'log'])->name('log');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
});

Route::group(['prefix'=>'categories','middleware' => 'apiAuth'], function ()
{
     Route::get('/index', 'CategoriesController@index');
});

Route::group(['prefix'=>'types','middleware' => 'apiAuth'], function ()
{
     Route::get('/index', 'TypeController@index');
});

Route::group(['prefix'=>'subcategories','middleware' => 'apiAuth'], function ()
{
     Route::get('/index', 'SubCategoriesController@index');
});

Route::group(['prefix'=>'products'], function ()
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

// ------------------------------------------------


//get other category
//get other old attachment
//get other current attachment

Route::group(['prefix'=>'/2'], function ()
{
     Route::get('/categories/{id}', [otherApiController::class, 'showOtherCategories']);
     Route::get('/old/{id}', [otherApiController::class, 'showAllOldAttachments']);
     Route::get('/old/single/{id}', [otherApiController::class, 'showSingleCurrentAttachment']);
     Route::get('/current/{id}', [otherApiController::class, 'showAllCurrentAttachments']);
     Route::get('/current/single/{id}', [otherApiController::class, 'showSingleCurrentAttachment']);

     Route::post('/notification/send',[otherApiController::class,'createNotification']);
     Route::get('/notifications',[otherApiController::class,'getNotifications']);
});

Route::group(['prefix'=>'notifications'], function ()
{
     Route::get('/',[notificationsController::class, 'getNotifications'])->name('notifications.all') ;
});


     
     
Route::post('/mail',[SendMailController::class,'store']);