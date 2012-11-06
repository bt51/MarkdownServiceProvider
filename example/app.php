<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Bt51\Silex\Provider\MarkdownServiceProvider\MarkdownServiceProvider;

$app = new Application();

$app->register(TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views'
));

$app->register(new MarkdownServiceProvider(),
			   array('markdown.configuration' => array()));

$app->get('/', function () use ($app) {
    $md = '#Hello World';
    
    return $app['twig']->render('test.html.twig', array(
        'md' => $md
    ));
});
