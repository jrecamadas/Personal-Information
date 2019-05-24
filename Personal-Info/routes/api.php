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
if (app()->getProvider('\Dingo\Api\Provider\LaravelServiceProvider')) {
    $api = app('Dingo\Api\Routing\Router');
    $api->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {

        $api->get('get-name', 'PersonalInformationsController@getDataByName'); 
        $api->get('informations', 'PersonalInformationsController@retrieveData'); 
        $api->resource('data', 'PersonalInformationsController');
        $api->patch('updateinfo/{id}', 'PersonalInformationsController@update');
    });
    
}


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware('auth:api')->get('/informations', 'PersonalInformationsController@retrieveData');