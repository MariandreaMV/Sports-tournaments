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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// General routes
Route::group(['middleware' => ['auth']], function() {
  Route::get('/new-team', 'HomeController@newTeam')->name('newTeam');
  Route::get('/new-register', 'HomeController@register');
  Route::post('/new-register/create', 'HomeController@create');
});


// Admin panel
Route::group(['middleware' => ['auth']], function() {
  Route::get('admin', 'Admin\AdminController@index');
  Route::resource('admin/roles', 'Admin\RolesController');
  Route::resource('admin/permissions', 'Admin\PermissionsController');
  Route::resource('admin/users', 'Admin\UsersController');
  Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
  Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
  Route::resource('admin/teams', 'Admin\\teamsController');
  Route::resource('admin/tournaments', 'Admin\\tournamentsController');
  Route::resource('admin/registers', 'Admin\\RegistersController');
});
