<?php

use App\Http\Controllers\WebHookController;
use App\Http\Middleware\LogWebhookRequests;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('webhook', [WebHookController::class, 'webhook'])
    ->name('webhook.receive')
    ->middleware(LogWebhookRequests::class);
