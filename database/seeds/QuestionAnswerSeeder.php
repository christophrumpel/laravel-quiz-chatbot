<?php

use App\Answer;
use App\Question;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::truncate();
        Answer::truncate();
        $questionAndAnswers = $this->getData();

        $questionAndAnswers->each(function ($question) {

            $createdQuestion = Question::create([
                'text' => $question['question'],
                'points' => $question['points'],
            ]);

            collect($question['answers'])->each(function ($answer) use ($createdQuestion) {
                Answer::create([
                    'question_id' => $createdQuestion->id,
                    'text' => $answer['text'],
                    'correct_one' => $answer['correct_one'],
                ]);
            });

        });
    }

    private function getData()
    {
        return collect([
            [
                'question' => 'Is Laravel 6 an LTS release?',
                'points' => '5',
                'answers' => [
                    ['text' => 'Yes', 'correct_one' => true],
                    ['text' => 'No', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Which of the following is a Laravel product?',
                'points' => '5',
                'answers' => [
                    ['text' => 'Laravel Fume', 'correct_one' => false],
                    ['text' => 'Laravel Paper', 'correct_one' => false],
                    ['text' => 'Laravel Vapor', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'With Laravel 6 there are finally middlewares for..?',
                'points' => '15',
                'answers' => [
                    ['text' => 'Views', 'correct_one' => false],
                    ['text' => 'Commands', 'correct_one' => false],
                    ['text' => 'Jobs', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What\'s the default error page on Laravel 6?',
                'points' => '10',
                'answers' => [
                    ['text' => 'Whoops', 'correct_one' => false],
                    ['text' => 'Ignition', 'correct_one' => true],
                    ['text' => 'Clusterfuck', 'correct_one' => false],
                ],
            ],
            [
                'question' => '...allow you to run nested queries within one database query.',
                'points' => '15',
                'answers' => [
                    ['text' => 'multiqueries', 'correct_one' => true],
                    ['text' => 'subqueries', 'correct_one' => false],
                    ['text' => 'doublequeries', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'In order to create a real-time facade you need to...',
                'points' => '20',
                'answers' => [
                    ['text' => 'extend the RealTimeFacade class', 'correct_one' => false],
                    ['text' => 'load the RealTimeServiceProvider', 'correct_one' => false],
                    ['text' => 'add \"Facades\" to the current namespace', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What is the correct syntax to create a model, a resource controller and a migration all at once with php artisan?',
                'points' => '15',
                'answers' => [
                    ['text' => 'php artisan make:model ModelName --everything', 'correct_one' => false],
                    ['text' => 'php artisan make:model ModelName --full', 'correct_one' => false],
                    ['text' => 'php artisan make:model ModelName --all', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Let\s welcome the new Laravel crew member...',
                'points' => '10',
                'answers' => [
                    ['text' => 'Chris Brown', 'correct_one' => false],
                    ['text' => 'Shawn McCool', 'correct_one' => false],
                    ['text' => 'James Brooks', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What PHP version does Laravel 6 require?',
                'points' => '15',
                'answers' => [
                    ['text' => '>= 7.1.3', 'correct_one' => false],
                    ['text' => '<= 7.3.', 'correct_one' => false],
                    ['text' => '>= 7.2.0', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Pick the most performant way to count models?',
                'points' => '15',
                'answers' => [
                    ['text' => 'Model::count()', 'correct_one' => false],
                    ['text' => 'Model::all()->count()', 'correct_one' => true],
                    ['text' => 'count(Model::all())', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Laravel 6.0 introduces...',
                'points' => '5',
                'answers' => [
                    ['text' => 'custom versioning', 'correct_one' => false],
                    ['text' => 'semantic versioning', 'correct_one' => true],
                    ['text' => 'dynamic versioning', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'The new LazyCollection feature is using PHP\'s ... under the hood.',
                'points' => '10',
                'answers' => [
                    ['text' => 'Generators', 'correct_one' => true],
                    ['text' => 'Alternator', 'correct_one' => false],
                    ['text' => 'Phantomator', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'By using the Notification facade, we are actually calling the...',
                'points' => '20',
                'answers' => [
                    ['text' => 'NotificationSender class', 'correct_one' => false],
                    ['text' => 'ChannelManager class', 'correct_one' => true],
                    ['text' => 'NotificationManager class', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'A project Taylor Otwell never released was called...',
                'points' => '15',
                'answers' => [
                    ['text' => 'Laravel Ignition', 'correct_one' => false],
                    ['text' => 'Laravel Plume', 'correct_one' => false],
                    ['text' => 'Laravel Cloud', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Which version of Laravel Spark was released earlier this year?',
                'points' => '15',
                'answers' => [
                    ['text' => '4', 'correct_one' => false],
                    ['text' => '5', 'correct_one' => false],
                    ['text' => '6', 'correct_one' => true],
                ],
            ],
            [
                'question' => "___User::where('name', 'Chris')->first();___ Where do we find the 'where' method?",
                'points' => '20',
                'answers' => [
                    ['text' => 'The Eloquent Builder', 'correct_one' => true],
                    ['text' => 'The Database Builder', 'correct_one' => false],
                    ['text' => 'The User Model', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What is the largest PHP file (line numbers) in the Laravel framework.',
                'points' => '20',
                'answers' => [
                    ['text' => 'Support Facades Bus', 'correct_one' => false],
                    ['text' => 'Database Query Builder', 'correct_one' => true],
                    ['text' => 'Support Collection', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'How many Spatie packages are in Laravel\'s core?',
                'points' => '15',
                'answers' => [
                    ['text' => '0', 'correct_one' => true],
                    ['text' => '1', 'correct_one' => false],
                    ['text' => '2', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'How can you check failed Laravel jobs?',
                'points' => '30',
                'answers' => [
                    ['text' => 'Database', 'correct_one' => true],
                    ['text' => 'Email', 'correct_one' => false],
                    ['text' => 'Command line', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'How many Laravel packages did Spatie release?',
                'points' => '30',
                'answers' => [
                    ['text' => '40', 'correct_one' => false],
                    ['text' => '60', 'correct_one' => true],
                    ['text' => '90', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What does the collection method "zip" do?',
                'points' => '25',
                'answers' => [
                    ['text' => 'Merges collection and array', 'correct_one' => true],
                    ['text' => 'Creates a ZIP file', 'correct_one' => false],
                    ['text' => 'Validates zip codes ', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What are form requests?',
                'points' => '20',
                'answers' => [
                    ['text' => 'HTML form helpers', 'correct_one' => false],
                    ['text' => 'Custom validation classes', 'correct_one' => true],
                    ['text' => 'Form objects ', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What is the name of a former Envato author that helped making Laravel that famous?',
                'points' => '10',
                'answers' => [
                    ['text' => 'Jeffrey Way', 'correct_one' => true],
                    ['text' => 'Jeffrey Route', 'correct_one' => false],
                    ['text' => 'Annie Way', 'correct_one' => false],
                ],
            ],
        ]);
    }
}
