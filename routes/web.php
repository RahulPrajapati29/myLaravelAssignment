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

Route::middleware(["isAdmin"])->prefix('admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get('post',[App\Http\Controllers\Admin\PostsController::class, 'index']);
    Route::get('post/list',[App\Http\Controllers\Admin\PostsController::class, 'showDataTable'])->name('post.list');
    Route::resource('post', 'App\Http\Controllers\Admin\PostsController');
    Route::get('permission', [App\Http\Controllers\Admin\PermissionController::class, 'create']);
    Route::post('permission', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permission.store');

});
