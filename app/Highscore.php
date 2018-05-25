<?php

namespace App;

use BotMan\BotMan\Interfaces\UserInterface;
use Illuminate\Database\Eloquent\Model;

class Highscore extends Model
{

    protected $fillable = ['chat_id', 'name', 'points', 'correct_answers', 'tries'];

    protected $table = 'highscore';

    public static function saveUser(UserInterface $botUser, int $userPoints, int $userCorrectAnswers)
    {
        $user = Highscore::updateOrCreate(['chat_id' => $botUser->getId()], [
            'chat_id' => $botUser->getId(),
            'name' => $botUser->getFirstName().' '.$botUser->getLastName(),
            'points' => $userPoints,
            'correct_answers' => $userCorrectAnswers,
        ]);

        if ($user->wasRecentlyCreated) {
            $user->tries = 1;
        } else {
            $user->tries++;
        }

        $user->save();

        return $user;
    }

    public function getRank()
    {
        return Highscore::all()->where('points', '>', $this->points)->pluck('points')->unique()->count() + 1;
    }

    public static function topUsers()
    {
        $topUsers = Highscore::all()->sortByDesc('points')->take(10);

        $topUsers->each(function ($user) use ($topUsers) {
            return $user->rank = $topUsers->where('points', '>', $user->points)->pluck('points')->unique()->count() + 1;
        });

        return $topUsers;
    }

    public static function deleteUser(string $chatId)
    {
        Highscore::where('chat_id', $chatId)->delete();
    }
}
