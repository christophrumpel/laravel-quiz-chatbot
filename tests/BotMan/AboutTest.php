<?php

namespace Tests\BotMan;

use Tests\TestCase;

class AboutTest extends TestCase
{
    /**
     * @test
     */
    public function it_replies_with_about_text()
    {
        $this->bot->receives('/about')
            ->assertReply('LaravelQuiz is a project by Christoph Rumpel. Find out more about it on https://christoph-rumpel.com');
    }
}
