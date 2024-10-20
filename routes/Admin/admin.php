<?php

use App\Http\Controllers\notificationsController;
use App\Http\Controllers\otherTypesAttachmentsController;
use App\Http\Controllers\otherTypesController;
use App\Http\Controllers\otherTypesSubCategoriesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notifications','middleware' => 'auth:admin'], function () {
Route::get('/send',[notificationsController::class, 'notificationsView'])->name('notifications.index') ;
Route::post('/store',[notificationsController::class, 'createNotification'])->name('notification.send');
});


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
Route::group([ 'prefix' => 'users','middleware' => 'auth:admin'], function () {
    Route::get('/', 'UserController@index')->name('users.index'); // the first page admin visit
    Route::get('/create', 'UserController@create')->name('users.create'); // the first page admin visit
    Route::post('/store', 'UserController@store')->name('users.store'); // the first page admin visit
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit'); // the first page admin visit
    Route::post('/update/{id}', 'UserController@update')->name('users.update'); // the first page admin
    Route::get('/delete/{id}', 'UserController@destroy')->name('users.destroy'); // the first page admin

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
    Route::get('/edit/{product_id}', 'HistoryController@edit')->name('history.edit'); // edit year title view
    Route::post('/update/{product_id}', 'HistoryController@update')->name('history.update'); // update year title action
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
});

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', 'LoginController@login')->name('adminLogin');
        Route::post('/login', 'LoginController@postLogin')->name('adminLoginPost');
    });



    Route::group([ 'prefix' => '2/categories','middleware' => 'auth:admin'], function () {
    
        Route::get('/sub/{id}', [otherTypesController::class, 'showOtherCategories'])->name('otherCategories.index');
        Route::get('/create/{id}', [otherTypesController::class, 'createOtherCategory'])->name('otherSubCategories.create');
        Route::post('/store/{id}', [otherTypesController::class, 'storeOtherCategory'])->name('otherSubCategories.store'); 
        Route::get('/edit/{id}', [otherTypesController::class, 'editOtherCategory'])->name('otherCategories.edit');
        Route::post('/update/{id}', [otherTypesController::class, 'updateOtherCategory'])->name('otherCategories.update');
        Route::get('/delete/{id}', [otherTypesController::class, 'deleteOtherCategory'])->name('otherCategories.destroy');
        
        
        Route::get('/old/show/{id}', [otherTypesAttachmentsController::class, 'showAllOldAttachments'])->name('otherOldAttachments.index');
        Route::get('/old/create/{id}', [otherTypesAttachmentsController::class, 'createOldAttachment'])->name('otherOldAttachments.create');
        Route::post('/old/store', [otherTypesAttachmentsController::class, 'storeOldAttachment'])->name('otherOldAttachments.store'); 
        Route::get('/old/edit/{sub_id}', [otherTypesAttachmentsController::class, 'editOldAttachment'])->name('otherOldAttachments.edit');
        Route::post('/old/update/{sub_id}', [otherTypesAttachmentsController::class, 'updateOldAttachment'])->name('otherOldAttachments.update');
        Route::get('/old/delete/{sub_id}', [otherTypesAttachmentsController::class, 'deleteOldAttachment'])->name('otherOldAttachments.delete'); 
        Route::get('/old/single/{sub_id}', [otherTypesAttachmentsController::class, 'showOldAttachment'])->name('otherOldAttachments.single'); 
        
        
        Route::get('/current/show/{id}', [otherTypesAttachmentsController::class, 'showAllCurrentAttachments'])->name('otherCurrentAttachments.index');
        Route::get('/current/create/{id}', [otherTypesAttachmentsController::class, 'createCurrentAttachment'])->name('otherCurrentAttachments.create');
        Route::post('/current/store', [otherTypesAttachmentsController::class, 'storeCurrentAttachment'])->name('otherCurrentAttachments.store'); 
        Route::get('/current/edit/{sub_id}', [otherTypesAttachmentsController::class, 'editCurrentAttachment'])->name('otherCurrentAttachments.edit');
        Route::post('/current/update/{id}',[otherTypesAttachmentsController::class, 'updateCurrentAttachment'])->name('otherCurrentAttachments.update');
        Route::get('/current/delete/{sub_id}', [otherTypesAttachmentsController::class, 'deleteCurrentAttachment'])->name('otherCurrentAttachments.delete'); 
        Route::get('/current/single/{sub_id}', [otherTypesAttachmentsController::class, 'showCurrentAttachment'])->name('otherCurrentAttachments.single'); 
        
    });
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    // Route::group([ 'prefix' => '2/sub','middleware' => 'auth:admin'], function () {
        //     //Other Sub Categories
        //     Route::get('/{id}', [otherTypesSubCategoriesController::class, 'showOtherSubCategories'])->name('otherTypesSubCategories.index');
        //     Route::get('/{id}/create', [otherTypesSubCategoriesController::class, 'createOtherSubCategory'])->name('otherTypesSubCategories.create');
        //     Route::post('/store', [otherTypesSubCategoriesController::class, 'storeOtherSubCategory'])->name('otherTypesSubCategories.store'); 
        //     Route::get('/edit/{sub_id}', [otherTypesSubCategoriesController::class, 'editOtherSubCategory'])->name('otherTypesSubCategories.edit');
        //     Route::post('/update/{sub_id}', [otherTypesSubCategoriesController::class, 'updateOtherSubCategory'])->name('otherTypesSubCategories.update');
        //     Route::get('/delete/{sub_id}', [otherTypesSubCategoriesController::class, 'deleteOtherSubCategory'])->name('otherTypesSubCategories.delete'); 
    // });
    
    // Route::group([ 'prefix' => '2/attachments/old','middleware' => 'auth:admin'], function () {
        //     //Other Old Attachments 
        //     Route::get('/{id}', [otherTypesAttachmentsController::class, 'showAllOldAttachments'])->name('otherTypesOldAttachments.index');
        //     Route::get('/{id}/create', [otherTypesAttachmentsController::class, 'createOldAttachment'])->name('otherTypesOldAttachments.create');
        //     Route::post('/store', [otherTypesAttachmentsController::class, 'storeOldAttachment'])->name('otherTypesOldAttachments.store'); 
        //     Route::get('/edit/{sub_id}', [otherTypesAttachmentsController::class, 'editOldAttachment'])->name('otherTypesOldAttachments.edit');
        //     Route::post('/update/{sub_id}', [otherTypesAttachmentsController::class, 'updateOldAttachment'])->name('otherTypesOldAttachments.update');
        //     Route::get('/delete/{sub_id}', [otherTypesAttachmentsController::class, 'deleteOldAttachment'])->name('otherTypesOldAttachments.delete'); 
        //     Route::get('/single/{sub_id}', [otherTypesAttachmentsController::class, 'showOldAttachment'])->name('otherTypesOldAttachments.single'); 
        // });
        
        // Route::group([ 'prefix' => '2/attachments/current','middleware' => 'auth:admin'], function () {
        //     //Other Current Attachments
        // });