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

Route::get('/', 'HomeController@index');
Route::get('app/dependencies', 'DependenciesController@render')->name('dependencies.render');
Route::apiResource('dependencies', 'DependenciesController');
Route::get('app/employees', 'EmployeesController@render')->name('employees.render');
Route::apiResource('employees', 'EmployeesController');
Route::get('app/third-parties', 'ThirdPartiesController@render')->name('third_parties.render');
Route::apiResource('third-parties', 'ThirdPartiesController');
Route::get('app/cities', 'CitiesController@index');
