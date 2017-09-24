<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Translation\Loader\YamlFileLoader;

ErrorHandler::register();
ExceptionHandler::register();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1'
));

$app->register(new Pmaxs\Silex\Locale\Provider\LocaleServiceProvider(), [
    'locale.locales' => ['en', 'fr'],
    'locale.default_locale' => 'fr',
    'locale.resolve_by_host' => false,
    'locale.exclude_routes' => ['^_'],
]);

$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('fr'),
));

$app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());
    $translator->addResource('yaml', __DIR__.'/../locales/en.yml', 'en');
    $translator->addResource('yaml', __DIR__.'/../locales/fr.yml', 'fr');
    return $translator;
});

$app->register(new Silex\Provider\LocaleServiceProvider());

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

require __DIR__.'/botman.php';
require __DIR__.'/services.php';
