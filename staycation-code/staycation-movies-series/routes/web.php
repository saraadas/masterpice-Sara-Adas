<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');

Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');

//<!-- create Admin -->
Route::post('/dashboard/admin','AdminController@store');
Route::get('/dashboard/admin','AdminController@create');
Route::get('/dashboard/admin/{admin}','AdminController@destroy');
Route::get('/dashboard/admin/{admin}/edit','AdminController@edit');
Route::Put('/dashboard/admin/{admin}','AdminController@update');

//<!--  user [CRUD] -->
Route::get('/dashboard/manage_user','UserController@create');
Route::post('/dashboard/manage_users','UserController@store');
Route::get('/dashboard/manage_users/{user}/edit','UserController@edit');
Route::put('/dashboard/manage_users/{user}','UserController@update');
Route::get('/dashboard/manage_users/{place}','UserController@destroy');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout','Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

// Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

// Logout route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


// Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
