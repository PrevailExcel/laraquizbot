<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\QuizConversation;
use App\Conversations\PrivacyConversation;
use App\Conversations\HighscoreConversation;
use App\Http\Middleware\PreventDoubleClicks;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Drivers\DriverManager;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        // $botman = app('botman');

        // $config = [
        // 'telegram' => [
        //     'token' => config('botman.telegram.token'),
        // ]
        // ];
        $config = [
            'user_cache_time' => 720,

            'config' => [
                'conversation_cache_time' => 720,
            ],

            // Your driver-specific configuration
            "telegram" => [
                "token" => env('TELEGRAM_TOKEN'),
            ]
        ];

        // // Create BotMan instance
        $botman = BotManFactory::create($config, new LaravelCache());

        $botman->middleware->captured(new PreventDoubleClicks);

        $botman->hears('start|/start', function (BotMan $bot) {
            $bot->startConversation(new QuizConversation());
        })->stopsConversation();

        $botman->hears('/highscore|highscore', function (BotMan $bot) {
            $bot->startConversation(new HighscoreConversation());
        })->stopsConversation();

        $botman->hears('/about|about', function (BotMan $bot) {
            $bot->reply('This is a BotMan and Laravel 8 project by Ejimadu Prevail.');
        })->stopsConversation();

        $botman->hears('/deletedata|deletedata', function (BotMan $bot) {
            $bot->startConversation(new PrivacyConversation());
        })->stopsConversation();

        // $botman->fallback(function ($bot) {
        //     $bot->reply("Sorry, I am just a Laravel quiz bot. Type 'start' or click on '/start to begin. See menu for other commands");
        // });

        $botman->listen();
    }
}
