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
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');

Route::middleware('verified','auth')
    ->namespace('App\Http\Controllers\Web')
    ->prefix('admin')->group(function (){

    Route::resource('tasks','TaskController');

   Route::get('/all/tasks','TaskAdminController@index')
       ->name('admin.task.index')
       ->middleware('isAdmin');

   Route::get('/all/{user_id}/tasks/{task_id}','TaskAdminController@show')
       ->name('admin.task.show')
       ->middleware('isAdmin');
});
