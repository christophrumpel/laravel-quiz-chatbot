<?php

namespace App\Http\Middleware;

use BotMan\BotMan\BotMan;
use Illuminate\Support\Facades\Cache;
use BotMan\BotMan\Interfaces\Middleware\Heard;
use BotMan\BotMan\Interfaces\Middleware\Sending;
use BotMan\BotMan\Interfaces\Middleware\Captured;
use BotMan\BotMan\Interfaces\Middleware\Matching;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class PreventDoubleClicks implements Captured
{
    /**
     * Handle a captured message.
     *
     * @param IncomingMessage $message
     * @param BotMan $bot
     * @param $next
     * @return mixed
     */
    public function captured(IncomingMessage $message, $next, BotMan $bot)
    {
        // Check if message is a double click
        $messageId = $message->getPayload()['message_id'];
        $identifier = 'already_send_message_'.$messageId.'_'.$message->getConversationIdentifier();

        if(Cache::has($identifier)) {
            info('message is a duplicate');
            exit;
        }

        // Store message id
        Cache::put($identifier, true, 30);

        return $next($message);
    }
}
