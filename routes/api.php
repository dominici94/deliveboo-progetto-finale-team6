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

// api/restaurants
Route::get('/restaurants', "Api\RestaurantController@index");
Route::get('/restaurants/{typologies}', "Api\RestaurantController@filter");
Route::get('/restaurant/{slug}', 'Api\RestaurantController@SingleRestaurant');

//typologies
Route::get('/restaurants/typologies/all', "Api\RestaurantController@typologies");

// api/dishes per back-end
Route::get('/dishes/{restaurant_id}', 'Api\DishController@index');

// api/dishes per front-end
Route::get('/restaurant/dishes/{slug}', 'Api\TypoController@index');

// api/checkout
Route::get('/token/get-token', 'Api\PaymentController@getToken');
// Route::get('/checkout/send', 'Api\PaymentController@store');
Route::post('/checkout', 'Api\PaymentController@checkout');
