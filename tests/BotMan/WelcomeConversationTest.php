<?php

namespace Tests\BotMan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class WelcomeConversationTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->bot->setUser([
            'id' => 5,
            'first_name' => 'Jim',
            'last_name' => 'Stevens',
        ]);
    }

    /**
     * @test
     */
    public function it_welcomes_user_and_replies_to_ready_answer_negative()
    {
        $readyQuestion = Question::create('Welcome to the *LaravelQuiz Chatbot* version 2! How well do you know your favourite PHP framework? Are you ready for the quiz?')
            ->addButtons([
                Button::create('Sure')->value('yes'),
                Button::create('Not now')->value('no'),
            ]);

        $this->bot->receives('/start')
            ->assertReply('Hey Jim 👋')
            ->assertTemplate($readyQuestion, true)
            ->receives('no')
            ->assertReply('😒')
            ->assertReply('If you change your opinion, you can start the quiz at any time using the start command or by typing "start".');
    }

    /**
     * @test
     */
    public function it_welcomes_user_and_replies_to_ready_answer_positive()
    {
        $readyQuestion = Question::create('Welcome to the *LaravelQuiz Chatbot* version 2! How well do you know your favourite PHP framework? Are you ready for the quiz?')
            ->addButtons([
                Button::create('Sure')->value('yes'),
                Button::create('Not now')->value('no'),
            ]);

        $this->bot->receives('/start')
            ->assertReply('Hey Jim 👋')
            ->assertReply($readyQuestion)
            ->receives('yes')
            ->assertReply('Perfect!');
    }
}
