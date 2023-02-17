<?php

use Illuminate\Support\Facades\Route;
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */
Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/register','App\Http\Controllers\UserController@register');
Route::post('/api/login','App\Http\Controllers\UserController@login');
Route::get('/api/userAll','App\Http\Controllers\UserController@userAll');
Route::post('/api/create','App\Http\Controllers\UserController@create');
Route::get('/api/userAllemail/{email}','App\Http\Controllers\UserController@userAllemail');
Route::get('/api/userDetail/{id}','App\Http\Controllers\UserController@userAllId');

//resource es para obtener todas las rutas para un api get post put patch de un controlador
 Route::resource('/api/tickets', 'App\Http\Controllers\TicketsController');


