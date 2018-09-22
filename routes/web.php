<?php

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

Route::get('/', [
   	'uses' => 'BlogController@index',
   	'as' => 'blog'

]);


Route::get('/blog/{post}', [
	'uses' => 'BlogController@show',
	'as' => 'blog.show'
]);

Route::post('/blog/{post}/comments', [
    'uses' => 'CommentsController@store',
    'as'   => 'blog.comments'
]);

Route::get('/category/{category}',[
	'uses' => 'BlogController@category',
	'as' => 'category'
]);
Route::get('author/{author}',[
	'uses' => 'BlogController@author',
	'as' => 'author'
]);
Route::get('tag/{tag}',[
	'uses' => 'BlogController@tag',
	'as' => 'tag'
]);



Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');


Route::name('backend.')->group(function(){
	Route::put('backend/blog/restore/{blog}',[
		'uses' => 'Backend\BlogController@restore',
		'as' => 'blog.restore'
	]);
	Route::delete('backend/blog/force-destroy/{blog}',[
		'uses' => 'Backend\BlogController@forceDestroy',
		'as' => 'blog.force-destroy'
	]);
	Route::resource('backend/blog', 'Backend\BlogController'); 

	Route::resource('backend/categories','Backend\CategoriesController');
	
	Route::get('backend/users/confirm/{users}',[
		'uses' => 'Backend\UsersController@confirm',
		'as' =>'users.confirm'
	]);
	Route::resource('backend/users','Backend\UsersController');
});

Route::get('edit-account','Backend\HomeController@edit')->name('edit-account');
Route::put('edit-account','Backend\HomeController@update');





Route::get('mytest', function(){
	return view('mytest');

});
	



	


