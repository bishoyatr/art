<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
   Route::get('/logout', 'LoginController@logout')->name('logout');

});
Route::group([ 'prefix' => 'category','middleware' => 'auth:admin'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index'); // the first page admin visit
    Route::get('/create', 'CategoryController@create')->name('category.create'); // the first page admin visit
    Route::post('/store', 'CategoryController@store')->name('category.store'); // the first page admin visit
    Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit'); // the first page admin visit
    Route::post('/update/{id}', 'CategoryController@update')->name('category.update'); // the first page admin
    Route::get('/delete/{id}', 'CategoryController@destroy')->name('category.destroy'); // the first page admin

});
Route::group([ 'prefix' => 'types','middleware' => 'auth:admin'], function () {
    Route::get('/', 'TypeController@index')->name('types.index'); // the first page admin visit
    Route::get('/create', 'TypeController@create')->name('types.create'); // the first page admin visit
    Route::post('/store', 'TypeController@store')->name('types.store'); // the first page admin visit
    Route::get('/edit/{id}', 'TypeController@edit')->name('types.edit'); // the first page admin visit
    Route::post('/update/{id}', 'TypeController@update')->name('types.update'); // the first page admin
    Route::get('/delete/{id}', 'TypeController@destroy')->name('types.destroy'); // the first page admin

});
Route::group([ 'prefix' => 'subcategory','middleware' => 'auth:admin'], function () {
    Route::get('/index/{cat_id}', 'SubCategoryController@index')->name('subcategory.index');

    Route::get('/create/{id}', 'SubCategoryController@create')->name('subcategory.create');
    Route::post('/store', 'SubCategoryController@store')->name('subcategory.store'); // the first page admin visit
    Route::get('/edit/{id}', 'SubCategoryController@edit')->name('subcategory.edit'); // the first page admin visit
    Route::post('/update/{id}', 'SubCategoryController@update')->name('subcategory.update'); // the first page admin
    Route::get('/delete/{id}', 'SubCategoryController@destroy')->name('subcategory.destroy'); // the first page admin

});
Route::group([ 'prefix' => 'product','middleware' => 'auth:admin'], function () {
    Route::get('/index/{sub_category_id}', 'ProductController@index')->name('product.index'); // the first page admin

    Route::get('/create/{sub_category_id}', 'ProductController@create')->name('product.create'); // the first page admin visit
    Route::post('/store', 'ProductController@store')->name('product.store'); // the first page admin visit
    Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit'); // the first page admin visit
    Route::post('/update/{id}', 'ProductController@update')->name('product.update'); // the first page admin
    Route::get('/delete/{id}', 'ProductController@destroy')->name('product.destroy'); // the first page admin

});
Route::group([ 'prefix' => 'productline','middleware' => 'auth:admin'], function () {
    Route::get('index/{product_id}/{product_type?}', 'ProductLineController@index')->name('productline.index');
    Route::get('/create/{product_id}/{type?}', 'ProductLineController@create')->name('productline.create');

    Route::post('/store', 'ProductLineController@store')->name('productline.store'); // the first page admin visit
    Route::get('/edit/{id}', 'ProductLineController@edit')->name('productline.edit'); // the first page admin visit
    Route::post('/update/{id}', 'ProductLineController@update')->name('productline.update'); // the first page admin
    Route::get('/delete/{id}', 'ProductLineController@destroy')->name('productline.destroy'); // the first page admin
    Route::get('/add_current_attachment/{id}', 'ProductLineController@AddOrEditAttachment')->name('productline.add_attachment');
    Route::post('/store_current_attachment', 'ProductLineController@StoreOrEditAttachment')->name('productline.store_attachment');
        Route::post('/update_current_attachment', 'ProductLineController@updateAttachment')->name('productline.update_attachment');
    Route::get('/show_current_attachment/{id}', 'ProductLineController@ShowCurrentAttachment')->name('productline.show_current_attachment');
    Route::get('/delete_current_attachment/{id}', 'ProductLineController@deleteCurrentAttachment')->name('productline.delete_current_attachment');

});
Route::group([ 'prefix' => 'history','middleware' => 'auth:admin'], function () {
    Route::get('/{product_id}', 'HistoryController@index')->name('history.index'); // the first page admin visit
    Route::get('/create/{product_id}', 'HistoryController@create')->name('history.create'); // the first page admin
    Route::post('/store', 'HistoryController@store')->name('history.store'); // the first page admin visit
    Route::get('/history_attachment/{id}/{type?}', 'HistoryController@historyAttachment')->name('history.add_history_attachment'); //
    Route::get('/delete_year_title/{id}/{type?}', 'HistoryController@deleteYeartitle')
        ->name('history.deleteYeartitle'); //
    Route::get('/create_history_attachment/{id}/{type?}', 'HistoryController@createHistoryAttachment')->name('history.create_history_attachment'); //
    Route::post('/store_history_attachment', 'HistoryController@storeHistoryAttachment')->name('history.store_history_attachment'); //
    Route::get('/edit_history_attachment/{id}', 'HistoryController@editHistoryAttachment')->name('history.edit_history_attachment'); //
    Route::post('/update_history_attachment', 'HistoryController@updateHistoryAttachment')->name('history.update_history_attachment'); //
    Route::get('/show_history_attachment/{id}', 'HistoryController@showHistoryAttachment')->name('history.show_history_attachment'); //
    Route::get('/delete_history_attachment/{id}', 'HistoryController@deleteHistoryAttachment')->name('history.delete_history_attachment'); //
    // the
});

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', 'LoginController@login')->name('adminLogin');
        Route::post('/login', 'LoginController@postLogin')->name('adminLoginPost');
    });


