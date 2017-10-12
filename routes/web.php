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
    return DB::table('oauth_clients')->get();
    return view('welcome');
});

Route::get('/users', function () {
    return App\User::create(['name' => 'tim72117', 'password' => Hash::make(123456), 'email' => 'tim72117@gmail.com']);
});

Route::get('/region/{region_id}/plays', function ($region_id) {
    return App\Region::findOrFail($region_id)->plays;
});

Route::get('/play/{play_id}/visits', function ($play_id) {
    return App\Play::findOrFail($play_id)->visits;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
