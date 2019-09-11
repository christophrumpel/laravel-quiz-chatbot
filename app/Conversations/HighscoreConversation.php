<?php

namespace App\Conversations;

use App\Highscore;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer as BotManAnswer;
use BotMan\BotMan\Messages\Outgoing\Question as BotManQuestion;

class HighscoreConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->showHighscore();
    }

    private function showHighscore()
    {
        $topUsers = Highscore::topUsers();

        if (! $topUsers->count()) {
            return $this->say('The highscore is still empty. Be the first one! 👍');
        }

        $topUsers->transform(function ($user) {
            return "_{$user->rank} - {$user->name}_ *{$user->points} points*";
        });

        $this->say('Here is the current highscore showing the top 15 results.');
        $this->bot->typesAndWaits(1);
        $this->say('🏆 HIGHSCORE 🏆');
        $this->bot->typesAndWaits(1);
        $this->say($topUsers->implode("\n"), ['parse_mode' => 'Markdown']);
        $this->bot->typesAndWaits(2);
        $this->say("If you want to play another round click: /start \nOne of the ways to improve what you know about Laravel is by diving into https://laravelcoreadventures.com.");
    }

}
