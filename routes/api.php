<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::post('bons_caisse/facture', 'App\Http\Controllers\BonCaisseController@createFacture');
Route::post('facture', 'App\Http\Controllers\BonCaisseController@storeFacture');
Route::post('bons_caisse/avance', 'App\Http\Controllers\BonCaisseController@createAvance');
Route::post('bons_caisse/autres', 'App\Http\Controllers\BonCaisseController@createAutres');
Route::get('/bons_caisse/{date_emission}/{beneficiaire_id}/show', 'App\Http\Controllers\BonCaisseController@show');
Route::put('/bons_caisse/{id}/{beneficiaire_id}/update', 'App\Http\Controllers\BonCaisseController@update');

