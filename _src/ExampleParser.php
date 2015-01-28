<?php
/**
 * Created by PhpStorm.
 * User: tjlytle
 * Date: 1/2/15
 * Time: 10:39 AM
 */

class ExampleParser extends \League\CommonMark\Block\Parser\AbstractBlockParser
{
    protected $path;

    public function __construct()
    {
        $this->setCurrentPath(getcwd());
    }

    /**
     * @param \League\CommonMark\ContextInterface $context
     * @param \League\CommonMark\Cursor $cursor
     *
     * @return bool
     */
    public function parse(\League\CommonMark\ContextInterface $context, \League\CommonMark\Cursor $cursor)
    {
        $line = $cursor->getLine();

        //either a line starting with 'example:' (expected to have a set of links)
        //or a line starting with [example] (a single link)

        //remove potential markdown formatting (except what we need)
        $check = preg_replace('#[^a-z:\[\]]#', '', strtolower($line));
        if(substr($check, 0, 8) != 'example:' AND substr($check, 0, 9) != '[example]'){
            return false;
        }

        $context->addBlock(new ExampleElement($cursor->getLine(), $this->path));
        $cursor->advanceBy(strlen($line));

        $context->setBlocksParsed(true);

        return true;
    }

    /**
     * Allow relative links to work by allowing the current path to be set.
     *
     * @param $path
     */
    public function setCurrentPath($path)
    {
        if(!file_exists($path)){
            throw new \InvalidArgumentException('invalid path');
        }

        $this->path = $path;
    }
}