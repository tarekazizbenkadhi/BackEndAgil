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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//url clients
Route::get('client', 'ClientController@get_client');
Route::get('client/{id}', 'ClientController@get_client_byid');
Route::put('update_client/{id}', 'ClientController@update_client');
//url entreprises
Route::get('entreprise', 'EntrepriseController@get_entreprise');
Route::get('entreprise/{id}', 'EntrepriseController@get_entreprise_byid');
Route::put('update_entreprise/{id}', 'EntrepriseController@update_entreprise');
//url admin commercial
Route::get('admin_commercial', 'AdminComercial@get_admin_commercials');
Route::get('admin_commercial/{id}', 'AdminComercial@get_admin_commercials_byid');
Route::put('update_admin_commercial/{id}', 'AdminComercial@update_admin_commercials');
//url AdminLivraison
Route::get('admin_livraison', 'AdminLivraison@get_admin_livraisons');
Route::get('admin_livraison/{id}', 'AdminLivraison@get_admin_livraisons_byid');
Route::put('update_admin_livraison/{id}', 'AdminLivraison@update_admin_livraisons');
//url SuperAdmin
Route::get('super_admin', 'SuperAdmin@get_super_admins');
Route::get('super_admin/{id}', 'SuperAdmin@get_super_admins_byid');
Route::put('update_super_admin/{id}', 'SuperAdmin@update_super_admins');
