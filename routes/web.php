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

Route::get('/salon/book/{id}', 'HomeController@booksalon');

/*
 * AUTH ROUTES
 */
Auth::routes();

Route::get('/home', 'HomeController@redirect')->name('home');
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

