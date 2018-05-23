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

        if ($topUsers->count() == 0) {
            $this->bot->reply('The highscore is still empty. Be the first one! 👍');
        } else {
            $topUsersMessage = '';

            $topUsers->each(function ($user) use (&$topUsersMessage) {
                $topUsersMessage .= $user->rank.' - '.$user->name.' '.$user->points."points \n";
            });

            $this->bot->reply('Here is the current highscore. Do you think you can do better? Start the quiz: /startquiz.');
            $this->bot->reply('🏆 HIGHSCORE 🏆');
            $this->bot->reply($topUsersMessage);
        }
    }
}
