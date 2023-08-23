<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('bons_caisse/facture', 'App\Http\Controllers\BonCaisseController@createFacture');
Route::post('facture', 'App\Http\Controllers\BonCaisseController@storeFacture');
Route::post('bons_caisse/avance', 'App\Http\Controllers\BonCaisseController@createAvance');
Route::post('bons_caisse/autres', 'App\Http\Controllers\BonCaisseController@createAutres');
Route::get('/bons_caisse/{date_emission}/{beneficiaire_id}/show', 'App\Http\Controllers\BonCaisseController@show');
Route::put('/bons_caisse/{id}/{beneficiaire_id}/update', 'App\Http\Controllers\BonCaisseController@update');

