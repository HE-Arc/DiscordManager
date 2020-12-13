<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\DashboardController;
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
Route::redirect("/","/welcome");
Route::view("/welcome","welcome.index")->name("welcome");

Route::group([
    'middleware' => ['redirectIfAuth']
], function (){
    Route::get('/login', [LoginController::class, 'redirectToProvider'])->name("login");
    Route::get('/login-callback', [LoginController::class, 'loginCallback']);
});

Route::group([
    'middleware' => ['auth','refresh','sessionHasDiscordToken']
], function (){
    Route::get("/home", [HomeController::class, 'index'])->name("home");
    Route::get('/add-bot/{id}',[LoginController::class, 'addBot'])->name("add-bot");
    Route::get('/discord/bot-added', [LoginController::class, 'handleBotCallback']);
    Route::get('/dashboard/{id}', [DashboardController::class, 'index'])->name("dashboard");
    Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
    Route::post('/dashboard/{id}', [DashboardController::class, 'update'])->name("dashboard");
    Route::view("/register","welcome")->name("register");
    Route::get("/test", [HomeController::class, 'apiTest'])->name("test");
});


