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

$router->group(
    [
        'middleware' => 'admin',
        'prefix' => 'admin'
    ],
    function () use ($router) {
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
        $router->post('/category/{category}/attributes-category', 'CategoryController@attachAttributeCategories');

        //Attributes Categories
        $router->get('/attributes-category', 'AttributesCategoryController@index');
        $router->post('/attributes-category', 'AttributesCategoryController@store');
        $router->get('/attributes-category/{category}', 'AttributesCategoryController@show');
        $router->put('/attributes-category/{category}', 'AttributesCategoryController@update');
        $router->patch('/attributes-category/{category}', 'AttributesCategoryController@update');
        $router->delete('/attributes-category/{category}', 'AttributesCategoryController@delete');

        // Location
        $router->get('/city', 'CityController@index');
        $router->get('/city/{city}', 'CityController@show');
        $router->get('/province', 'ProvinceController@index');
        $router->get('/province/{province}', 'ProvinceController@show');
        $router->get('/country', 'CountryController@index');
        $router->get('/country/{country}', 'CountryController@show');

        // Field-types
        $router->get('/field-type', 'FieldTypeController@index');
        $router->get('/field-type/{field_type}', 'FieldTypeController@show');

        // Attributes
        $router->get('/attribute', 'AttributeController@index');
        $router->post('/attribute', 'AttributeController@store');
        $router->get('/attribute/{attribute}', 'AttributeController@show');
        $router->put('/attribute/{attribute}', 'AttributeController@update');
        $router->patch('/attribute/{attribute}', 'AttributeController@update');
        $router->delete('/attribute/{attribute}', 'AttributeController@delete');
    }
);
