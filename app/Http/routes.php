<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'pagesController@getHome');
Route::get('admin/login'			,'userController@getLoginAdmin');
Route::post('admin/login'			,'userController@postLoginAdmin');
Route::get('admin/logout'			,'userController@getLogout');

Route::group(['prefix' => 'admin', 'middleware' => 'adminlogin'], function(){
	Route::group(['prefix' => 'theloai'], function(){
		Route::get('add'			,'theloaiController@getAdd');
		Route::post('add'			,'theloaiController@postAdd');
		
		Route::get('edit/{id}'		,'theloaiController@getEdit');
		Route::post('edit/{id}'		,'theloaiController@postEdit');
		
		Route::get('list'			,'theloaiController@getList');

		Route::get('delete/{id}'	,'theloaiController@getDelete');
	});

	Route::group(['prefix' => 'loaitin'], function(){
		Route::get('add'			,'loaitinController@getAdd');
		Route::post('add'			,'loaitinController@postAdd');
		
		Route::get('edit/{id}'		,'loaitinController@getEdit');
		Route::post('edit/{id}'		,'loaitinController@postEdit');
		
		Route::get('list'			,'loaitinController@getList');

		Route::get('delete/{id}'	,'loaitinController@getDelete');
	});

	Route::group(['prefix' => 'tintuc'], function(){
		Route::get('add'			,'tintucController@getAdd');
		Route::post('add'			,'tintucController@postAdd');
		
		Route::get('edit/{id}'		,'tintucController@getEdit');
		Route::post('edit/{id}'		,'tintucController@postEdit');
		
		Route::get('list'			,'tintucController@getList');

		Route::get('delete/{id}'	,'tintucController@getDelete');

		Route::get('comment/{id}'	,'tintucController@getComment');
	});

	Route::group(['prefix' => 'comment'], function(){
		Route::get('del-on-tintuc/{id}'	,'commentController@getCommentTinTuc');
		Route::get('del-on-user/{id}'	,'commentController@getCommentUser');

	});

	Route::group(['prefix' => 'slide'], function(){
		Route::get('add'			,'slideController@getAdd');
		Route::post('add'			,'slideController@postAdd');
		
		Route::get('edit/{id}'		,'slideController@getEdit');
		Route::post('edit/{id}'		,'slideController@postEdit');
		
		Route::get('list'			,'slideController@getList');

		Route::get('delete/{id}'	,'slideController@getDelete');

	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('add'			,'userController@getAdd');
		Route::post('add'			,'userController@postAdd');
		
		Route::get('edit/{id}'		,'userController@getEdit');
		Route::post('edit/{id}'		,'userController@postEdit');
		
		Route::get('list'			,'userController@getList');

		Route::get('delete/{id}'	,'userController@getDelete');
		Route::get('comment/{id}'	,'userController@getComment');

	});

	Route::group(['prefix' => 'ajax'], function(){
		Route::get('loaitin/{id}'	,'ajaxController@getLoaiTin');
		Route::get('theloai/{id}'	,'ajaxController@getTheLoai');
		// Route::get('tintuc/{tieude}','ajaxController@getTieuDe');
	});
	Route::get('home'				,'theloaiController@getIndex');
});

// Route::get('products', 'ProductsController@index');
// Route::get('product/{id}', 'ProductsController@show');



// Route::post('ajax/login', function(Request $request){
// 	echo $request->username;
// });

Route::get('home'								,'pagesController@getHome');
Route::get('contact'							,'pagesController@getContact');
Route::get('category/{id}/{TenKhongDau}.html'	,'pagesController@getCategory');
Route::get('detail/{id}/{TenKhongDau}.html'		,'pagesController@getDetail');

Route::get('login'								,'pagesController@getLogin');
Route::post('login'								,'pagesController@postLogin');
Route::get('logout'								,'pagesController@getLogout');

Route::post('comment/{id}'						,'commentController@postComment');

Route::get('account/{id}'						,'pagesController@getAccount');
Route::post('account/{id}'						,'pagesController@postAccount');

Route::get('register'							,'pagesController@getRegister');
Route::post('register'							,'pagesController@postRegister');

Route::get('search'								,'pagesController@getSearch');

// Route::get('getarray'							,'pagesController@getArray');