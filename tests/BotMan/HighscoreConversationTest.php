<?php

namespace Tests\BotMan;

use App\Highscore;
use Tests\TestCase;
use BotMan\BotMan\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HighscoreConversationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     **/
    public function it_shows_empty_highscore()
    {
        $this->bot->receives('/highscore')->assertReply('The highscore is still empty. Be the first one! 👍');
    }

    /**
     * @test
     **/
    public function it_shows_highscore_entries()
    {
        Highscore::saveUser(new User('5', 'Jim', 'Stevens'), 100, 22);

        $this->bot->receives('/highscore')->assertReply('Here is the current highscore. If you want to play another round, click: /start')
            ->assertReply('🏆 HIGHSCORE 🏆')
            ->assertReply("_1 - Jim Stevens_ *100 points*");
    }

}
