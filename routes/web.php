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

Route::get('/', function () { return redirect('/home'); });
Route::get('/home', 'EndController@index');

Route::get('/CreateEnd', 'EndController@createEnd');
Route::post('/CreateEnd', 'EndController@storeEnd');
Route::get('/EditEnd/{endPointId}', 'EndController@GetEditEnd');
Route::post('/EditEnd/{endPointId}', 'EndController@PostEditEnd');
Route::post('/deleteEnd/{endPointId}', 'EndController@deleteEnd');

Route::get('/CreateAPI/{endPointId}', 'ApisController@createAPI');
Route::post('/CreateAPI/{endPointId}', 'ApisController@storeAPI');
Route::get('/EditAPI/{ApiId}', 'ApisController@GetEditAPI');
Route::post('/EditAPI/{ApiId}', 'ApisController@PostEditAPI');
Route::post('/deleteAPI/{ApiId}', 'ApisController@deleteAPI');

Route::get('/signin', 'AutenticationController@signin');
Route::post('/signin', 'AutenticationController@login');
Route::get('/logout', 'AutenticationController@logout');
Route::get('/CreateAcc', 'AutenticationController@createAcc');
Route::post('/CreateAcc', 'AutenticationController@store');

