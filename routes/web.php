<?php

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

// Route::resource('mascota','MascotaController');
Route::resources([
    'mascota' => 'MascotaController',
    'propietario' => 'PropietarioController'
]);

Route::get('/home', ['uses' => 'Controller@index', 'as' => 'home']);
Route::get('mismascotas/{id}','PropietarioController@getMascotas');
