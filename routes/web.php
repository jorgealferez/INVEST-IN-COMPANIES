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

Route::namespace('dashboard')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('/asociaciones')->group(function () {
        Route::get('/', 'AsociacionesController@index')->name('dashboardAsociaciones');
        Route::get('/crear', 'AsociacionesController@create')->name('dashboardAsociacionesNueva')->middleware(['admin']);
        Route::get('/store', 'AsociacionesController@store')->middleware(['admin']);
        // Route::get('/{Asociaciones}', 'AsociacionesController@show')->name('dashboardAsociacion')->middleware(['admin'])->where('Asociaciones', '[0-9]+');
        Route::post('/delete/{asociacion}', 'AsociacionesController@delete')->name('dashboardAsociacionDelete')->where('asociacion', '[0-9]+');
        Route::match(['get', 'post'],'/{asociacion}/{tab?}', 'AsociacionesController@show')->name('dashboardAsociacion')->where('asociacion', '[0-9]+');
        Route::put('/{id}/update/{tab?}', 'AsociacionesController@update')->middleware(['admin'])->where('id', '[0-9]+');
        Route::put('/{id}/updateUsers', 'AsociacionesController@updateUsers')->middleware(['admin'])->where('id', '[0-9]+');

    });
});
