<?php

use Illuminate\Support\Facades\Route;


Auth::routes();


/*****************************************************************/

Route::get('/', 'HomeController@index')->name('home');



/****************************************************************/

Route::group(['namespace' => 'Frontend' , 'middleware' => 'auth'], function () {

//Posts Routes For Users

Route::get('/post/create','PostController@create')->name('user.posts.create');
Route::get('/post/all','PostController@myposts')->name('user.posts.myposts');
Route::get('/post/single-post/{post_id}','PostController@singlePost')->name('user.posts.single');
Route::post('/post/save','PostController@store')->name('user.posts.save');
Route::post('/post/update','PostController@update')->name('user.posts.update');
Route::post('/post/delete','PostController@delete')->name('user.posts.delete');

//Comment Routes For Users
Route::post('/comment/save','CommentController@saveComment')->name('user.comments.save');
Route::post('/comment/delete','CommentController@delete')->name('user.comments.delete');









});

