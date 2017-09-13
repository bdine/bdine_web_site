<?php


$app->get('/', function() use ($app) {
    return $app->redirect($app["url_generator"]->generate("main"));
});

$app->get('/main', function() use ($app)  {
    return $app['twig']->render(
        'main.html.twig'
    );
})->bind("main");
/*

$app->get('/skills', function() use ($app)  {
    return $app['twig']->render(
        'skills.html.twig'
    );
})->bind("skills");

$app->get('/experiences', function() use ($app)  {
    return $app['twig']->render(
        'experiences.html.twig'
    );
})->bind("experiences");*/
