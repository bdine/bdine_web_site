<?php


$app->get('/', function() use ($app) {
    return $app->redirect($app["url_generator"]->generate("main"));
});

$app->get('/main', function() use ($app)  {
    return $app['twig']->render(
        'main.html.twig'
    );
})->bind("main");

$app->post('/chatbot/ask', "chatbot.controller:askQuestion")->bind("chatbot_ask");
