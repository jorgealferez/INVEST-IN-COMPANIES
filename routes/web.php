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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('dashboard')->group(function () {


    Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::prefix('/asociaciones')->group(function () {
            Route::get('/', 'AsociacionesController@index')->name('dashboardAsociaciones');
            Route::get('/crear', 'AsociacionesController@create')->name('dashboardAsociacionesNueva')->middleware(['admin']);
            Route::get('/store', 'AsociacionesController@store')->middleware(['admin']);
            Route::match(['get', 'post'],'/{asociacion}/{tab?}', 'AsociacionesController@show')->name('dashboardAsociacion')->where('asociacion', '[0-9]+');
            Route::put('/{id}/update/{tab?}', 'AsociacionesController@update')->middleware(['admin'])->where('id', '[0-9]+');
            Route::put('/{id}/updateUsers', 'AsociacionesController@updateUsers')->middleware(['admin'])->where('id', '[0-9]+');
            Route::post('/delete/{asociacion}', 'AsociacionesController@delete')->name('dashboardAsociacionDelete')->where('asociacion', '[0-9]+');
        });

        Route::prefix('/usuarios')->group(function () {
            Route::get('/', 'UsuariosController@index')->name('dashboardUsuarios')->middleware(['admin']);
            Route::get('/crear', 'UsuariosController@create')->name('dashboardUsuariosNuevo')->middleware(['admin']);
            Route::get('/store', 'UsuariosController@store')->middleware(['admin']);
            Route::get('/{usuario}/{tab?}', 'UsuariosController@show')->name('dashboardUsuario')->where('usuario', '[0-9]+')->middleware(['admin']);
            Route::any('/{id}/update', 'UsuariosController@update')->middleware(['admin'])->where('id', '[0-9]+');
            Route::any('/{id}/updateRol', 'UsuariosController@updateRol')->middleware(['admin'])->where('id', '[0-9]+');
            Route::post('/delete/{usuario}', 'UsuariosController@delete')->name('dashboardUsuarioDelete')->where('usuario', '[0-9]+')->middleware(['admin']);
        });
    });
});
