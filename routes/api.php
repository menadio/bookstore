<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

/**
 * Authentication routes
 */
Route::post('login', 'API\UserController@login');

Route::post('register', 'API\UserController@register');

/**
 * Book API routes
 */
Route::apiResource('books', 'BookController');

/**
 * Rating API route
 */
Route::post('books/{book}/rating', 'RatingController@store');
