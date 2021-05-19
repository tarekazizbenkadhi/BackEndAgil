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
Route::get('valideClient', 'ClientController@get_valide_client');
//url entreprises
Route::get('entreprise', 'EntrepriseController@get_entreprise');
Route::get('entreprise/{id}', 'EntrepriseController@get_entreprise_byid');
Route::put('update_entreprise/{id}', 'EntrepriseController@update_entreprise');
Route::get('valideEntreprise', 'EntrepriseController@get_valide_entreprise');
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
//url carte agilis
Route::post('addCarte/{id}', 'carteController@addCarte');
Route::get('get_carte_client', 'carteController@get_carte_client');
Route::get('get_carte_entreprise', 'carteController@get_carte_entreprise');
Route::get('get_valide_carte_client', 'carteController@get_valide_carte_client');
Route::get('get_valide_carte_entreprise', 'carteController@get_valide_carte_entreprise');
Route::get('get_carte_client_byid/{id}', 'carteController@get_carte_client_byid');
Route::get('get_carte_entreprise_byid/{id}', 'carteController@get_carte_entreprise_byid');
Route::get('get_carte_client_by_cin/{cin}', 'carteController@get_carte_client_by_cin');
Route::get('get_carte_entreprise_by_matFiscal/{mat_fiscal}', 'carteController@get_carte_entreprise_by_matFiscal');
Route::put('updateCarte/{id}', 'carteController@update_carte');

// emails
Route::get('email', 'MailController@sendEmail');
// stock
Route::post('stock', 'StockController@createStock');
Route::put('addStock', 'StockController@AddStock');
Route::put('subStock', 'StockController@SubStock');
Route::get('getStock', 'StockController@getStock');

// CB
Route::post('createCard', 'CBContoller@addCarte');
Route::get('getCBbynum/{numero}', 'CBContoller@getCBbynum');
Route::put('subSolde/{numero}', 'CBContoller@debiter_montant');
//vehicule
Route::post('addVehicule/{id}', 'vehiculeController@addVehicule');
Route::get('getVehiculeClient/{id}', 'vehiculeController@get_vehicule_client_byid');
//commande bon valeur
Route::post('addCommandeBonValeur/{id}', 'CommandeBonValeurController@addCommandeBonValeur');
Route::get('get_commande_client_byid/{id}', 'CommandeBonValeurController@get_commande_client_byid');
Route::get('get_commande_entreprise_byid/{id}', 'CommandeBonValeurController@get_commande_entreprise_byid');
Route::put('update_commande/{id}', 'CommandeBonValeurController@update_commande');
//38

//Rendez vous carte agilis
Route::post('addRV/{id}', 'Rendez_vousAgilisController@addRVAgilis');
Route::get('getRV','Rendez_vousAgilisController@get_rv_agilis');
Route::get('getRVById/{id}','Rendez_vousAgilisController@get_rv_agilis_by_id');
Route::put('update_rv_agilis/{id}','Rendez_vousAgilisController@update_rv_agilis');

//Commande carte bons
Route::post('add_cmd_litres/{id}','CommandeCartesBonsController@addCommandeCarteBon');
Route::get('get_cmd_litres_byid/{id}','CommandeCartesBonsController@get_cmd_litres_entreprise_byid');
Route::put('update_cmd_litres','CommandeCartesBonsController@update_commande_litres');
//Rendez vous bons de valeur
Route::get('getRV_cmd_bv_ById/{id}','rendez_vous_vbController@get_rv_cmd_bv_by_id');
Route::put('update_rv_cmd_bv/{id}','rendez_vous_vbController@update_rv_cmd_bv');
//Rendez vous cartes bons
Route::get('get_rv_cmd_cb_by_id/{id}','rendez_vous_cbController@get_rv_cmd_cb_by_id');
Route::put('update_rv_cmd_cb/{id}','rendez_vous_cbController@update_rv_cmd_cb');

//supprimer User
Route::delete('delete_client/{id}','ClientController@delete_client');
Route::delete('delete_user/{id}','AuthController@delete_user');
Route::delete('delete_entreprise/{id}','EntrepriseController@delete_entreprise');
