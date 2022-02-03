<?php

use App\Specialization;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/', 'StartWebController@get');
Route::resource('/employeers', 'EmployeersController');
Route::get('/{id}','EmployeersController@show')->name('profile');
Route::delete('delete/{id}','EmployeersController@destroy')->name('remove');
