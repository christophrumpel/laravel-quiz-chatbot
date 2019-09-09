<?php

use BotMan\BotMan\BotMan;
use App\Conversations\QuizConversation;
use App\Http\Middleware\TypingMiddleware;
use App\Conversations\WelcomeConversation;
use App\Conversations\PrivacyConversation;
use App\Conversations\HighscoreConversation;

$botman = resolve('botman');

$typingMiddleware = new TypingMiddleware();
$botman->middleware->sending($typingMiddleware);

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('/start', function (BotMan $bot) {
    $bot->startConversation(new WelcomeConversation());
})->stopsConversation();

$botman->hears('start|/startQuiz', function (BotMan $bot) {
    $bot->startConversation(new QuizConversation());
})->stopsConversation();

$botman->hears('/highscore|highscore', function (BotMan $bot) {
    $bot->startConversation(new HighscoreConversation());
})->stopsConversation();

$botman->hears('/about|about', function (BotMan $bot) {
    $bot->reply('LaravelQuiz is a project by Christoph Rumpel. Find out more about it on https://christoph-rumpel.com');
})->stopsConversation();

$botman->hears('/deletedata|deletedata', function (BotMan $bot) {
    $bot->startConversation(new PrivacyConversation());
})->stopsConversation();
