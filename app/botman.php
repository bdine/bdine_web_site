<?php

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$config = [
    'web' => [
        'matchingData' => [],
    ]
];

// Create BotMan instance
$app['botman'] = BotManFactory::create($config);