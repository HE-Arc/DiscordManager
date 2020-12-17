<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;
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
    'middleware' => ['auth','refreshDiscordToken','sessionHasDiscordToken']
], function (){
    Route::prefix('dashboard')->group(function () {
        Route::get("/", [DashboardController::class, 'servers'])->name("dashboard");
    });
    Route::get('/discord/bot-added', [LoginController::class, 'handleBotCallback']);
    Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
});

Route::group([
    'middleware' => ['auth','refreshDiscordToken','sessionHasDiscordToken',"checkAccessToServer"]
], function (){
    Route::get('/add-bot/{id}',[LoginController::class, 'addBot'])->name("add-bot");
});


Route::group([
    'middleware' => ['auth','refreshDiscordToken','sessionHasDiscordToken',"checkBotAdded","checkAccessToServer"]
], function (){

    Route::prefix('dashboard')->group(function () {

        Route::get('/about-server/{id}', [DashboardController::class, 'aboutServer'])->name("dashboard.about");

        Route::get('/{id}', [DashboardController::class, 'server'])->name("lel");
        Route::post('/update/{id}', [DashboardController::class, 'update'])->name("dashboard.update");
    });


});


