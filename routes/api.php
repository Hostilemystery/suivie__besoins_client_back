<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionClient;
use App\Http\Controllers\Auth\Connexion;
use App\Http\Controllers\GestionService;
use App\Http\Controllers\GestionActivite;
use App\Http\Controllers\GestionUtilisateur;
use App\Http\Controllers\GestionNotification;
use App\Http\Controllers\GestionTypeUtilisateur;
use App\Http\Controllers\Gestion_Client_Notification;


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

Route::post('/login', [Connexion::class, 'login']);

Route::middleware('auth:api')->group(function () {


    // Route::get('/getToken/{id}', [Connexion::class, 'get_user_id_accessToken']);


    // Route::post('/logout', [Connexion::class, 'logout']);

    // Route::resource('/utilisateur', GestionUtilisateur::class);

    // Route::resource('/client', GestionClient::class);

    // Route::resource('/Activite', GestionActivite::class);

    // Route::resource('/Notification', GestionNotification::class);

    // Route::resource('/Service', GestionService::class);

    // Route::resource('/role', GestionTypeUtilisateur::class);
    // Route::get('/trash', [GestionClient::class, 'trash']);
    // Route::get('/trashs', [GestionUtilisateur::class, 'trashs']);
    // Route::get('/trashs/{id}', [GestionUtilisateur::class, 'restore']);
    // Route::delete('/del/{id}', [GestionUtilisateur::class, 'del']);
    // Route::get('/trash/{id}', [GestionClient::class, 'restore']);
    // Route::delete('/delete/{id}', [GestionClient::class, 'del']);

    // Route::resource('/Client_Notification', Gestion_Client_Notification::class);

    // Route::get('/countClient', [GestionClient::class, 'count']);
    // Route::get('/countUser', [GestionUtilisateur::class, 'count']);
    // Route::get('/countService', [GestionService::class, 'count']);
    // Route::get('/generatePdf', [GestionClient::class, 'generatePdf']);
    // Route::get('/pdf/{id}', [GestionClient::class, 'pdf']);
    // Route::get('/pdfs/{id}', [GestionService::class, 'pdfs']);
});


Route::get('/getToken/{id}', [Connexion::class, 'get_user_id_accessToken']);

    Route::post('/logout', [Connexion::class, 'logout']);

    Route::get('/trash', [GestionClient::class, 'trash']);
    Route::get('/trashs', [GestionUtilisateur::class, 'trashs']);
    Route::get('/trashs/{id}', [GestionUtilisateur::class, 'restore']);
    Route::delete('/del/{id}', [GestionUtilisateur::class, 'del']);
    Route::get('/trash/{id}', [GestionClient::class, 'restore']);
    Route::delete('/delete/{id}', [GestionClient::class, 'del']);

    // Route::get('/notif', [GestionNotification::class, 'mail']);

    Route::resource('/utilisateur', GestionUtilisateur::class);
    Route::resource('/role', GestionTypeUtilisateur::class);

    Route::resource('/client', GestionClient::class);

    Route::resource('/Activite', GestionActivite::class);

    Route::resource('/Notification', GestionNotification::class);

    Route::resource('/Service', GestionService::class);

    Route::resource('/Client_Notification', Gestion_Client_Notification::class);

    Route::get('/countClient', [GestionClient::class, 'count']);

    Route::get('/countUser', [GestionUtilisateur::class, 'count']);
    Route::get('/countService', [GestionService::class, 'count']);

    Route::get('/generatePdf', [GestionClient::class, 'generatePdf']);
    Route::get('/pdf/{id}', [GestionClient::class, 'pdf']);
    Route::get('/pdfs/{id}', [GestionService::class, 'pdfs']);
