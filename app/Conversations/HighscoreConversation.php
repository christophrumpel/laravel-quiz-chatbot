<?php

namespace App\Conversations;

use App\Highscore;
use BotMan\BotMan\Messages\Conversations\Conversation;

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
            return "{$user->rank} - {$user->name} *{$user->points} points*";
        });

        $this->say('Here is the current highscore. Do you think you can do better? Start the quiz: /startquiz.');
        $this->say('🏆 HIGHSCORE 🏆');
        $this->say($topUsers->implode("\n"), ['parse_mode' => 'Markdown']);
    }
}
