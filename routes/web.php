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
        $router->group([
            'prefix' => 'brand'
        ], function ($router) {
            $router->get('/', 'BrandController@index');
            $router->post('/', 'BrandController@store');
            $router->get('/{brand}', 'BrandController@show');
            $router->put('/{brand}', 'BrandController@update');
            $router->patch('/{brand}', 'BrandController@update');
            $router->delete('/{brand}', 'BrandController@delete');
        });

        //Categories
        $router->group([
            'prefix' => 'category'
        ], function ($router) {
            $router->get('/', 'CategoryController@index');
            $router->post('/', 'CategoryController@store');
            $router->get('/{category}', 'CategoryController@show');
            $router->put('/{category}', 'CategoryController@update');
            $router->patch('/{category}', 'CategoryController@update');
            $router->delete('/{category}', 'CategoryController@delete');
            $router->post('/{category}/attributes-category', 'CategoryController@attachAttributeCategories');
        });

        //Attributes Categories
        $router->group([
            'prefix' => 'attributes-category'
        ], function ($router) {
            $router->get('/', 'AttributesCategoryController@index');
            $router->post('/', 'AttributesCategoryController@store');
            $router->get('/{category}', 'AttributesCategoryController@show');
            $router->put('/{category}', 'AttributesCategoryController@update');
            $router->patch('/{category}', 'AttributesCategoryController@update');
            $router->delete('/{category}', 'AttributesCategoryController@delete');
        });

        // Location
        $router->group([
            'prefix' => 'location'
        ], function ($router) {
            $router->get('/city', 'CityController@index');
            $router->get('/city/{city}', 'CityController@show');
            $router->get('/province', 'ProvinceController@index');
            $router->get('/province/{province}', 'ProvinceController@show');
            $router->get('/country', 'CountryController@index');
            $router->get('/country/{country}', 'CountryController@show');
        });

        // Field-types
        $router->group([
            'prefix' => 'field-type'
        ], function ($router) {
            $router->get('/', 'FieldTypeController@index');
            $router->get('/{field_type}', 'FieldTypeController@show');
        });

        // Attributes
        $router->group([
            'prefix' => 'attribute'
        ], function ($router) {
            $router->get('/', 'AttributeController@index');
            $router->post('/', 'AttributeController@store');
            $router->get('/{attribute}', 'AttributeController@show');
            $router->put('/{attribute}', 'AttributeController@update');
            $router->patch('/{attribute}', 'AttributeController@update');
            $router->delete('/{attribute}', 'AttributeController@delete');
        });
    }
);
