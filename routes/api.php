<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/webhook' . env('TELEGRAM_BOT_TOKEN'), function (Request $request) {
    if ($request->has('message')) {
        $message = $request->get('message');
        $chatId = $message['chat']['id'];

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => 'ok'
        ]);
    }

    return;
})->name('telegram.webhook');
