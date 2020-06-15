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
Route::get('third-parties/data', 'ThirdPartiesController@getData');
Route::apiResource('third-parties', 'ThirdPartiesController');
Route::get('app/cities', 'CitiesController@index');
Route::get('app/correspondence', 'RecordsController@render')->name('correspondence.render');
Route::get('app/records/{record}/search', 'RecordsController@search');
Route::apiResource('records', 'RecordsController');

Route::group(['prefix' => 'config'], function () {
    Route::resource('roles', 'RolesController');
    Route::apiResource('permissions', 'PermissionsController');
    Route::resource('companies', 'CompaniesController');
    Route::get('users/password', 'UsersController@editPassword')->name('users.edit.password');
    Route::patch('users/{user}/restore', 'UsersController@restore')->name('users.restore.user');
    Route::patch('users/{user}/password', 'UsersController@updatePassword')->name('users.update.password');
    Route::resource('users', 'UsersController');
});

Route::post('app/records/pdf', 'RecordsController@getPdf')->name('records.pdf');
Route::get('formats', 'FormatsController@index')->name('formats.index');
Route::get('formats/pdf/{first_date}/{second_date}', 'FormatsController@getPdf')->name('formats.pdf');
Route::get('app/tracking', 'TrackingController@index')->name('tracking.index');
Route::patch('tracking/{record}', 'TrackingController@update')->name('tracking.update');

//Record Events
Route::get('record-events', 'RecordEventsController@index')->name('events.index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
