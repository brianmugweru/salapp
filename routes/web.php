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

Route::get('/salon/{id}/', 'SalonController@get');

Route::get('/salon/{id}/like/', 'SalonController@like');

Route::get('/salons/liked', 'LikeController@salons');

Route::get('/search', 'SalonController@search');

Route::get('/styles', 'StyleController@getAll');

Route::post('/salon/{salon}/book', 'BookingController@store');

Route::get('/user/bookings', 'BookingController@index');

Route::get('/profile', 'ProfileController@index');

Route::get('/profile/update', 'ProfileController@edit');

Route::post('/profile/update/{user}', 'ProfileController@update');

/*
 * AUTH ROUTES
 */
Auth::routes();

Route::get('/home', 'HomeController@redirect')->name('home');

/*
 * SALON ROUTES WITH ISSALON MIDDLEWARE PROTECTION
 *
 */
Route::middleware(['isSalon'])->prefix('dashboard')->group(function(){

    Route::resource('salon', 'SalonController');

    Route::get('/styles/{salon_id}', 'StyleController@index');

    Route::get('/styles/{salon_id}/get', 'StyleController@get');

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

