<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('webhook', App\Http\Controllers\WebHookController::class)->name('webhook.receive');
