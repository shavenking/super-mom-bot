<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// only the guy has token is able to set webhook
Route::get('/set-webhook', function () {
    $token = Request::get('token');

    if (env('TELEGRAM_BOT_TOKEN') !== $token) {
        return;
    }

    $url = route('telegram.webhook');

    Telegram::setWebhook(compact('url'));

    return 'ok';
});

Route::get('/webhook' . env('TELEGRAM_BOT_TOKEN'), function () {
    if (Request::has('message')) {
        $message = Request::get('message');
        $chatId = Arr::get($message, 'chat.id');

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => 'ok'
        ]);
    }

    return;
})->name('telegram.webhook');
