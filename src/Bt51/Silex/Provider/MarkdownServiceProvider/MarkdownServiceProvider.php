<?php

/*
 * This file is part of MarkdownServiceProvider
 *
 * (c) Ben Tollakson <ben.tollakson@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bt51\Silex\Provider\MarkdownServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Bt51\Silex\Provider\MarkdownServiceProvider\Twig\MarkdownExtension;
use dflydev\markdown\MarkdownParser;
use dflydev\markdown\MarkdownExtraParser;

class MarkdownServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (! isset($app['twig'])) {
            throw new \InvalidArgumentException('You must register the twig service provider first');
        }
        $app['markdown.configuration'] = (isset($app['markdown.configuration']) ? $app['markdown.configuration'] : array());
        
        $app['markdown'] = $app->share(function () use ($app) {
            return new MarkdownParser($app['markdown.configuration']);
        });
        
        $app['markdown.extra'] = $app->share(function () use ($app) {
            return new MarkdownExtraParser($app['markdown.configuration']);
        }); 
        
        $app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
            $twig->addExtension(new MarkdownExtension($app['markdown']));
            return $twig;
        }));
    }   

    public function boot(Application $app)
    {   
    }   
}
