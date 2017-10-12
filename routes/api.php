<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/me/plays', function () {
        return Auth::user()->plays;
    });

    Route::get('/me/visit/plays', function () {
        return Auth::user()->visits;
    });

    Route::post('/me/visit/play/{play_id}', function ($play_id) {
        return App\Play::findOrFail($play_id)->visits()->attach(1);
    });

    Route::post('/me/region/{region_id}/plays', function ($region_id) {
        return App\User::findOrFail(1)->plays()->create(['region_id' => $region_id]);
    });
});
