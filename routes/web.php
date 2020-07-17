<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

$router->group(['prefix' => 'products'], function() use ($router) {
    $router->get('/', 'ProductsController@index');
    $router->post('/', 'ProductsController@create');
});

$router->group(['prefix' => 'orders'], function() use ($router) {
    $router->get('/', 'OrdersController@index');
    $router->get('/{id}', 'OrdersController@find');
    $router->post('/', 'OrdersController@create');
    $router->post('/{id}', 'OrdersController@save');
    $router->put('/{id}', 'OrdersController@update');
});
