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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('checkAdmin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('users', 'UserController@users');
        Route::get('usersHasDeleted', 'UserController@usersHasDeleted');
        Route::delete('/delete/user/{id}', 'UserController@destroy');
        Route::get('/edit/user/{id}', 'UserController@edit');
        Route::post('/edit/user/{id}', 'UserController@update');
        Route::get('/history/{id}', 'UserController@history');
        Route::get('/editTime/{id}', 'UserController@editTime');
        Route::post('/editTime/{id}', 'UserController@updateTime');
        Route::delete('/delete/times/{id}', 'UserController@deleteTime');
        Route::get('/insert/{id}', 'UserController@insert');
        Route::post('/insert/{id}', 'UserController@insertTime');

        //Route::get('/profile/{id}', 'ProfileController@profile');
        Route::get('/userLog', 'ActionController@actionUser');
        Route::get('/timeLog', 'ActionController@actionTime');
        Route::get('/profileLog', 'ActionController@actionProfile');
    });
});

//trong middleware('admin') check quyen admin = 1 thi next request, neu admin != 1, redirect ve /home,

Route::get('/start', 'UserController@start');
Route::get('/finish', 'UserController@finish');
Route::get('/form', 'UserController@form');
Route::get('/checkout', 'UserController@checkout');

Route::get('/print/{date}', 'UserController@print');
Route::get('/profile/{id}', ['as' => 'profile', 'uses' => 'ProfileController@profile']);
Route::get('/editProfile/{id}', 'ProfileController@editProfile');
Route::post('/editProfile/{id}', 'ProfileController@updateProfile');

Route::get('/them', 'ProfileController@them');

Route::get('/test', 'UserController@test');


Route::get('/templates', 'ActionController@templates');
