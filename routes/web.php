<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login',[AuthController::class,'login'])->name('login.auth');

Route::prefix('admin')->middleware('auth:admin')->group(function(){

    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/users')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('user.list');


        Route::get('usersindex', [UserController::class, 'userindex'])->name('user.userindex');

    });

});