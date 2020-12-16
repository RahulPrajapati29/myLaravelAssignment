<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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
    return view('auth.login');
});

Auth::routes();


Route::resource('user', 'App\Http\Controllers\HomeController');

Route::resource('post', 'App\Http\Controllers\PostsController');

Route::get('/admin/permission', [App\Http\Controllers\AdminController::class, 'create']);

Route::patch('/admin', [App\Http\Controllers\AdminController::class, 'store']);

Route::resource('admin', 'App\Http\Controllers\AdminController');
