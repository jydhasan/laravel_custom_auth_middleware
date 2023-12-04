<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

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
// UserAuthController
Route::get('login', [UserAuthController::class, 'login'])->middleware('alreadyloggedin');
Route::get('register', [UserAuthController::class, 'register'])->middleware('alreadyloggedin');
Route::post('register-user', [UserAuthController::class, 'registerUser'])->name('register-user');
// login-user
Route::post('login-user', [UserAuthController::class, 'loginUser'])->name('login-user');
// dashboard
Route::get('dashboard', [UserAuthController::class, 'dashboard'])->middleware('isLoggedIn');
// logout
Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');