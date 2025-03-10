<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('clear', [Controller::class, 'getArtisanCommand']);
Route::any("/privacy-policy", [LoginController::class, 'privacy']);

Route::get('/', function () {
    return view('homepage');
});

Route::get('/pmmvy-intro', function () {
    return view('user/pmmvy_intro');
});

Route::get('/PMMVY-Closure-of-Old-Benefit', function () {
    return view('user/ourmission');
});

Route::get('/pmmvy-programme', function () {
    return view('user/pmmvy_programme');
});

Route::get('/contact', function () {
    return view('user/contact');
});

Route::get('/msk-intro', function () {
    return view('user/msk_intro');
});

Route::match(['get', 'post'], '/add-new-user', [CandidateController::class, 'add_user'])->name('admin.add_user');;
Route::get('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
