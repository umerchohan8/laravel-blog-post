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

// Route::get('/users/{id}/{name}', function($id, $name){
// 	return 'This is '.$name.' with an id of '.$id;
// });

// Route::get('/about', function(){
// 	return view('pages.about');
// });


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'PagesController@index');
Route::get('/features', 'PagesController@features');
Route::get('/enterprise', 'PagesController@enterprise');
Route::get('/about', 'PagesController@about');
Route::get('/create', 'PostsController@create');

Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');