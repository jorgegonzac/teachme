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

Route::get('/home', 'UserHomeController@index');
Route::get('profile', 'ProfileController@index');
Route::post('profile', 'ProfileController@store');
Route::group(['prefix' => 'admin'], function () {
	Route::resource('lessons', 'LessonController');
	Route::resource('tests', 'TestController');
	Route::resource('tests/{test_id}/questions', 'QuestionController');
});
