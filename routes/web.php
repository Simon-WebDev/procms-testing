<?php

use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

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



Route::get('/', 'FrontController@index');

/*Front Blog*/
Route::get('/blog', [
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

Route::get('/author/{author}',[
	'uses' => 'BlogController@author',
	'as' => 'author'
]);

Route::get('/tag/{tag}',[
	'uses' => 'BlogController@tag',
	'as' => 'tag'
]);


/*Front board*/
Route::resource('/board','BoardController');

Route::get('/group/{group}',[
	'uses' => 'BoardController@group',
	'as'   => 'group'
]);
Route::get('/board/author/{author}',[
	'uses'=>'BoardController@author',
	'as'  =>'board.author'
]);

// front answer
Route::post('answer/store', 'AnswersController@store')->name('answers.store');
Route::delete('answer/{id}', 'AnswersController@destroy')->name('answers.destroy');

//front reservation
Route::get('/reservation', function () {
    
    return view('reservation');
})->name('reservation.view');
Route::resource('reservation/events', 'ReservationsController');

//front page
Route::get('pages','PagesController@index')->name('pages.index');
Route::get('pages/{id}','PagesController@show')->name('pages.show');
Route::get('/chapter/{chapter}',[
	'uses' => 'PagesController@chapter',
	'as' => 'chapter'
]);

//naver login
Route::get('/login/naver', 'NaverAuthController@redirectToProvider');
Route::get('/login/naver/callback', 'NaverAuthController@handleProviderCallback');

// front profile page
Route::group(['middleware'=>'auth'], function(){
	Route::get('/profile/{slug}','ProfilesController@index')->name('profile.index');
	Route::get('/profile/{slug}/edit','ProfilesController@edit')->name('profile.edit');
	Route::patch('/profile/{slug}','ProfilesController@update')->name('profile.update');
	Route::delete('/profile/delete/{slug}','ProfilesController@destroy')->name('profile.destroy');
});

//naver map, daum map
Route::get('about/about',function(){
	return view('about.about');
});
Route::get('about/map',function(){
	return view('about.map');
});
Route::get('about/doctors',function(){
	return view('about.doctors');
});

Auth::routes();




Route::name('backend.')->group(function(){
    
	Route::get('backend/home', 'Backend\HomeController@index')->name('home');

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

	Route::resource('backend/comment','Backend\CommentController');
	Route::post('backend/commentsactive/{id}', 'Backend\CommentController@activeManage')->name('comment.active');
	
	Route::get('backend/users/confirm/{users}',[
		'uses' => 'Backend\UsersController@confirm',
		'as' =>'users.confirm'
	]);
	Route::resource('backend/users','Backend\UsersController');
	//laravel file manager
	Route::get('backend/media',[
		'uses'=> 'Backend\MediaController@index',
		'as'  =>'media.index'
	]);

	//Bakend board
	Route::resource('backend/board', 'Backend\BoardController');
	Route::post('backend/boardsactive/{id}', 'Backend\BoardController@activeManage')->name('board.active');
	//Backend group
	Route::resource('backend/group','Backend\GroupController');
	
	//backend answers
	Route::resource('backend/answer','Backend\AnswerController');
	Route::get('backend/create/answer/{id}','Backend\AnswerController@createAnswer')->name('answer.create');
	Route::post('backend/answersactive/{id}', 'Backend\AnswerController@activeManage')->name('answer.active');

	//backend reservation
	Route::get('backend/reservation', function () {
	    return view('backend.reservation');
	})->name('reservation')->middleware('role:admin|editor|author');
	Route::resource('backend/reservation/event', 'Backend\ReservationController');
	//end reservation
	//backend staff
	Route::resource('backend/staff', 'Backend\StaffController');

	//backend settings
	Route::get('backend/setting',[
	    'uses' => 'Backend\SettingController@index',
	    'as' =>'setting.index'
	]);
	Route::post('backend/settings/update/',[
	    'uses' => 'Backend\SettingController@update',
	    'as' => 'setting.update'
	]);

	//backend page
	Route::put('backend/page/restore/{page}',[
		'uses' => 'Backend\PageController@restore',
		'as' => 'page.restore'
	]);
	Route::delete('backend/page/force-destroy/{page}',[
		'uses' => 'Backend\PageController@forceDestroy',
		'as' => 'page.force-destroy'
	]);
	Route::resource('backend/page', 'Backend\PageController');
	Route::post('backend/pageactive/{id}', 'Backend\PageController@activeManage')->name('page.active');
	//backend chapter
	Route::resource('backend/chapter','Backend\ChapterController');


});

Route::get('edit-account','Backend\HomeController@edit')->name('edit-account');
Route::put('edit-account','Backend\HomeController@update');





Route::get('mytest', function(){
	return view('mytest');

});

//google analytics test-실제서버에서 테스트해볼것
// Route::get('data', function(){
// 	$analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
// 	dd($analyticsData);
// });
	

Route::get('popup', function(){
	return view('popup');
});

	


