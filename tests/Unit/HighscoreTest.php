<?php

namespace Tests\Unit;

use App\Highscore;
use Tests\TestCase;
use BotMan\BotMan\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HighscoreTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     **/
    public function it_stores_highscore_from_a_botman_users()
    {
        // Given
        $botmanUser = new User('1', 'Jim', 'Stevens');

        // When
        Highscore::saveUser($botmanUser, 100, 4);

        // Then
        $newUser = Highscore::where('chat_id', '1')->first();
        $this->assertEquals(1, Highscore::all()->count());

        $this->assertArraySubset([
            'chat_id' => 1,
            'name' => 'Jim Stevens',
            'points' => 100,
            'correct_answers' => 4,
            'tries' => 1,
        ], $newUser->toArray());
    }

    /**
     * @test
     **/
    public function it_deletes_user_by_chat_id()
    {
        // Given
        $botmanUser = new User('4', 'Jim', 'Stevens');
        Highscore::saveUser($botmanUser, 100, 4);
        $this->assertNotNull(Highscore::where('chat_id', 4)->first());

        // When
        Highscore::deleteUser('4');

        // Then
        $this->assertNull(Highscore::where('chat_id', 4)->first());
    }
}
