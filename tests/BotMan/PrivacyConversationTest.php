<?php

namespace Tests\BotMan;

use App\Highscore;
use Tests\TestCase;
use BotMan\BotMan\Users\User;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class PrivacyConversationTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->bot->setUser([
            'id' => '5',
            'first_name' => 'Jim',
            'last_name' => 'Stevens',
        ]);
    }

    /**
     * @test
     */
    public function it_asks_about_deletion_but_no_user_given()
    {
        $this->bot->receives('/deletedata')->assertReply('We have not stored any data of you.');
    }

    /**
     * @test
     */
    public function it_asks_about_deletion_with_positive_answer()
    {
        Highscore::saveUser(new User('5', 'Jim', 'Stevens'), 100, 22);
        $question = $this->getAskAboutDeletionTemplate();

        $this->bot->receives('/deletedata')
            ->assertReply('We have stored your name and chat ID for showing you in the highscore.')
            ->assertTemplate($question, true)
            ->receives('yes')
            ->assertReply('Done! Your data has been deleted.');
    }

    /**
     * @test
     */
    public function it_asks_about_deletion_with_negative_answer()
    {
        Highscore::saveUser(new User('5', 'Jim', 'Stevens'), 100, 22);
        $question = $this->getAskAboutDeletionTemplate();

        $this->bot->receives('/deletedata')
            ->assertReply('We have stored your name and chat ID for showing you in the highscore.')
            ->assertTemplate($question, true)
            ->receives('no')
            ->assertReply('Great to keep you 👍');
    }

    /**
     * @test
     */
    public function it_asks_about_deletion_with_unrecognized_answer()
    {
        Highscore::saveUser(new User('5', 'Jim', 'Stevens'), 100, 22);
        $question = $this->getAskAboutDeletionTemplate();

        $this->bot->receives('/deletedata')
            ->assertReply('We have stored your name and chat ID for showing you in the highscore.')
            ->assertTemplate($question, true)
            ->receives('something else')
            ->assertReply('Sorry, I did not get that. Please use the buttons.');
    }

    /**
     * @return Question
     */
    protected function getAskAboutDeletionTemplate()
    {
        $question = Question::create('Do you want to get deleted?')->addButtons([
            Button::create('Yes please')->value('yes'),
            Button::create('Not now')->value('no'),
        ]);

        return $question;
    }
}
