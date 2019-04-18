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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// START users routes
Route::get('users/getData', 'UserController@getData')->name('users.data');
Route::get('users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::resource('users', 'UserController');

Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('profile/{id}', 'ProfileController@update')->name('profile.update');

// END users routes
/*
Route::get('403', function() {
  return "403 error.";
})->name('403');

Route::get('404', function() {
  return "Page not found.";
})->name('404');

Route::get('500', function() {
  return "500 error.";
})->name('500');

Route::get('503', function() {
  return "503 error.";
})->name('503');
*/
