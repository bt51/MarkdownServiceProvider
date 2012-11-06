<?php

/*
 * This file is part of MarkdownServiceProvider
 *
 * (c) Ben Tollakson <ben.tollakson@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bt51\Silex\Provider\MarkdownServiceProvider\Twig;

class MarkdownExtension extends \Twig_Extension
{
    private $parser;
    
    public function __construct($parser)
    {
        $this->parser = $parser;
    }
    
    public function getFilters()
    {
        return array('markdown' => new \Twig_Filter_Method($this, 'markdown', array('is_safe' => array('html'))));
    }
    
    public function markdown($content)
    {
        return $this->parser->transformMarkdown($content);
    }
    
    public function getName()
    {
        return 'markdown';
    }
}
