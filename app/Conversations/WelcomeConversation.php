<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class WelcomeConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->welcomeUser();
    }

    private function welcomeUser()
    {
        $this->bot->reply('Hey '.$this->bot->getUser()->getFirstName().' 👋');
        $this->askIfReady();
    }

    private function askIfReady()
    {
        $question = Question::create('Welcome to the *LaravelQuiz Chatbot*! How well do you know your favourite PHP framework? Are you ready for the quiz?')
            ->addButtons([
                Button::create('Sure')->value('yes'),
                Button::create('Now now')->value('no'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->getValue() === 'yes') {
                $this->bot->reply('Perfect!');
                $this->bot->startConversation(new QuizConversation());
            } else {
                $this->bot->reply('😒');
                $this->bot->reply('If you change your opinion, you can start the quiz at any time using the start command or by typing "start".');
            }
        });
    }
}
