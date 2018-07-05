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



Route::get('/all',function(){
	$user = App\User::all();
	if(session('user.role') == 1){
		dd(session('user.role'));
	}
});

Route::middleware('checkAdmin')->group(function () {
	Route::prefix('admin')->group(function () {
		Route::get('user','UserController@user');
		Route::delete('/delete/user/{id}','UserController@destroy');
		Route::get('/edit/user/{id}','UserController@edit');
		Route::post('/edit/user/{id}','UserController@update');
		Route::get('/history/{id}','UserController@history');
		Route::get('/editTime/{id}','UserController@editTime');
		Route::post('/editTime/{id}','UserController@updateTime');


	});
});

//trong middleware('admin') check quyen admin = 1 thi next request, neu admin != 1, redirect ve /home,

Route::get('/start','UserController@start');
Route::get('/finish','UserController@finish');
Route::get('/form','UserController@form');
Route::get('/checkout','UserController@checkout');
Route::get('/test','UserController@test');

Route::get('/thongtin',function(){
	$data = App\user::find(10);

	foreach ($data->lienket()->where('id',10) as $data1) {
    echo $data1;
	}
});

Route::get('/time',function(){
	
	$t=time();
	echo("<br>".$t . "<br>");
	echo(date("h:i:sa",$t));
	
});
Route::get('/check',function(){
	$t1 = now();
	$t = date('y-m-d',strtotime($t1));

	$t2 = date('y-m-d',strtotime(now()) + 1000); 
	if($t2 == $t){
		echo "hello";
	}
	else{
		echo "hi".$t2.$t;
	}
});
Route::get('/send','UserController@mail');