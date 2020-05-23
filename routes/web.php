<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});


Route::get('/', 'EmployeeController@index')->name('home');
Route::post('/addEmployee', 'EmployeeController@addEmployee')->name('addEmployee');
Route::post('/updateEmployee', 'EmployeeController@updateEmployee')->name('updateEmployee');
Route::post('/deleteEmployee', 'EmployeeController@deleteEmployee')->name('deleteEmployee');
Route::any('/result', 'EmployeeController@search')->name('search');
Route::get('/autocomplete',array('as' => 'autocomplete', 'uses'=>'EmployeeController@autoComplete'));
