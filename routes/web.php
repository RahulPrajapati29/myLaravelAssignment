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

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index']);

Route::resource('user', 'App\Http\Controllers\HomeController');

Route::resource('post', 'App\Http\Controllers\PostsController');

Route::get('/admin/permission', [App\Http\Controllers\PermissionController::class, 'create']);

Route::post('/admin/permission', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');


