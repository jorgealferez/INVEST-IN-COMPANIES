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
            Route::match(['get', 'post'],'/', 'AsociacionesController@index')->name('dashboardAsociaciones');
            Route::get('/crear', 'AsociacionesController@create')->name('dashboardAsociacionesNueva')->middleware(['admin']);
            Route::get('/store', 'AsociacionesController@store')->middleware(['admin']);
            Route::match(['get', 'post'],'/{asociacion}', 'AsociacionesController@show')->name('dashboardAsociacion')->where('asociacion', '[0-9]+');
            Route::put('/{id}/update', 'AsociacionesController@update')->middleware(['admin'])->where('id', '[0-9]+');
            Route::put('/{id}/updateUsers', 'AsociacionesController@updateUsers')->middleware(['admin'])->where('id', '[0-9]+');
            Route::post('/delete/{asociacion}', 'AsociacionesController@delete')->name('dashboardAsociacionDelete')->where('asociacion', '[0-9]+');
            
            Route::get('/search', 'AsociacionesController@search')->name('searchAsociaciones');
        });
        
        Route::prefix('/ofertas')->group(function () {
            Route::match(['get', 'post'],'/', 'OfertasController@index')->name('dashboardOfertas');
            Route::get('/crear', 'OfertasController@create')->name('dashboardOfertasNueva');
            Route::get('/store', 'OfertasController@store');
            Route::match(['get', 'post'],'/{oferta}', 'OfertasController@show')->name('dashboardOferta')->where('oferta', '[0-9]+');
            Route::put('/{id}/update', 'OfertasController@update')->where('id', '[0-9]+');
            Route::put('/{id}/updateUsers', 'OfertasController@updateUsers')->middleware(['admin'])->where('id', '[0-9]+');
            Route::post('/delete/{oferta}', 'OfertasController@delete')->name('dashboardOfertaDelete')->where('oferta', '[0-9]+');
            
            Route::get('/search', 'OfertasController@search')->name('searchOfertas');
        });

        Route::prefix('/usuarios')->group(function () {
            Route::match(['get', 'post'],'/', 'UsuariosController@index')->name('dashboardUsuarios')->middleware(['admin']);
            Route::get('/crear', 'UsuariosController@create')->name('dashboardUsuariosNuevo')->middleware(['admin']);
            Route::get('/store', 'UsuariosController@store')->middleware(['admin']);
            Route::get('/{usuario}', 'UsuariosController@show')->name('dashboardUsuario')->where('usuario', '[0-9]+')->middleware(['admin']);
            Route::get('/perfil', 'UsuariosController@profile')->name('perfilUsuario')->where('usuario', '[0-9]+');
            Route::any('/perfilUpdate', 'UsuariosController@profileUpdate');
            Route::any('/{id}/update', 'UsuariosController@update')->middleware(['admin'])->where('id', '[0-9]+');
            Route::any('/{id}/updateRol', 'UsuariosController@updateRol')->middleware(['admin'])->where('id', '[0-9]+');
            Route::post('/delete/{usuario}', 'UsuariosController@delete')->name('dashboardUsuarioDelete')->where('usuario', '[0-9]+')->middleware(['admin']);

            Route::get('/search', 'UsuariosController@search')->name('searchUsuarios');
        });
    });
});
