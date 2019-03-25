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

Route::get('mailable', function () {
    $nuevo = App\User::find(21);
    $usuario = App\User::find(1);

    return new App\Mail\TestEmail($usuario, $nuevo);
});


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'PublicController@index')->name('home');
Route::get('/vende-tu-empresa', 'PublicController@vende')->name('vendeEmpresa');
Route::put('/vende-tu-empresa/contacto', 'PublicController@vendeContacto')->name('vendeEmpresaContacto');
Route::post('/inversion', 'PublicController@inversion')->name('inversion')->middleware(['auth', 'verified']);
Route::get('/compra-tu-empresa', 'PublicController@compra')->name('compraEmpresa');
Route::any('/buscador', 'PublicController@buscador')->name('buscador');
Route::get('/busca-socio', 'PublicController@socio')->name('socio');
Route::get('/quienes-somos', 'PublicController@quienes')->name('quienesSomos');
Route::get('/origintal', 'PublicController@origintal')->name('origintal');
Route::post('/registro', 'PublicController@registro');

// Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Dashboard')->group(function () {
    Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/ajax/{type}', array(
            'as'    => 'items.type',
            'uses'  => 'BoardController@getElementosDashboard'
        ))->where('type', 'solicitudesEmpresa|second|third');

        Route::get('/', 'BoardController@index')->name('dashboard');
        Route::post('/notificacion/{id}/delete', 'BoardController@borrarNotificacion')->name('boorarNotificacion');

        Route::prefix('/asociaciones')->group(function () {
            Route::match(['get', 'post'], '/', 'AsociacionesController@index')->middleware(['asesor'])->name('dashboardAsociaciones');
            Route::get('/crear', 'AsociacionesController@create')->name('dashboardAsociacionesNueva')->middleware(['admin']);
            Route::get('/store', 'AsociacionesController@store')->middleware(['admin']);
            Route::match(['get', 'post'], '/{asociacion}', 'AsociacionesController@show')->name('dashboardAsociacion')->where('asociacion', '[0-9]+');
            Route::put('/{id}/update', 'AsociacionesController@update')->middleware(['asesor'])->where('id', '[0-9]+');
            Route::put('/{id}/updateUsers', 'AsociacionesController@updateUsers')->middleware(['asesor'])->where('id', '[0-9]+');
            Route::post('/delete/{asociacion}', 'AsociacionesController@delete')->name('dashboardAsociacionDelete')->where('asociacion', '[0-9]+');

            Route::get('/search', 'AsociacionesController@search')->name('searchAsociaciones');
        });

        Route::prefix('/ofertas')->middleware(['editor'])->group(function () {
            Route::match(['get', 'post'], '/', 'OfertasController@index')->name('dashboardOfertas');
            Route::get('/crear', 'OfertasController@create')->name('dashboardOfertasNueva');
            Route::get('/store', 'OfertasController@store');
            Route::match(['get', 'post'], '/{oferta}', 'OfertasController@show')->name('dashboardOferta')->where('oferta', '[0-9]+');
            Route::put('/{id}/update', 'OfertasController@update')->where('id', '[0-9]+');
            Route::put('/{id}/updateUsers', 'OfertasController@updateUsers')->where('id', '[0-9]+');
            Route::post('/delete/{oferta}', 'OfertasController@delete')->name('dashboardOfertaDelete')->where('oferta', '[0-9]+');
            Route::put('/{id}/updateEstado', 'OfertasController@updateEstado')->name('dashboardOfertasUpdateEstado')->where('id', '[0-9]+');
            Route::put('/{id}/updateEstadoInversor', 'OfertasController@updateEstadoInversor')->name('dashboardOfertasUpdateEstadoInversor')->where('id', '[0-9]+');

            Route::get('/search', 'OfertasController@search')->name('searchOfertas');
        });

        Route::get('/perfil', 'UsuariosController@profile')->name('perfilUsuario')->where('usuario', '[0-9]+');
        Route::any('/perfilUpdate', 'UsuariosController@profileUpdate');


        Route::prefix('/usuarios')->group(function () {
            Route::match(['get', 'post'], '/', 'UsuariosController@index')->name('dashboardUsuarios')->middleware(['asesor']);
            Route::get('/crear', 'UsuariosController@create')->name('dashboardUsuariosNuevo')->middleware(['asesor']);
            Route::get('/store', 'UsuariosController@store')->middleware(['asesor']);
            Route::get('/{usuario}', 'UsuariosController@show')->name('dashboardUsuario')->where('usuario', '[0-9]+')->middleware(['asesor']);
            Route::any('/{id}/update', 'UsuariosController@update')->middleware(['asesor'])->where('id', '[0-9]+');
            Route::any('/{id}/updateEstado', 'UsuariosController@updateEstado')->middleware(['admin'])->where('id', '[0-9]+');
            Route::any('/{id}/updateRol', 'UsuariosController@updateRol')->middleware(['asesor'])->where('id', '[0-9]+');
            Route::any('/{id}/reiniciarPassword', 'UsuariosController@reiniciarPassword')->name('UsuarioResetPassword')->middleware(['admin'])->where('id', '[0-9]+');
            Route::post('/delete/{usuario}', 'UsuariosController@delete')->name('dashboardUsuarioDelete')->where('usuario', '[0-9]+')->middleware(['admin']);

            Route::get('/search', 'UsuariosController@search')->name('searchUsuarios');
            Route::post('/searchUsuariosByAsociacion', 'UsuariosController@searchUsuariosByAsociacion')->name('searchUsuariosByAsociacion');
            Route::post('/searchpoblacionesbyprovincia', 'UsuariosController@searchPoblacionesByProvincia')->name('searchpoblacionesbyprovincia');
        });

        Route::get('/inversiones', 'InversionesController@index')->middleware(['auth', 'verified'])->name('dashboardInversiones');
    });
});
