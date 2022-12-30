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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\ImageController::class, 'album'])->name('album');
Route::get('/album', [App\Http\Controllers\ImageController::class, 'index'])->name('album');
Route::post('/album', [App\Http\Controllers\ImageController::class, 'store'])->name('album.store');
Route::post('/album/add-more', [App\Http\Controllers\ImageController::class, 'addImage'])->name('image.store');
Route::post('/album/add-image', [App\Http\Controllers\ImageController::class, 'addAlbumImage'])->name('album.image.store');
Route::get('/albums/{album}', [App\Http\Controllers\ImageController::class, 'show'])->name('album.show');
Route::post('/image/delete/{image}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('image.delete');
