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

Route::get('/', function () {
    return view('index');
});
Route::resource('vehicule' , 'VehiculeController');//creer les routes pour le controlleur vers les views
Route::post('vehicule/{id}/reserver' , 'VehiculeController@reserver');
Route::resource('mission' , 'MissionController');
//pour activer l'email
Route::get('/mission/{id}/validate' , 'Controller@validate');
Route::get('/mission/{id}/pdf','Controller@getPdf');

Auth::routes(); //gerer les routes de l'authentification 
Route::resource('depence','DepenceController');
Route::get('/listAgents' ,'UserController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verifyEmail','Auth\RegisterController@verifyEmail')->name('verifyEmail');
Route::get('/verify/{email}/{confirmation_token}','Auth\RegisterController@sendEmailDone')->name('verify');
