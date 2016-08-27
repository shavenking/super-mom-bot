<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Http\Requests;

class TelegramController extends Controller
{
    public function webhook(Request $request, Arr $arr)
    {
        if ($request->has('message')) {
            $message = $request->get('message');
            $chatId = $arr->get($message, 'chat.id');

            return response()->json([
                'method' => 'sendMessage',
                'chat_id' => $chatId,
                'text' => 'ok'
            ]);
        }

        return;
    }
}
