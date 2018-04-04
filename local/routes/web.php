<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/', function () {
	return view('welcome');
});
Route::get('frontend', 'HomeController@get_home');
Route::group(['prefix' => 'frontend'], function () {
	Route::get('category/{cat_id?}', 'HomeController@get_cat');
	Route::get('product/{pro_id?}', 'HomeController@get_pro');
	Route::post('product/{pro_id?}', 'HomeController@get_post');
	Route::get('login', 'HomeController@get_frontend_login');
	Route::post('login', 'HomeController@post_frontend_login');
	Route::get('signup', 'HomeController@get_frontend_signup');
	Route::post('signup', 'HomeController@post_frontend_signup');
	Route::get('cart', 'HomeController@get_cart');
	Route::post('mail', 'HomeController@postEmail');
	// Route::post('mail/{id?}', 'HomeController@getEmail');
	Route::get('finish', 'HomeController@get_finish');

	Route::group(['prefix' => 'cart_process'], function () {

		Route::get('add/{pro_id?}', 'HomeController@add_cart');
		Route::get('update/{rowId?}/{qty?}', 'HomeController@update_cart');
		Route::get('remove_one/{rowId?}', 'HomeController@remove_one_cart');
		Route::get('remove_all/{rowId?}', 'HomeController@remove_all_cart');

	});

});

Route::group(['prefix' => 'category', 'middleware' => 'auth'], function () {
	Route::get('/', 'ProductController@get_categories');
	Route::post('/', 'ProductController@post_add_categories');
	Route::get('cat_edit/{id?}', 'ProductController@get_cat_edit');
	Route::post('cat_edit/{id?}', 'ProductController@post_cat_edit');
	Route::get('cat_del/{id?}', 'ProductController@cat_del');
});

Route::group(['prefix' => 'product', 'middleware' => 'auth'], function () {
	Route::get('pro_add', 'ProductController@get_pro_add');
	Route::post('pro_add', 'ProductController@post_pro_add');
	Route::get('/', 'ProductController@get_pro_list');
	Route::get('pro_edit/{id?}', 'ProductController@get_pro_edit');
	Route::post('pro_edit/{id?}', 'ProductController@post_pro_edit');
	Route::get('pro_del/{id?}', 'ProductController@pro_del');
});

Route::get('login', 'UserController@get_login');
Route::post('login', 'UserController@post_login');
Route::get('logout', 'UserController@logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('/', 'AdminController@get_admin');
});
