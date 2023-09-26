<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [App\Http\Controllers\LoginController::class, 'showForm']);
Route::post('login', [App\Http\Controllers\LoginController::class, 'handleSubmit']);

Route::post('webhook', App\Http\Controllers\WebhookController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('feed', App\Http\Controllers\FeedController::class);
});
