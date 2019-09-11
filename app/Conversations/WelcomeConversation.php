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
        $this->say('Hey '.$this->bot->getUser()
                ->getFirstName().' 👋');
        $this->bot->typesAndWaits(1);
        $this->askIfReady();
    }

    private function askIfReady()
    {
        $question = Question::create('Welcome to the *3rd* edition of the ✨*LaravelQuiz Chatbot*✨! How well do you know your favourite PHP framework and its eco-system? Let\'s find out! Are you ready for the quiz?')
            ->addButtons([
                Button::create('Yes 😎')
                    ->value('yes'),
                Button::create('Not now 😐')
                    ->value('no'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $this->bot->typesAndWaits(1);
            if ($answer->getValue() === 'yes') {
                $this->say('Perfect!');
                $this->bot->typesAndWaits(1);

                return $this->bot->startConversation(new QuizConversation());
            }

            $this->say('Ok, then another time.');
            $this->say('If you change your opinion, you can start the quiz at any time using the /start command or by typing "start".');
        }, [
            'parse_mode' => 'Markdown',
        ]);
    }
}
