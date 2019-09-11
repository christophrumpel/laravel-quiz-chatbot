<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use BotMan\Drivers\Telegram\TelegramDriver;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        //info('Incoming call', \request()->all());

        $botman = app('botman');

        try {
            $botman->listen();
        } catch (\Exception $e) {
            info('error Incoming call', \request()->all());
            info('error catched: '.$e->getMessage());
            $fromId = request()->all()['message']['from']['id'] ?? request()->all()['callback_query']['from']['id'];

            $botman->say('🚧 Something did not go as planned 😕 We are sorry.', $fromId, TelegramDriver::class);
            $botman->say('Please try to /start the game again or contact Christoph on Twitter https://twitter.com/christophrumpel.',
                $fromId, TelegramDriver::class);

        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     *
     * @param BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
}
