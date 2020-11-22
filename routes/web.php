<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {
    $api->group(['namespace' => 'App\Http\Controllers'], function () use ($api) {
        $api->group(['prefix' => 'api'], function () use ($api)  {

            // Города
            $api->group(['prefix' => 'cities'], function () use ($api) {
                $api->get('/', 'CityController@index');
                $api->post('/create', 'CityController@create');
                $api->put('/update', 'CityController@update');
                $api->delete('/delete', 'CityController@delete');
            });

            // Партнеры
            $api->group(['prefix' => 'partners'], function () use ($api) {
                $api->get('/', 'PartnerController@index');
                $api->post('/create', 'PartnerController@create');
                $api->put('/update', 'PartnerController@update');
                $api->delete('/delete', 'PartnerController@delete');
            });

            // Категории
            $api->group(['prefix' => 'categories'], function () use ($api) {
                $api->get('/', 'CategoryController@index');
                $api->post('/create', 'CategoryController@create');
                $api->put('/update', 'CategoryController@update');
                $api->delete('/delete', 'CategoryController@delete');
            });

        });
    });
});
