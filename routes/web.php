<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () { return view('welcome');});

Auth::routes();

Route::prefix('admin')->namespace('Admin')->group(function () {

    /*
      |--------------------------------------------------------------------------
      | HOME
      |--------------------------------------------------------------------------
     */
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index']);
    // Route::post('/log', [App\Http\Controllers\Admin\HomeController::class, 'showlog']);
    /*
      |--------------------------------------------------------------------------
      | USER
      |--------------------------------------------------------------------------
     */
    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::post('/user', [App\Http\Controllers\Admin\UserController::class, 'show']);
    Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create']);
    Route::post('/user/create', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.create');
    Route::get('/user/{id}/edit',  [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::get('/user/{id}/manage',  [App\Http\Controllers\Admin\UserController::class, 'manage']);
    Route::post('/user/manage',  [App\Http\Controllers\Admin\UserController::class, 'manage_store']);
    Route::post('/user/update',  [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
    Route::post('/user/cekemail',  [App\Http\Controllers\Admin\UserController::class, 'cekemail']);
    Route::delete('/user',  [App\Http\Controllers\Admin\UserController::class, 'destroy']);
  
  
    /*
      |--------------------------------------------------------------------------
      | ARTIKEL
      |--------------------------------------------------------------------------
     */
    Route::get('/articles', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('/articles/json', [App\Http\Controllers\Admin\PostController::class, 'json']);
    Route::post('/articles', [App\Http\Controllers\Admin\PostController::class, 'show']);
    Route::get('/articles/create', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('/articles/create', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('/articles/edit/{uuid}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::post('/articles/update', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::delete('/articles', [App\Http\Controllers\Admin\PostController::class, 'destroy']);
  
    /*
      |--------------------------------------------------------------------------
      | ARTIKEL KATEGORI
      |--------------------------------------------------------------------------
     */
    Route::get('/articles/category', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'index']);
    Route::get('/articles/category/json', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'json']);
    Route::post('/articles/category', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'show']);
    Route::get('/articles/category/create', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'create']);
    Route::post('/articles/category/create', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'store']);
    Route::get('/articles/category/{id}/edit', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'edit']);
    Route::post('/articles/category/update', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'update']);
    Route::delete('/articles/category', [App\Http\Controllers\Admin\ArticleCategoryController::class, 'destroy']);
  
    /*
      |--------------------------------------------------------------------------
      | ARTIKEL LABEL
      |--------------------------------------------------------------------------
     */
    Route::get('/articles/label', [App\Http\Controllers\Admin\ArticleLabelController::class, 'index']);
    Route::get('/articles/label/json', [App\Http\Controllers\Admin\ArticleLabelController::class, 'json']);
    Route::post('/articles/label', [App\Http\Controllers\Admin\ArticleLabelController::class, 'show']);
    Route::get('/articles/label/create', [App\Http\Controllers\Admin\ArticleLabelController::class, 'create']);
    Route::get('/articles/label/{id}/edit', [App\Http\Controllers\Admin\ArticleLabelController::class, 'edit']);
    Route::post('/articles/label/store', [App\Http\Controllers\Admin\ArticleLabelController::class, 'store']);
    Route::delete('/articles/label', [App\Http\Controllers\Admin\ArticleLabelController::class, 'destroy']);
  });
  
  Route::middleware('role:operator')->prefix('operator')->namespace('Operator')->group(function () {
  
  });


// Route::get('{any}', [App\Http\Controllers\PageController::class, 'index']);
  
