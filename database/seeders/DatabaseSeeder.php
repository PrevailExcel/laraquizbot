<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Track;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Track::truncate();
        $this->addTracks();

        $tracks = Track::all();
        Question::truncate();
        Answer::truncate();

        $questionAndAnswers = $this->getData();
        foreach ($tracks as $track) {
            $questionAndAnswers->where('track', $track->id)->each(function ($question) {
                $createdQuestion = Question::create([
                    'text' => $question['question'],
                    'track_id' => $question['track'],
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
    }

    private function addTracks()
    {
        $track = new Track();
        $track->name = 'Laravel';
        $track->save();
        $track = new Track();
        $track->name = 'Django';
        $track->save();
        $track = new Track();
        $track->name = 'React';
        $track->save();
        $track = new Track();
        $track->name = 'CSS';
        $track->save();
    }

    private function getData()
    {
        return collect([
            [
                'question' => 'Is Laravel 6 an LTS release?',
                'points' => 10,
                'track' => 1,
                'answers' => [
                    ['text' => 'Yes', 'correct_one' => true],
                    ['text' => 'No', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Which of the following is a Laravel product?',
                'points' => 10,
                'track' => 1,
                'answers' => [
                    ['text' => 'Laravel Fume', 'correct_one' => false],
                    ['text' => 'Laravel Paper', 'correct_one' => false],
                    ['text' => 'Laravel Vapor', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'The name "_Laravel_" was made up by Taylor, it is a spinoff of...',
                'points' => '20',
                'track' => 1,
                'answers' => [
                    ['text' => 'an animal in Eragon', 'correct_one' => false],
                    ['text' => 'a character in The Neverending Story', 'correct_one' => false],
                    ['text' => 'a place in Narnia', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'When you return an Eloquent model for a request, it will automatically create a JSON response. This is one of the jobs of the...',
                'points' => '30',
                'track' => 1,
                'answers' => [
                    ['text' => 'Eloquent Builder', 'correct_one' => false],
                    ['text' => 'HTTP Kernel', 'correct_one' => false],
                    ['text' => 'Router', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'With Laravel 6 there are finally middlewares for...?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'Views', 'correct_one' => false],
                    ['text' => 'Commands', 'correct_one' => false],
                    ['text' => 'Jobs', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What\'s the default error page on Laravel 6?',
                'points' => '10',
                'track' => 1,
                'answers' => [
                    ['text' => 'Whoops', 'correct_one' => false],
                    ['text' => 'Ignition', 'correct_one' => true],
                    ['text' => 'Clusterfuck', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'In Laravel 6, ...allow you to run nested queries within one database query.',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'multiqueries', 'correct_one' => false],
                    ['text' => 'subqueries', 'correct_one' => true],
                    ['text' => 'doublequeries', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'In order to create a real-time facade you need to...',
                'points' => '20',
                'track' => 1,
                'answers' => [
                    ['text' => 'extend the RealTimeFacade class', 'correct_one' => false],
                    ['text' => 'load the RealTimeServiceProvider', 'correct_one' => false],
                    ['text' => 'prepend "Facades" to the namespace', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What is the correct syntax to create a _model_, _controller_, _migration_ and a _factory_ all at once with artisan?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'make:model ModelName --everything', 'correct_one' => false],
                    ['text' => 'make:model ModelName --full', 'correct_one' => false],
                    ['text' => 'make:model ModelName --all', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Let\'s welcome the new Laravel team member...',
                'points' => '10',
                'track' => 1,
                'answers' => [
                    ['text' => 'Chris Brown', 'correct_one' => false],
                    ['text' => 'Shawn McCool', 'correct_one' => false],
                    ['text' => 'James Brooks', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'What PHP version does Laravel 6 require?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => '>= 7.1.3', 'correct_one' => false],
                    ['text' => '<= 7.3.', 'correct_one' => false],
                    ['text' => '>= 7.2.0', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Pick the most performant way to count models?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'Model::count()', 'correct_one' => true],
                    ['text' => 'Model::all()->count()', 'correct_one' => false],
                    ['text' => 'count(Model::all())', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Laravel 6.0 introduces...',
                'points' => 10,
                'track' => 1,
                'answers' => [
                    ['text' => 'custom versioning', 'correct_one' => false],
                    ['text' => 'semantic versioning', 'correct_one' => true],
                    ['text' => 'dynamic versioning', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'The new _LazyCollection_ feature is using PHP\'s ... under the hood.',
                'points' => '10',
                'track' => 1,
                'answers' => [
                    ['text' => 'Generators', 'correct_one' => true],
                    ['text' => 'Alternator', 'correct_one' => false],
                    ['text' => 'Reflections', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'By using the Notification facade, we are actually calling the...',
                'points' => '20',
                'track' => 1,
                'answers' => [
                    ['text' => 'NotificationSender class', 'correct_one' => false],
                    ['text' => 'ChannelManager class', 'correct_one' => true],
                    ['text' => 'NotificationManager class', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'A project Taylor Otwell never released was called...',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'Laravel Ignition', 'correct_one' => false],
                    ['text' => 'Laravel Plume', 'correct_one' => false],
                    ['text' => 'Laravel Cloud', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'You can use a Laravel controller without extending the "base" controller?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'False', 'correct_one' => false],
                    ['text' => 'True', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'You use a database transaction with Laravel for two queries. The first one calls the create method on a model. The second one fails. When will the "_created event_" be triggered?',
                'points' => '30',
                'track' => 1,
                'answers' => [
                    ['text' => 'After the first query', 'correct_one' => true],
                    ['text' => 'After the last query', 'correct_one' => false],
                    ['text' => 'Never, because no model in the DB', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What is the largest PHP file in the Laravel framework.(regarding line numbers)',
                'points' => '20',
                'track' => 1,
                'answers' => [
                    ['text' => 'Support Facades Bus', 'correct_one' => false],
                    ['text' => 'Database Query Builder', 'correct_one' => true],
                    ['text' => 'Support Collection', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'How many Spatie packages are in Laravel\'s core?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => '0', 'correct_one' => true],
                    ['text' => '1', 'correct_one' => false],
                    ['text' => '2', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What does the following command do? "_php artisan serve_"',
                'points' => '10',
                'track' => 1,
                'answers' => [
                    ['text' => 'It compiles your frontend assets.', 'correct_one' => false],
                    ['text' => 'It spins up a local web server.', 'correct_one' => true],
                    ['text' => 'It publishes every vendor configuration.', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'Which integrated command caches all (cachable) resources at once?',
                'points' => '20',
                'track' => 1,
                'answers' => [
                    ['text' => 'php artisan cache', 'correct_one' => false],
                    ['text' => 'php artisan cache:all', 'correct_one' => false],
                    ['text' => 'php artisan optimize', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Why is the Laravel core components namespaced "_Illuminate_"?',
                'points' => '20',
                'track' => 1,
                'answers' => [
                    ['text' => 'Taylor is an Illuminati himself', 'correct_one' => false],
                    ['text' => 'Abigail told Taylor', 'correct_one' => false],
                    ['text' => 'Codename for Laravel 4', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'Who designed the _Laracon US 2019_ website?',
                'points' => '15',
                'track' => 1,
                'answers' => [
                    ['text' => 'Steve Schoger', 'correct_one' => false],
                    ['text' => 'Adam Wathan', 'correct_one' => false],
                    ['text' => 'Jack McDade', 'correct_one' => true],
                ],
            ],
            [
                'question' => 'When joining a table to an Eloquent query, how does Laravel handle the _joined table columns?_',
                'points' => '35',
                'track' => 1,
                'answers' => [
                    ['text' => 'Includes them all', 'correct_one' => true],
                    ['text' => 'Doesn\'t include them', 'correct_one' => false],
                    ['text' => 'Resolves conflicts automatically', 'correct_one' => false],
                ],
            ],
            [
                'question' => 'What is Laravel\'s service container and how does it work?',
                'points' => 20,
                'track' => 1,
                'answers' => [
                    ['text' => 'Laravel\'s service container is a powerful tool for managing class dependencies and performing dependency injection in Laravel applications', 'correct_one' => True,],
                    ['text' => 'Laravel\'s service container is a built-in tool for creating and managing database tables and relationships', 'correct_one' => False,],
                    ['text' => 'Laravel\'s service container is a cache mechanism for storing frequently used data', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What are Laravel facades and how do they work?',
                'points' => 20,
                'track' => 1,
                'answers' => [
                    ['text' => 'Laravel facades provide a "static" interface to classes that are registered in the service container, allowing developers to access and use those classes without injecting them into their code', 'correct_one' => True,],
                    ['text' => 'Laravel facades are a way to generate mock data for testing purposes', 'correct_one' => False,],
                    ['text' => 'Laravel facades are a way to create and manage database migrations', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What are Laravel middleware and how do they work?',
                'points' => 20,
                'track' => 1,
                'answers' => [
                    ['text' => 'Laravel middleware are a way to filter HTTP requests and responses in a Laravel application, allowing developers to add additional processing and validation to requests and responses', 'correct_one' => True,],
                    ['text' => 'Laravel middleware are a way to manage sessions and cookies in a Laravel application', 'correct_one' => False,],
                    ['text' => 'Laravel middleware are a way to define routes and URLs in a Laravel application', 'correct_one' => False,],
                ]
            ],

            [
                'question' => "What is Laravel's Eloquent ORM and how does it work?",
                'points' => 20,
                'track' => 1,
                'answers' => [
                    ['text' => "Laravel's Eloquent ORM is a powerful tool for mapping database tables to PHP classes and objects, and provides an intuitive syntax for querying and manipulating data in a Laravel application", 'correct_one' => True,],
                    ['text' => "Laravel's Eloquent ORM is a tool for managing migrations and schema changes in a Laravel application", 'correct_one' => False,],
                    ['text' => "Laravel's Eloquent ORM is a cache mechanism for storing frequently used data", 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is Laravel\'s task scheduling feature and how does it work?',
                'points' => 20,
                'track' => 1,
                'answers' => [
                    ['text' => 'Laravel\'s task scheduling feature allows developers to schedule recurring tasks and jobs in a Laravel application, such as sending emails, running database backups, and more', 'correct_one' => True,],
                    ['text' => 'Laravel\'s task scheduling feature is a way to manage user authentication and authorization in a Laravel application', 'correct_one' => False,],
                ]
            ],



            //Django

            [
                'question' => 'What is Django?',
                'points' => 5,
                'track' => 2,
                'answers' => [
                    ['text' => 'A programming language', 'correct_one' => False,],
                    ['text' => 'A web framework', 'correct_one' => True,],
                    ['text' => 'A database management system', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What programming language is Django written in?',
                'points' => 5,
                'track' => 2,
                'answers' => [
                    ['text' => 'Python', 'correct_one' => True,],
                    ['text' => 'PHP', 'correct_one' => False,],
                    ['text' => 'Java', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the latest version of Django?',
                'points' => 5,
                'track' => 2,
                'answers' => [
                    ['text' => '2.2', 'correct_one' => False,],
                    ['text' => '3.0', 'correct_one' => False,],
                    ['text' => '3.2', 'correct_one' => True,],
                ]
            ],
            [
                'question' => 'What is the Django ORM?',
                'points' => 30,
                'track' => 2,
                'answers' => [
                    ['text' => 'A library for handling HTTP requests and responses', 'correct_one' => False,],
                    ['text' => 'A database abstraction layer', 'correct_one' => True,],
                    ['text' => 'A tool for creating HTML forms', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the Django admin site?',
                'points' => 5,
                'track' => 2,
                'answers' => [
                    ['text' => 'A tool for managing database migrations', 'correct_one' => False,],
                    ['text' => 'A web interface for managing Django applications', 'correct_one' => True,],
                    ['text' => 'A testing framework for Django applications', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the Django shell?',
                'points' => 20,
                'track' => 2,
                'answers' => [
                    ['text' => 'A command-line interface for managing Django applications', 'correct_one' => True,],
                    ['text' => 'A tool for generating documentation from Django code', 'correct_one' => False,],
                    ['text' => 'A graphical user interface for managing Django applications', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the Django template system?',
                'points' => 5,
                'track' => 2,
                'answers' => [
                    ['text' => 'A tool for generating HTML forms', 'correct_one' => False,],
                    ['text' => 'A library for handling HTTP requests and responses', 'correct_one' => False,],
                    ['text' => 'A language for defining the structure and presentation of HTML pages', 'correct_one' => True,],
                ]
            ],
            [
                'question' => 'What is the Django request-response cycle?',
                'points' => 10,
                'track' => 2,
                'answers' => [
                    ['text' => 'The process of generating HTML pages from Django templates', 'correct_one' => False,],
                    ['text' => 'The process of handling HTTP requests and generating HTTP responses', 'correct_one' => True,],
                    ['text' => 'The process of managing database migrations', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is a Django view?',
                'points' => 5,
                'track' => 2,
                'answers' => [
                    ['text' => 'A Python function that takes a web request and returns a web response', 'correct_one' => True,],
                    ['text' => 'A template for generating HTML pages', 'correct_one' => False,],
                    ['text' => 'A database table representing a model', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between "django-admin" and "manage.py" commands in Django?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Both are command-line tools for managing Django projects, but "manage.py" is specific to a particular project, while "django-admin" is a global command-line tool that can be used with any Django project', 'correct_one' => True,],
                    ['text' => 'Both are global command-line tools for managing Django projects, but "manage.py" is used for setting up a new project, while "django-admin" is used for managing an existing project', 'correct_one' => False,],
                    ['text' => 'Both are specific to a particular Django project, but "manage.py" is used for running tests, while "django-admin" is used for running the development server', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is "middleware" in Django and how is it used?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Middleware is a way to add hooks for processing requests and responses at various stages of the request-response cycle in Django', 'correct_one' => True,],
                    ['text' => 'Middleware is a way to add authentication and authorization functionality to a Django project', 'correct_one' => False,],
                    ['text' => 'Middleware is a way to manage the state of a Django application', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between a "function-based view" and a "class-based view" in Django?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Function-based views are simple functions that take a request object and return a response object, while class-based views are classes that define methods for handling different HTTP methods', 'correct_one' => True,],
                    ['text' => 'Function-based views are only used for rendering templates, while class-based views are used for handling form submissions and other user input', 'correct_one' => False,],
                    ['text' => 'Function-based views are used for handling AJAX requests, while class-based views are used for handling standard HTTP requests', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is "Django REST framework" and how is it used?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Django REST framework is a powerful toolkit for building Web APIs in Django', 'correct_one' => True,],
                    ['text' => 'Django REST framework is a way to add real-time communication to a Django project', 'correct_one' => False,],
                    ['text' => 'Django REST framework is a way to add authentication and authorization functionality to a Django project', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is "caching" in Django and how is it used?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Caching is a way to store frequently accessed data in memory or on disk to improve the performance of a Django application', 'correct_one' => True,],
                    ['text' => 'Caching is a way to encrypt sensitive data in a Django application', 'correct_one' => False,],
                    ['text' => 'Caching is a way to compress and optimize static assets in a Django application', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is "transaction management" in Django and how is it used?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Transaction management is a way to ensure that database operations are executed as atomic units, meaning that either all changes are saved or none of them are saved, to maintain data integrity in a Django application', 'correct_one' => True,],
                    ['text' => 'Transaction management is a way to handle multiple requests from the same client in a Django application', 'correct_one' => False,],
                    ['text' => 'Transaction management is a way to manage the state of a Django application during long-running operations', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is "Django Signals" and how are they used?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'Django Signals are a way to decouple components of a Django application by allowing certain actions to trigger other actions in a loosely-coupled way', 'correct_one' => True,],
                    ['text' => 'Django Signals are a way to handle asynchronous tasks in a Django application', 'correct_one' => False,],
                    ['text' => 'Django Signals are a way to manage the state of a Django application', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "Django Template Language" and how is it used?',
                'points' => 50,
                'track' => 2,
                'answers' => [
                    ['text' => 'The Django Template Language is a syntax for writing HTML templates with dynamic content in a Django application', 'correct_one' => True,],
                    ['text' => 'The Django Template Language is a syntax for writing SQL queries in a Django application', 'correct_one' => False,],
                    ['text' => 'The Django Template Language is a syntax for writing regular expressions in a Django application', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is Django and what is it used for?',
                'points' => 10,
                'track' => 2,
                'answers' => [
                    ['text' => 'Django is a high-level Python web framework that is used for developing web applications', 'correct_one' => True,],
                    ['text' => 'Django is a programming language used for web development', 'correct_one' => False,],
                    ['text' => 'Django is a database management system', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is an "app" in Django?',
                'points' => 10,
                'track' => 2,
                'answers' => [
                    ['text' => 'An "app" in Django is a web application that can be plugged into a Django project', 'correct_one' => True,],
                    ['text' => 'An "app" in Django is a user interface element, such as a button or form field', 'correct_one' => False,],
                    ['text' => 'An "app" in Django is a data model for a database table', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is a "model" in Django and how is it used?',
                'points' => 10,
                'track' => 2,
                'answers' => [
                    ['text' => 'A "model" in Django is a Python class that represents a database table and its associated fields, and is used to interact with the database in a Django application', 'correct_one' => True,],
                    ['text' => 'A "model" in Django is a user interface element, such as a button or form field', 'correct_one' => False,],
                    ['text' => 'A "model" in Django is a web page template', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is a "view" in Django and how is it used?',
                'points' => 10,
                'track' => 2,
                'answers' => [
                    ['text' => 'A "view" in Django is a Python function that processes a web request and returns an HTTP response, and is used to handle user input and generate dynamic content in a Django application', 'correct_one' => True,],
                    ['text' => 'A "view" in Django is a user interface element, such as a button or form field', 'correct_one' => False,],
                    ['text' => 'A "view" in Django is a web page template', 'correct_one' => False,],
                ]
            ],










            // CSS

            [
                'question' => 'What is the difference between the :before and :after pseudo-elements in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'The :before pseudo-element adds content before the selected element, while the :after pseudo-element adds content after the selected element', 'correct_one' => True,],
                    ['text' => 'The :before pseudo-element adds content after the selected element, while the :after pseudo-element adds content before the selected element', 'correct_one' => False,],
                    ['text' => 'The :before pseudo-element adds content before and after the selected element, while the :after pseudo-element adds content only before the selected element', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the box-sizing property in CSS and how does it work?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'The box-sizing property in CSS controls how the total width and height of an element is calculated, including padding and border width', 'correct_one' => True,],
                    ['text' => 'The box-sizing property in CSS controls the layout and position of an element within its parent container', 'correct_one' => False,],
                    ['text' => 'The box-sizing property in CSS controls the color and background of an element', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between position: absolute and position: relative in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'position: absolute positions an element relative to its nearest positioned ancestor, while position: relative positions an element relative to its normal position within the document flow', 'correct_one' => True,],
                    ['text' => 'position: absolute positions an element at the top-left corner of its parent container, while position: relative positions an element at the bottom-right corner of its parent container', 'correct_one' => False,],
                    ['text' => 'position: absolute and position: relative are identical in function and can be used interchangeably', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between the display: block, display: inline, and display: inline-block properties in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'display: block creates a block-level element that takes up the full width of its parent container, display: inline creates an inline-level element that flows within the text content, and display: inline-block creates a block-level element that flows within the text content', 'correct_one' => True,],
                    ['text' => 'display: block creates an inline-level element that flows within the text content, display: inline creates a block-level element that takes up the full width of its parent container, and display: inline-block creates an inline-level element that takes up the full width of its parent container', 'correct_one' => False,],
                    ['text' => 'display: block, display: inline, and display: inline-block are identical in function and can be used interchangeably', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What does CSS stand for?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'Cascading Style Sheets', 'correct_one' => True,],
                    ['text' => 'Creative Style Sheets', 'correct_one' => False,],
                    ['text' => 'Colorful Style Sheets', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the syntax for defining a CSS rule?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'selector { property: value; }', 'correct_one' => True,],
                    ['text' => 'property: value; selector { }', 'correct_one' => False,],
                    ['text' => 'value: property; selector { }', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the box model in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A model for representing the layout of HTML elements as a series of nested boxes', 'correct_one' => True,],
                    ['text' => 'A model for representing the position and size of images on a web page', 'correct_one' => False,],
                    ['text' => 'A model for representing the hierarchy of HTML elements on a web page', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between padding and margin in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'Padding is the space between the content of an element and its border, while margin is the space between the border of an element and other elements on the page', 'correct_one' => True,],
                    ['text' => 'Padding is the space between the border of an element and other elements on the page, while margin is the space between the content of an element and its border', 'correct_one' => False,],
                    ['text' => 'Padding and margin are the same thing in CSS', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is a CSS selector?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A pattern that matches one or more HTML elements on a web page and applies styles to them', 'correct_one' => True,],
                    ['text' => 'A keyword that defines a specific style property in CSS', 'correct_one' => False,],
                    ['text' => 'A class or ID attribute that identifies a specific HTML element on a web page', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the difference between classes and IDs in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'Classes can be used multiple times in a document, while IDs should only be used once', 'correct_one' => True,],
                    ['text' => 'IDs can be used multiple times in a document, while classes should only be used once', 'correct_one' => False,],
                    ['text' => 'There is no difference between classes and IDs in CSS', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between a block-level element and an inline element in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'Block-level elements take up the full width of their parent container and start on a new line, while inline elements do not and are placed next to each other on the same line', 'correct_one' => True,],
                    ['text' => 'Inline elements take up the full width of their parent container and start on a new line, while block-level elements do not and are placed next to each other on the same line', 'correct_one' => False,],
                    ['text' => 'There is no difference between block-level elements and inline elements in CSS', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "float" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that specifies whether an element should be floated to the left or right of its parent container', 'correct_one' => True,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "display" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that specifies how an element should be displayed on the web page', 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "box-sizing" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => "A property that specifies whether an element's padding and border should be included in its total width and height", 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the "position" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that specifies the type of positioning used for an element', 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "z-index" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that specifies the stack order of an element', 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "opacity" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that specifies the transparency of an element', 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "box-shadow" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that adds a shadow effect to an element', 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "text-decoration" property in CSS?',
                'points' => 20,
                'track' => 4,
                'answers' => [
                    ['text' => 'A property that specifies how text should be decorated (e.g., underlined, strikethrough, etc.)', 'correct_one' => True,],
                    ['text' => 'A property that specifies the color of the text in an element', 'correct_one' => False,],
                    ['text' => 'A property that specifies the size of an element relative to its parent container', 'correct_one' => False,],
                ]
            ],



            //React js

            [
                'question' => 'What is the difference between a controlled and uncontrolled component in React?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A controlled component is a component where the state is managed by the parent component, while an uncontrolled component is a component where the state is managed by the component itself', 'correct_one' => True,],
                    ['text' => 'A controlled component is a component that can only be updated by its parent component, while an uncontrolled component can be updated by any component in the React application', 'correct_one' => False,],
                    ['text' => 'A controlled component is a component that can be rendered in multiple ways, while an uncontrolled component is a component that can only be rendered in one way', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the difference between a presentational component and a container component in React?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A presentational component is a component that is responsible for rendering UI, while a container component is a component that is responsible for managing data and passing it down to its child components', 'correct_one' => True,],
                    ['text' => 'A presentational component is a component that is responsible for managing data, while a container component is a component that is responsible for rendering UI', 'correct_one' => False,],
                    ['text' => 'A presentational component and a container component are identical in function and can be used interchangeably', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the significance of shouldComponentUpdate() in React?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'shouldComponentUpdate() is a lifecycle method in React that is used to optimize the rendering performance of a component by determining if the component needs to be re-rendered or not', 'correct_one' => True,],
                    ['text' => 'shouldComponentUpdate() is a lifecycle method in React that is used to update the state of a component when new data is received', 'correct_one' => False,],
                    ['text' => 'shouldComponentUpdate() is a lifecycle method in React that is used to handle errors that occur during the rendering process', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the purpose of React fragments?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'React fragments are a way to group a list of children without adding extra nodes to the DOM, which can help to improve performance', 'correct_one' => True,],
                    ['text' => 'React fragments are a way to add extra nodes to the DOM to improve the layout of a component', 'correct_one' => False,],
                    ['text' => 'React fragments are a way to create reusable components that can be shared across multiple applications', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A JavaScript library for building user interfaces', 'correct_one' => True,],
                    ['text' => 'A programming language for creating web applications', 'correct_one' => False,],
                    ['text' => 'A front-end framework for building responsive websites', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "Virtual DOM" in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A lightweight representation of the actual DOM in memory', 'correct_one' => True,],
                    ['text' => 'An alternative to the real DOM that does not require browser rendering', 'correct_one' => False,],
                    ['text' => 'A way of optimizing the performance of React components', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is JSX in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A syntax extension that allows XML-like code to be written in JavaScript', 'correct_one' => True,],
                    ['text' => 'A library for managing state in React components', 'correct_one' => False,],
                    ['text' => 'A tool for generating documentation from React code', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "props" object in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'An object that contains properties passed from a parent component to a child component', 'correct_one' => True,],
                    ['text' => 'An object that contains properties passed from a child component to a parent component', 'correct_one' => False,],
                    ['text' => 'An object that contains properties used to manage the state of a component', 'correct_one' => False,],
                ]
            ],

            [
                'question' => 'What is the "state" object in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'An object that represents the current state of a component', 'correct_one' => True,],
                    ['text' => 'An object that represents the initial state of a component', 'correct_one' => False,],
                    ['text' => 'An object that represents the previous state of a component', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the difference between "props" and "state" in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'Props are read-only and passed from a parent component to a child component, while state is mutable and managed by the component itself', 'correct_one' => True,],
                    ['text' => 'Props are mutable and managed by the component itself, while state is read-only and passed from a parent component to a child component', 'correct_one' => False,],
                    ['text' => 'Props and state are the same thing in React.js', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is a React "component"?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A reusable piece of UI that can be rendered to the DOM', 'correct_one' => True,],
                    ['text' => 'A function that returns HTML elements', 'correct_one' => False,],
                    ['text' => 'A class that extends the React Component class', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the purpose of the "render()" method in React components?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'To return a description of the UI that the component should render', 'correct_one' => True,],
                    ['text' => 'To update the state of the component based on user input', 'correct_one' => False,],
                    ['text' => 'To define the lifecycle methods of the component', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is a "React hook"?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A function that allows you to use state and other React features in functional components', 'correct_one' => True,],
                    ['text' => 'A class that extends the React Component class', 'correct_one' => False,],
                    ['text' => 'A tool for debugging React applications', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the purpose of the "useEffect()" hook in React?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'To perform side effects in functional components, such as fetching data from an API', 'correct_one' => True,],
                    ['text' => 'To manage the state of a component based on user input', 'correct_one' => False,],
                    ['text' => 'To define the lifecycle methods of a class component', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the "virtual DOM" in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A lightweight representation of the actual DOM that React uses to optimize updates', 'correct_one' => True,],
                    ['text' => 'A way to render React components on the server side', 'correct_one' => False,],
                    ['text' => 'A tool for debugging React applications', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is "JSX" in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A syntax extension for JavaScript that allows you to write HTML-like code in your JavaScript files', 'correct_one' => True,],
                    ['text' => 'A tool for debugging React applications', 'correct_one' => False,],
                    ['text' => 'A way to render React components on the server side', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the purpose of "props drilling" in React?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'The process of passing props through multiple levels of components in order to make them available in a deeply nested component', 'correct_one' => True,],
                    ['text' => 'A way to manage the state of a component based on user input', 'correct_one' => False,],
                    ['text' => 'A tool for debugging React applications', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the purpose of "Redux" in React.js?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A predictable state container that helps manage the state of a React application', 'correct_one' => True,],
                    ['text' => 'A tool for debugging React applications', 'correct_one' => False,],
                    ['text' => 'A way to render React components on the server side', 'correct_one' => False,],
                ]
            ],
            [
                'question' => 'What is the "Context API" in React?',
                'points' => 20,
                'track' => 3,
                'answers' => [
                    ['text' => 'A way to pass data through the component tree without having to pass props down manually at every level', 'correct_one' => True,],
                    ['text' => 'A tool for debugging React applications', 'correct_one' => False,],
                    ['text' => 'A way to manage the state of a component based on user input', 'correct_one' => False,],
                ]
            ],
        ]);
    }
}
