<?php

use Illuminate\Support\Facades\Route;

Auth::routes();


//////////////////////  Main Dashboard ////////////////////////
Route::group(['prefix'=> 'admin','namespace' => 'Dashboard' , 'middleware' => 'CheckAdmin'], function () {

    //Main Routes
    Route::get('/','DashboardController@index' )->name('dashboard.home');



    //Profile Routes
    Route::get('user/profile/{profile_id}','UserController@profile')->name('admin.users.profile');
    Route::post('user/profile/update','UserController@update')->name('admin.profile.update');



    //Users Routes
    Route::get('users/show-all','UserController@showAll')->name('admin.users.all');
    Route::get('users/show-user/{userid}','UserController@showUser')->name('admin.users.show');
    Route::post('users/save','UserController@store' )->name('admin.users.save');
    Route::post('users/delete','UserController@delete' )->name('admin.users.delete');
    Route::post('users/change-status','UserController@changeStatus' )->name('admin.users.status');
    Route::post('users/change-type','UserController@changeType' )->name('admin.users.type');




    //Categories Routes
    Route::get('categories/create','CategoryController@create')->name('admin.categories.create');
    Route::get('categories/show-all','CategoryController@showAll')->name('admin.categories.all');
    Route::post('categories/save','CategoryController@store' )->name('admin.categories.save');
    Route::post('categories/delete','CategoryController@delete' )->name('admin.categories.delete');
    Route::post('categories/edit','CategoryController@edit')->name('admin.categories.edit');
    Route::post('categories/update','CategoryController@update')->name('admin.categories.update');


    //Posts Routes
    Route::get('posts/show-all','PostController@showAll')->name('admin.posts.all');
    Route::get('posts/create','PostController@create')->name('admin.posts.create');
    Route::get('posts/edit/{post_id}','PostController@edit')->name('admin.posts.edit');
    Route::post('posts/save','PostController@store' )->name('admin.posts.save');
    Route::post('post/delete','PostController@delete')->name('admin.posts.delete');
    Route::post('post/update','PostController@update')->name('admin.posts.update');



    //Tags Routes
    Route::get('tags/show-all','TagController@showAll')->name('admin.tags.all');
    Route::post('tags/save','TagController@store')->name('admin.tags.save');
    Route::post('tags/delete','TagController@delete' )->name('admin.tags.delete');
    Route::post('tags/edit','TagController@edit')->name('admin.tags.edit');
    Route::post('tags/update','TagController@update')->name('admin.tags.update');



    //Tasks Routes
    Route::get('tasks/show-all','TaskController@showAll')->name('admin.tasks.all');
    Route::post('tasks/save','TaskController@store')->name('admin.tasks.save');
    Route::post('tasks/delete','TaskController@delete' )->name('admin.tasks.delete');
    Route::post('tasks/done','TaskController@taskIsDone')->name('admin.tasks.done');


    //Comments Routes
    Route::get('comments/show-all','CommentController@showAll')->name('admin.comments.all');
    Route::post('comments/delete','CommentController@delete' )->name('admin.comments.delete');



    //Gallery Routes



});




