<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------- |
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
 * HOME ROUTES
 */
Route::get('/', 'HomeController@index')->name('home');

Route::get('/salon/{id}/book', 'HomeController@getsalon');

Route::get('/like/{salon_id}/{user_id}', 'HomeController@like');

Route::get('/liked/salons', 'HomeController@getlikedsalons');

Route::get('/styles', 'HomeController@getstyle');

/* 
 * REGISTRATION ROUTES
 *
 */
Route::get('/auth/register','RegistrationController@create')->name('register');

Route::post('/auth/register', 'RegistrationController@store')->name('register');


/*
 * SESSION ROUTES
 *
 */
Route::get('/auth/login','SessionController@create')->name('login');

Route::post('/auth/login', 'SessionController@authenticate')->name('login');

Route::get('/auth/logout', 'SessionController@destroy')->name('logout');

Route::get('/password/reset', 'SessionController@passwordreset')->name('password.request');

Route::post('/password/email', 'SessionController@sendresetlink')->name('password.email');


/*
 * SALON ROUTES WITH ISSALON MIDDLEWARE PROTECTION
 *
 */
Route::group(['middleware' => 'issalon'], function(){

    Route::resource('salon', 'SalonController');

    Route::get('/styles/{salon_id}', 'StyleController@index');

    Route::get('/styles/{salon_id}/get', 'StyleController@getStyles');

    Route::get('/style/{id}/edit', 'StyleController@edit');

    Route::post('/style/{id}/update', 'StyleController@update');

    Route::post('/style/{id}/delete', 'StyleController@destroy');

    Route::resource('/style/', 'StyleController');

    Route::get('/services/{salon_id}', 'ServiceController@index');

    Route::get('/services/{salon_id}/get', 'ServiceController@getServices');

    Route::get('/service/{id}/edit', 'ServiceController@edit');

    Route::post('/service/{id}/update', 'ServiceController@update');

    Route::post('/service/{id}/delete', 'ServiceController@destroy');

    Route::resource('/service/', 'ServiceController');
});
