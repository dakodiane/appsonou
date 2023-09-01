<?php

use App\Http\Controllers\ApiController;
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

    // Bon de versement endpoints

    Route::post('create-bon-versement', [ApiController::class,'createBonVersement']);

    Route::post('update-bon-versement/{id}', [ApiController::class,'updateBonVersement']);

    // Bon de caisse endpoints

    Route::post('create-facture', [ApiController::class,'createFacture']);

    Route::post('save-facture', [ApiController::class,'saveFacture']);

    Route::post('create-avance', [ApiController::class,'createAvance']);

    Route::post('create-autre', [ApiController::class,'createAutre']);

    Route::get('get-bon-caisse', [ApiController::class,'getBonCaisse']);

    Route::post('update-bon-caisse/{id}/{beneficiaire_id}', [ApiController::class,'updateBonCaisse']);

    // Catégorie

    Route::post('create-categorie', [ApiController::class,'createCategorie']);

    Route::post('update-categorie', [ApiController::class,'updateCategorie']);

    // Bénéficiaire

    Route::post('create-benficiaire', [ApiController::class,'createBeneficiaire']);

    Route::post('update-benficiaire', [ApiController::class,'updateBeneficiaire']);

});

