<?php


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::resource('/products', 'ProductController');
    Route::resource('/product_categories', 'ProductCategoryController');
    Route::resource('/sells', 'SellController');

    Route::get('settings', 'AuthController@settings')->name('settings.show');
    Route::post('settings', 'AuthController@updateSettings')->name('settings.update');


    /**
     * Category Archieve
     */
    Route::get('product_categories/{id}/products', 'ProductCategoryController@products')->name('product_category.products');


    Route::post('/sells/sellProduct/', 'SellController@sellProduct');
    Route::resource('doctors', 'DoctorsController');
    Route::get('doctors/{doctor}/shoppinghistory', 'DoctorsController@shoppinghistory')->name('shoppinghistory');


    /**
     * API
     */
    Route::get('apirequest/sells/index', 'SellApiController@index');
    Route::get('apirequest/doctors/index', 'DoctorsController@indexApi');
    Route::get('apirequest/products/index', 'ProductApiController@index');
    Route::get('apirequest/products/categories', 'ProductApiController@categories');

    Route::post('/products/getProductData/{product_id}', 'ProductController@getProductData');
});


Auth::routes();
