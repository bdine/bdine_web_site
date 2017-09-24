<?php

use Symfony\Component\Yaml\Yaml;

$app['chatbot.controller'] = function () use ($app) {
    return new \WebSite\Controller\Chatbot\ChatbotController($app['botman'], $app['translator'], new Symfony\Component\Yaml\Parser());
};