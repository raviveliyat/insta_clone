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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('p', 'PostController');
Route::post('/p/{p}/comment', 'PostController@comment')->name('post.comment');
Route::patch('/p/{p}/like', 'PostController@like')->name('post.like');
Route::post('/p/storePosts', 'PostController@storePosts')->name('p.storePosts');

Route::patch('/users/{user}/follow', 'UserController@follow')->name('user.follow');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::patch('/admin/{user}/status', 'AdminController@changeUserStatus')->name('admin.status');
Route::get('/admin/{user}/portal', 'AdminController@userPortal')->name('admin.user');

Route::get('/{user}', 'UserController@profile')->name('user.profile');
Route::get('/{user}/edit', 'UserController@editProfile')->name('user.edit');
Route::patch('/{user}/save', 'UserController@saveProfile')->name('user.save');
