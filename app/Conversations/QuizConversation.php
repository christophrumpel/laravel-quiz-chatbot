<?php

namespace App\Conversations;

use App\Answer;
use App\Played;
use App\Question;
use App\Highscore;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer as BotManAnswer;
use BotMan\BotMan\Messages\Outgoing\Question as BotManQuestion;

class QuizConversation extends Conversation
{
    /** @var Question */
    protected $quizQuestions;

    /** @var integer */
    protected $userPoints = 0;

    /** @var integer */
    protected $userCorrectAnswers = 0;

    /** @var integer */
    protected $questionCount;

    /** @var integer */
    protected $currentQuestion = 1;

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->quizQuestions = Question::all()
            ->shuffle();
        $this->questionCount = $this->quizQuestions->count();
        $this->quizQuestions = $this->quizQuestions->keyBy('id');
        $this->showInfo();
    }

    private function showInfo()
    {
        $this->say("You will be shown *{$this->questionCount} questions* about Laravel. Every correct answer will reward you with a certain amount of points.",
            ['parse_mode' => 'Markdown']);
        $this->bot->typesAndWaits(1);
        $this->say('💡🍀 Please keep it fair, and don\'t use any help. All the best!', [
            'parse_mode' => 'Markdown',
        ]);

        $this->bot->typesAndWaits(2);

        return $this->checkForNextQuestion();
    }

    private function checkForNextQuestion()
    {
        if ($this->quizQuestions->count()) {
            return $this->askQuestion($this->quizQuestions->first());
        }

        $this->showResult();
    }

    private function askQuestion(Question $question)
    {
        $this->bot->typesAndWaits(1);
        $this->ask($this->createQuestionTemplate($question), function (BotManAnswer $answer) use ($question) {
            $quizAnswer = Answer::find($answer->getValue());

            if (! $quizAnswer) {
                $this->say('Sorry, I did not get that. Please use the buttons.');

                return $this->checkForNextQuestion();
            }

            $this->quizQuestions->forget($question->id);

            if ($quizAnswer->correct_one) {
                $this->userPoints += $question->points;
                $this->userCorrectAnswers++;
                $answerResult = '✅';
            } else {
                $correctAnswer = $question->answers()
                    ->where('correct_one', true)
                    ->first()->text;
                $answerResult = "❌ _(Correct: {$correctAnswer})_";
            }
            $this->currentQuestion++;

            $this->say("*Your answer:* {$quizAnswer->text} {$answerResult}", [
                'parse_mode' => 'Markdown'
            ]);
            $this->bot->typesAndWaits(1);
            $this->checkForNextQuestion();
        }, [
            'parse_mode' => 'Markdown'
        ]);
    }

    private function showResult()
    {
        Played::create([
            'chat_id' => $this->bot->getUser()
                ->getId(),
            'points' => $this->userPoints,
        ]);
        $this->bot->typesAndWaits(1);
        $this->say('🏁 Finished 🏁');
        $this->bot->typesAndWaits(1);
        $this->say("You made it through all the questions. You reached *{$this->userPoints} points*! Correct answers: {$this->userCorrectAnswers} / {$this->questionCount}",
            ['parse_mode' => 'Markdown']);

        // Ask user about highscore
        if (Played::where('chat_id', $this->bot->getUser()
                ->getId())
                ->count() === 1) {
            return $this->askAboutHighscore();
        }

        return $this->alreadyHadHisChanceForTheHighscore();

    }

    private function askAboutHighscore()
    {
        $question = BotManQuestion::create('Do you want to get added to the highscore list? This was your first try, and only this one can be added to the highscore. To achieve that, we need to store your name and chat id.')
            ->addButtons([
                Button::create('Yes please')
                    ->value('yes'),
                Button::create('No')
                    ->value('no'),
            ]);

        $this->ask($question, function (BotManAnswer $answer) {
            switch ($answer->getValue()) {
                case 'yes':
                    $user = Highscore::saveUser($this->bot->getUser(), $this->userPoints, $this->userCorrectAnswers);
                    $this->say("Done. Your rank is {$user->rank}.");

                    return $this->bot->startConversation(new HighscoreConversation());
                case 'no':
                    return $this->say('No problem. You were not added to the highscore. Still, you can tell your friends about it 😉');
                default:
                    return $this->repeat('Sorry, I did not get that. Please use the buttons.');
            }
        });
    }

    private function alreadyHadHisChanceForTheHighscore()
    {
        $question = BotManQuestion::create('You already had your first try, so this new score cannot be added to the highscore. Do you still want to see it?')
            ->addButtons([
                Button::create('Highscore')
                    ->value('highscore'),
                Button::create('New Game')
                    ->value('newgame'),
            ]);

        $this->ask($question, function (BotManAnswer $answer) {
            switch ($answer->getValue()) {
                case 'highscore':
                    return $this->bot->startConversation(new HighscoreConversation());
                case 'newgame':
                    return $this->run();
                default:
                    return $this->repeat('Sorry, I did not get that. Please use the buttons.');
            }
        });
    }

    private function createQuestionTemplate(Question $question)
    {
        $questionTemplate = BotManQuestion::create("➡️ *Question {$this->currentQuestion} / {$this->questionCount}* \n{$question->text}");

        foreach ($question->answers->shuffle() as $answer) {
            $questionTemplate->addButton(Button::create($answer->text)
                ->value($answer->id));
        }

        return $questionTemplate;
    }
}
