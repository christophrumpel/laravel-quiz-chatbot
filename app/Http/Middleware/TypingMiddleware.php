<?php

namespace App\Http\Middleware;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Heard;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class TypingMiddleware implements Heard
{

    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param \BotMan\BotMan\Messages\Incoming\IncomingMessage $message
     * @param BotMan $bot
     * @param $next
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMan $bot)
    {
        $bot->typesAndWaits(1);

        return $next($message);
    }
}
