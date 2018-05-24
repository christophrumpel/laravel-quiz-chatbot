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

        if (! $user) {
            return $this->say('We have not stored any data of you.');
        }

        $this->say('We have stored your name and chat ID for showing you in the highscore.');
        $question = Question::create('Do you want to get deleted?')->addButtons([
            Button::create('Yes please')->value('yes'),
            Button::create('Not now')->value('no'),
        ]);

        $this->ask($question, function (Answer $answer) {
            switch ($answer->getValue()) {
                case 'yes':
                    Highscore::deleteUser($this->bot->getUser()->getId());
                    return $this->say('Done! Your data has been deleted.');
                case 'no':
                    return $this->say('Great to keep you 👍');
                default:
                    return $this->repeat('Sorry, I did not get that. Please use the buttons.');
            }
        });
    }
}
