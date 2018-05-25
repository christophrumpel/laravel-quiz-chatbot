<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

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
        $this->say('Hey '.$this->bot->getUser()->getFirstName().' 👋');
        $this->askIfReady();
    }

    private function askIfReady()
    {
        $question = Question::create('Welcome to the *LaravelQuiz Chatbot*! How well do you know your favourite PHP framework? Are you ready for the quiz?')
            ->addButtons([
                Button::create('Sure')->value('yes'),
                Button::create('Not now')->value('no'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->getValue() === 'yes') {
                $this->say('Perfect!');
                return $this->bot->startConversation(new QuizConversation());
            }

            $this->say('If you change your opinion, you can start the quiz at any time using the start command or by typing "start".');
            $this->say('😒');
        });
    }
}
