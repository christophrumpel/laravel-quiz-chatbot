<?php

namespace App\Conversations;

use App\Highscore;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class PrivacyConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askAboutDataDeletion();
    }

    private function askAboutDataDeletion()
    {
        $user = Highscore::where('chat_id', $this->bot->getUser()->getId())->first();

        if ($user) {
            $this->bot->reply('We have stored your name and chat ID for showing you in the highscore.');
            $question = Question::create('Do you want to get deleted?')->addButtons([
                Button::create('Yes please')->value('yes'),
                Button::create('Not now')->value('no'),
            ]);

            $this->ask($question, function (Answer $answer) {
                if ($answer->getValue() === 'yes') {
                    Highscore::deleteUser($this->bot->getUser()->getId());
                    $this->bot->reply('Done! Your data has been deleted.');

                } elseif ($answer->getValue() === 'no') {
                    $this->bot->reply('Great to keep you 👍');
                } else {
                    $this->repeat('Sorry, I did not get that. Please use the buttons.');
                }
            });
        } else {
            $this->bot->reply('We have not stored any data of you.');
        }
    }
}
