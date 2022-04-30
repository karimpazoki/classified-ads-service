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

// Auth
$router->group([
    'prefix' => 'auth'
], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('user', 'AuthController@user');
});

// Brands
$router->get('/brand', 'BrandController@index');
$router->post('/brand', 'BrandController@store');
$router->get('/brand/{brand}', 'BrandController@show');
$router->put('/brand/{brand}', 'BrandController@update');
$router->patch('/brand/{brand}', 'BrandController@update');
$router->delete('/brand/{brand}', 'BrandController@delete');

//Categories
$router->get('/category', 'CategoryController@index');
$router->post('/category', 'CategoryController@store');
$router->get('/category/{category}', 'CategoryController@show');
$router->put('/category/{category}', 'CategoryController@update');
$router->patch('/category/{category}', 'CategoryController@update');
$router->delete('/category/{category}', 'CategoryController@delete');
