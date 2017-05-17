<?php
Route::group(['middleware' => 'web', 'guest'], function () {
    Route::resource('/', 'HomeController', ['only' => ['index']]);
    Route::get('product', ['uses' => 'ProductController@index', 'as' => 'web.product.index']);
    Route::get('product/{id}', ['uses' => 'ProductController@show', 'as' => 'web.product.show']);
    Route::put('comment/{productId}', ['uses' => 'CommentController@store', 'as' => 'web.comment.store']);
    Route::get('info', ['uses' => 'InfoController@index', 'as' => 'web.info.index']);
    Route::get('contacts', ['uses' => 'ContactsController@index', 'as' => 'web.contacts.index']);
    Route::post('contacts', ['uses' => 'ContactsController@store', 'as' => 'web.contacts.store']);
    Route::get('autocomplete', ['uses' => 'SearchController@autocomplete', 'as' => 'web.autocomplete']);
    Route::get('search/{str}', ['uses' => 'SearchController@searchGet', 'as' => 'web.searchGet']);
    Route::post('search', ['uses' => 'SearchController@search', 'as' => 'web.search']);
    Auth::routes();
});
Route::group(['middleware' => 'admin'], function () {
    Route::resource('/admin', 'Admin\MainController', ['only' => ['index']]);
    Route::resource('/admin/category', 'Admin\CategoryController');
    Route::resource('/admin/product', 'Admin\ProductController');
    Route::resource('/admin/comment', 'Admin\CommentController');
    Route::resource('/admin/banner', 'Admin\BannerController');
    Route::resource('/admin/carusel', 'Admin\CaruselController');
    Route::resource('/admin/images', 'Admin\ImagesController');
    Route::resource('/admin/news', 'Admin\NewsController');
});