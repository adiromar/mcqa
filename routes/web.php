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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('index');
Route::get('posts/index', 'PostsController@index');
Route::get('category/index', 'CategoryController@index');

Route::resource('posts', 'PostsController');

// Route::get('posts/create', 'PostsController@create');
Route::get('category/create', 'CategoryController@create');
Route::post('category/store', 'CategoryController@store');
Route::post('category/{id}', 'CategoryController@destroy');
// Route::post('posts/store', 'PostsController@store');

// Route::get('/show/{id}', function () {
//     return view('category/show');
// });
Route::get('/cat/{slug}/{id}', 'CategoryController@cat')->name('cat');
Route::get('/posts/{id}/edit', 'PostsController@edit')->name('posts');
Route::post('posts/update/', 'PostsController@update');

Route::post('/uploadFile', 'UploadPostController@uploadFile');
Route::post('/uploadCategory', 'UploadPostController@uploadCategory');
