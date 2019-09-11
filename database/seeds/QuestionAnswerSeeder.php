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
                'question' => 'The name "_Laravel_" was made up by Taylor, it is a spinoff of...',
                'points' => '20',
                'answers' => [
                    ['text' => 'an animal in Eragon', 'correct_one' => false],
                    ['text' => 'a character in The Neverending Story', 'correct_one' => false],
                    ['text' => 'a place in Narnia', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'When you return an Eloquent model for a request, it will automatically create a JSON response. This is one of the jobs of the...',
                'points' => '30',
                'answers' => [
                    ['text' => 'Eloquent Builder', 'correct_one' => false],
                    ['text' => 'HTTP Kernel', 'correct_one' => false],
                    ['text' => 'Router', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'With Laravel 6 there are finally middlewares for...?',
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
                'question' => 'In Laravel 6, ...allow you to run nested queries within one database query.',
                'points' => '15',
                'answers' => [
                    ['text' => 'multiqueries', 'correct_one' => false],
                    ['text' => 'subqueries', 'correct_one' => true],
                    ['text' => 'doublequeries', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'In order to create a real-time facade you need to...',
                'points' => '20',
                'answers' => [
                    ['text' => 'extend the RealTimeFacade class', 'correct_one' => false],
                    ['text' => 'load the RealTimeServiceProvider', 'correct_one' => false],
                    ['text' => 'prepend "Facades" to the namespace', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What is the correct syntax to create a _model_, _controller_, _migration_ and a _factory_ all at once with artisan?',
                'points' => '15',
                'answers' => [
                    ['text' => 'make:model ModelName --everything', 'correct_one' => false],
                    ['text' => 'make:model ModelName --full', 'correct_one' => false],
                    ['text' => 'make:model ModelName --all', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Let\'s welcome the new Laravel team member...',
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
                    ['text' => 'Model::count()', 'correct_one' => true],
                    ['text' => 'Model::all()->count()', 'correct_one' => false],
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
                'question' => 'The new _LazyCollection_ feature is using PHP\'s ... under the hood.',
                'points' => '10',
                'answers' => [
                    ['text' => 'Generators', 'correct_one' => true],
                    ['text' => 'Alternator', 'correct_one' => false],
                    ['text' => 'Reflections', 'correct_one' => false],
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
                'question' => 'You can use a Laravel controller without extending the "base" controller?',
                'points' => '15',
                'answers' => [
                    ['text' => 'False', 'correct_one' => false],
                    ['text' => 'True', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'You use a database transaction with Laravel for two queries. The first one calls the create method on a model. The second one fails. When will the "_created event_" be triggered?',
                'points' => '30',
                'answers' => [
                    ['text' => 'After the first query', 'correct_one' => true],
                    ['text' => 'After the last query', 'correct_one' => false],
                    ['text' => 'Never, because no model in the DB', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What is the largest PHP file in the Laravel framework.(regarding line numbers)',
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
                'question' => 'What does the following command do? "_php artisan serve_"',
                'points' => '10',
                'answers' => [
                    ['text' => 'It compiles your frontend assets.', 'correct_one' => false],
                    ['text' => 'It spins up a local web server.', 'correct_one' => true],
                    ['text' => 'It publishes every vendor configuration.', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Which integrated command caches all (cachable) resources at once?',
                'points' => '20',
                'answers' => [
                    ['text' => 'php artisan cache', 'correct_one' => false],
                    ['text' => 'php artisan cache:all', 'correct_one' => false],
                    ['text' => 'php artisan optimize', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Why is the Laravel core components namespaced "_Illuminate_"?',
                'points' => '20',
                'answers' => [
                    ['text' => 'Taylor is an Illuminati himself', 'correct_one' => false],
                    ['text' => 'Abigail told Taylor', 'correct_one' => false],
                    ['text' => 'Codename for Laravel 4', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Who designed the _Laracon US 2019_ website?',
                'points' => '15',
                'answers' => [
                    ['text' => 'Steve Schoger', 'correct_one' => false],
                    ['text' => 'Adam Wathan', 'correct_one' => false],
                    ['text' => 'Jack McDade', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Who\'s behind the video course Laravel Core Adventures?',
                'points' => '15',
                'answers' => [
                    ['text' => 'Miguel Piedrafita', 'correct_one' => false],
                    ['text' => 'Christoph Rumpel', 'correct_one' => true],
                    ['text' => 'Caleb Porzio', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'When joining a table to an Eloquent query, how does Laravel handle the _joined table columns?_',
                'points' => '35',
                'answers' => [
                    ['text' => 'Includes them all', 'correct_one' => true],
                    ['text' => 'Doesn\'t include them', 'correct_one' => false],
                    ['text' => 'Resolves conflicts automatically', 'correct_one' => false],
                ],
            ],
        ]);
    }
}
