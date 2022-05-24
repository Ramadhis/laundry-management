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
    //return view('welcome');
    return redirect()->route('login');
});

Route::group(['prefix' => 'home','as' => 'home.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@index')->name('dashboard');
	Route::get('/profile','CoreController@pro')->name('profile');
});


Route::group(['prefix' => 'user','as' => 'user.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@manageuser_dashboard');
	Route::get('/dashboard','CoreController@index')->name('dashboard');
	
	Route::get('/add','ManageuserController@show_Add')->name('add');
	Route::get('/edit/{id}','ManageuserController@show_edit')->name('edit');
	Route::get('/delete/{id}','ManageuserController@user_del')->name('delete');
	Route::get('/aktif/{id}','ManageuserController@user_on')->name('aktifus');
	Route::post('/store','ManageuserController@user_Add')->name('store');
	Route::post('/storeEdit','ManageuserController@user_edit')->name('storeEd');

	Route::post('/upload','ManageuserController@upload')->name('upload');
	
});

Route::group(['prefix' => 'transaksi','as' => 'transaksi.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@trans_dashboard')->name('index');
	Route::get('/add','TransaksiController@show_Add')->name('add');
	Route::get('/edit/{id}','TransaksiController@show_edit')->name('edit');
	Route::get('/delete/{id}','TransaksiController@transaksi_del')->name('delete');
	Route::post('/store','TransaksiController@transaksi_Add')->name('store');
	Route::post('/storeEdit','TransaksiController@transaksi_edit')->name('storeEd');
	Route::post('/cek','TransaksiController@cek')->name('cekid');
	Route::get('/show/{id}','TransaksiController@show')->name('show');
	Route::post('/upstatus','TransaksiController@upstatus')->name('upstatus');
	Route::post('/bayar','TransaksiController@bayar')->name('bayar');
	Route::post('/tambiaya','TransaksiController@tambiaya')->name('tambiaya');
});

Route::group(['prefix' => 'outlet','as' => 'outlet.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@outlet_dashboard')->name('index');
	Route::get('/add','OutletController@show_Add')->name('add');
	Route::get('/edit/{id}','OutletController@show_edit')->name('edit');
	Route::get('/delete/{id}','OutletController@outlet_del')->name('delete');
	Route::post('/store','OutletController@outlet_Add')->name('store');
	Route::post('/storeEdit','OutletController@outlet_edit')->name('storeEd');	
});

Route::group(['prefix' => 'member','as' => 'member.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@member_dashboard')->name('index');	
	Route::get('/add','MemberController@show_Add')->name('add');
	Route::get('/edit/{id}','MemberController@show_edit')->name('edit');
	Route::get('/delete/{id}','MemberController@member_del')->name('delete');
	Route::post('/store','MemberController@member_Add')->name('store');
	Route::post('/storeEdit','MemberController@member_edit')->name('storeEd');	
});

Route::group(['prefix' => 'paket','as' => 'paket.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@paket_dashboard')->name('index');

	Route::get('/add','PaketController@show_Add')->name('add');
	Route::get('/edit/{id}','PaketController@show_edit')->name('edit');
	Route::get('/delete/{id}','PaketController@paket_del')->name('delete');
	Route::post('/store','PaketController@paket_Add')->name('store');
	Route::post('/storeEdit','PaketController@paket_edit')->name('storeEd');
});

Route::group(['prefix' => 'diskon','as' => 'diskon.' ,'middleware' => 'auth:web'],function (){
	Route::get('/','CoreController@diskon_dashboard')->name('index');
	Route::get('/add','DiskonController@show_Add')->name('add');
	Route::get('/edit/{id}','DiskonController@show_edit')->name('edit');
	Route::get('/delete/{id}','DiskonController@diskon_del')->name('delete');
	Route::post('/store','DiskonController@diskon_Add')->name('store');
	Route::post('/storeEdit','DiskonController@diskon_edit')->name('storeEd');	
});

Route::get('/outlet/json_out', 'CoreController@outlet_json');
Route::get('/member/json_out', 'CoreController@member_json');
Route::get('/paket/json_out', 'CoreController@paket_json');
Route::get('/user/json_out', 'CoreController@user_json');
Route::get('/transaksi/json_out', 'CoreController@trans_json');
Route::get('/diskon/json_out', 'CoreController@diskon_json');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
