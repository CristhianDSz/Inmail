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
    return redirect('/app/correspondence');
});
Route::get('app/dependencies', 'DependenciesController@render')->name('dependencies.render');
Route::get('dependencies/employees', 'DependenciesController@getWithEmployees');
Route::apiResource('dependencies', 'DependenciesController');
Route::get('app/employees', 'EmployeesController@render')->name('employees.render');
Route::apiResource('employees', 'EmployeesController');
Route::get('app/third-parties', 'ThirdPartiesController@render')->name('third_parties.render');
Route::apiResource('third-parties', 'ThirdPartiesController');
Route::get('app/cities', 'CitiesController@index');
Route::get('app/correspondence', 'RecordsController@render')->name('correspondence.render');
Route::apiResource('records', 'RecordsController');

Route::group(['prefix' => 'config'], function () {
    Route::resource('roles', 'RolesController');
    Route::apiResource('permissions', 'PermissionsController');
    Route::resource('companies', 'CompaniesController');
    Route::resource('users', 'UsersController');
});

Route::post('app/records/pdf', 'RecordsController@getPdf')->name('records.pdf');
Route::get('formats', 'FormatsController@index')->name('formats.index');
Route::post('formats', 'FormatsController@filter')->name('formats.filter');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
