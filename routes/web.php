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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
	Route::get('/', 'AdminController@index');
	Route::get('/home', 'AdminController@index');
	Route::resource('lessons', 'LessonController');
	Route::resource('tests', 'TestController');
	Route::resource('tests/{test_id}/questions', 'QuestionController');
	Route::resource('tests/{test_id}/questions/{question_id}/answers', 'AnswerController');

	Route::resource('users', 'UserController');
	Route::get('users/invitations/create', 'InvitationsController@create');
	Route::post('users/invitations', 'InvitationsController@store');
	Route::get('users', 'UserController@index');
});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'role:user']], function () {
	Route::get('profile', 'ProfileController@index');
	Route::post('profile', 'ProfileController@store');
	Route::get('home', 'UserHomeController@index');

});

Route::get('role/handler', function() {
	$user = Auth::user();
	if ($user->type === 'admin') {
		return redirect()->to('admin/home');
	} else {
		return redirect()->to('home');
	}
})->middleware('auth');

Route::get('register/invitation/{token}', 'InvitationsController@registerToken');
