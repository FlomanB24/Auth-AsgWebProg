<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckUserLogin;

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
    return redirect()->route('login-page');
});

Route::get('/login', function () {
    return view('login');
})->name('login-page');

Route::get('/register', function () {
    return view('register');
})->name('register-page');

Route::get('/general', function () {
    return view('general');
})->name('general')->middleware([CheckUserLogin::class]);

Route::get('/admin', function () {
    return view('admin');
})->name('admin')->middleware([CheckUserLogin::class])->middleware([CheckAuth::class]);


Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google-callback');

Route::get('/auth/github', [GithubController::class, 'redirectToGithub'])->name('github-login');
Route::get('/auth/github/callback', [GithubController::class, 'handleGithubCallback'])->name('github-callback');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

