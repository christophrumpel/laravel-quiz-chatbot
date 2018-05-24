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
                'question' => 'Who created Laravel?',
                'points' => '5',
                'answers' => [
                    ['text' => 'Christoph Rumpel', 'correct_one' => false],
                    ['text' => 'Jeffrey Way', 'correct_one' => false],
                    ['text' => 'Taylor Otwell', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Which of the following is a Laravel product?',
                'points' => '10',
                'answers' => [
                    ['text' => 'Horizon', 'correct_one' => true],
                    ['text' => 'Sunset', 'correct_one' => false],
                    ['text' => 'Nightfall', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'When did Taylor release the first version of Laravel?',
                'points' => '20',
                'answers' => [
                    ['text' => '2009', 'correct_one' => false],
                    ['text' => '2010', 'correct_one' => false],
                    ['text' => '2011', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Which of these Symfony packages is NOT used in Laravel?',
                'points' => '25',
                'answers' => [
                    ['text' => 'symfony / console', 'correct_one' => false],
                    ['text' => 'symfony / http-kernel', 'correct_one' => false],
                    ['text' => 'symfony / doctrine-bridge', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'In which Laravel version where Blade components and slots introduced?',
                'points' => '30',
                'answers' => [
                    ['text' => '5.4', 'correct_one' => true],
                    ['text' => '5.5', 'correct_one' => false],
                    ['text' => '5.6', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Who started the first Laravel Podcast?',
                'points' => '20',
                'answers' => [
                    ['text' => 'Matt Stauffer', 'correct_one' => false],
                    ['text' => 'Dayle Rees', 'correct_one' => false],
                    ['text' => 'Shawn McCool', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Which is a method from the collection class?',
                'points' => '20',
                'answers' => [
                    ['text' => 'median', 'correct_one' => true],
                    ['text' => 'medion', 'correct_one' => false],
                    ['text' => 'medial', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Finish the sentence: "Laravel - The PHP Framework For Web...',
                'points' => '10',
                'answers' => [
                    ['text' => 'Performer', 'correct_one' => false],
                    ['text' => 'Artisans', 'correct_one' => true],
                    ['text' => 'Masters', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What PHP version does Laravel 5.6 require?',
                'points' => '30',
                'answers' => [
                    ['text' => '>= 7.1.3', 'correct_one' => true],
                    ['text' => '<= 7.1.2', 'correct_one' => false],
                    ['text' => '>= 7.1.1', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Who designed the Laravel Documentation?',
                'points' => '30',
                'answers' => [
                    ['text' => 'Steve Schoger', 'correct_one' => false],
                    ['text' => 'Jack Mcdade', 'correct_one' => true],
                    ['text' => 'Marcel Pociot', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'How do you generate the Laravel application key?',
                'points' => '30',
                'answers' => [
                    ['text' => 'php artisan generate:key', 'correct_one' => false],
                    ['text' => 'php artisan key:generate', 'correct_one' => true],
                    ['text' => 'php artisan make:key', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Laravel 5.6 is an LTS release?',
                'points' => '20',
                'answers' => [
                    ['text' => 'False', 'correct_one' => true],
                    ['text' => 'True', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'We have one user in the database. What does User::all() return?',
                'points' => '25',
                'answers' => [
                    ['text' => 'Array', 'correct_one' => false],
                    ['text' => 'Collection', 'correct_one' => true],
                    ['text' => 'User object', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Who was Laravel\'s first employee?',
                'points' => '15',
                'answers' => [
                    ['text' => 'Adam Wathan', 'correct_one' => false],
                    ['text' => 'Mohamed Said', 'correct_one' => true],
                    ['text' => 'Eric L. Barnes', 'correct_one' => false],
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
                'question' => 'What is the best way to interact with your Laravel application from the command line?',
                'points' => '15',
                'answers' => [
                    ['text' => 'Using Laravel Tinker', 'correct_one' => true],
                    ['text' => 'Using the native php interactive shell', 'correct_one' => false],
                    ['text' => 'This is not possible', 'correct_one' => false],
                ],
            ],
            [
                'question' => '... allow you to format Eloquent attribute values when you retrieve them.',
                'points' => '20',
                'answers' => [
                    ['text' => 'Accessors', 'correct_one' => true],
                    ['text' => 'Mutators', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'You want to randomize your items in a collection. What do you use?',
                'points' => '25',
                'answers' => [
                    ['text' => '$collection->shuffle()', 'correct_one' => true],
                    ['text' => '$collection->random()', 'correct_one' => false],
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
