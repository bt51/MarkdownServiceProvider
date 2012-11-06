MarkdownServiceProvider
================

The MarkdownServiceProvider provides the "dflydev/markdown" library for silex.

Installation
------------

Create a composer.json your project

    {
        "require": {
            "bt51/markdown-serviceprovider": "dev-master"
        }
    }

Read more on composer here: http://getcomposer.org

Parameters
----------

* **markdown.configuration**: An array of options to be passed to the parser's constructor

Services
--------

* **markdown**: Instance of dflydev\markdown\MarkdownParser
* **markdown.extra**: Instance of dflydev\markdown\MarkdownParserExtra

Registering
----------

See the *example/* directory to see how to register the service

Twig
----

There is also a twig filter registered within twig extensions.
See the *example/* directory for more information on how to use it.

License
-------

MIT
