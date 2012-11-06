<?php

namespace MarkdownServiceProvider\Tests;

use Silex\Application;
use Bt51\Silex\Provider\MarkdownServiceProvider\MarkdownServiceProvider;
use dflydev\markdown\MarkdownParser;

class MarkdownServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('dflydev\\markdown\\MarkdownParser')) {
            $this->markTestSkipped('Markdown Parser is not installed');
        }
    }
    
    public function testMarkdown()
    {
        $parser = $this->getParser();
        $md = $parser->transformMarkdown('#Hello World');
        $this->assertEquals('<h1>Hello World</h1>', trim($md));
    }
    
    public function testSilexMarkdown()
    {
        if (!class_exists('Twig_Environment')) {
            $this->markTestSkipped('Twig is not installed.');
        }
        
        $app = new Application();
        
        $app['twig'] = $app->share(function () {
            $loader = new \Twig_Loader_String();
            return new \Twig_Environment($loader);
        });
        
        $app->register(new MarkdownServiceProvider());
        
        $md = $app['markdown']->transformMarkdown('#Hello World');
        $this->assertEquals('<h1>Hello World</h1>', trim($md));
    }
    
    public function testTwigExtension()
    {
        if (!class_exists('Twig_Environment')) {
            $this->markTestSkipped('Twig is not installed.');
        }

        $app = new Application();

        $app['twig'] = $app->share(function () {
            $loader = new \Twig_Loader_String();
            return new \Twig_Environment($loader);
        });

        $app->register(new MarkdownServiceProvider());
        
        $this->assertInstanceOf('Bt51\\Silex\\Provider\\MarkdownServiceProvider\\Twig\\MarkdownExtension',
                                $app['twig']->getExtension('markdown'));
    }
    
    protected function getParser()
    {
        return new MarkdownParser();
    }
}
