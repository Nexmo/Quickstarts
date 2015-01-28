<?php
/**
 * Created by PhpStorm.
 * User: tjlytle
 * Date: 1/5/15
 * Time: 3:50 PM
 */

class ExampleElement extends \League\CommonMark\Block\Element\AbstractInlineContainer
{
    protected $path;

    protected $tabs = array();

    public function __construct($content, $path)
    {
        parent::__construct();

        //so relative links work
        $this->path = $path;

        //expecting that this line has a set of links to example code
        $this->addLine($content);
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns true if this block can contain the given block as a child node
     *
     * @param \League\CommonMark\Block\Element\AbstractBlock $block
     *
     * @return bool
     */
    public function canContain(\League\CommonMark\Block\Element\AbstractBlock $block)
    {
        return false;
    }

    /**
     * Returns true if block type can accept lines of text
     *
     * @return bool
     */
    public function acceptsLines()
    {
        return true;
    }

    /**
     * Whether this is a code block
     *
     * @return bool
     */
    public function isCode()
    {
        return false;
    }

    /**
     * @param \League\CommonMark\Cursor $cursor
     *
     * @return bool
     */
    public function matchesNextLine(\League\CommonMark\Cursor $cursor)
    {
        return false;
    }

    /**
     * @param \League\CommonMark\ContextInterface $context
     * @param \League\CommonMark\Cursor $cursor
     */
    public function handleRemainingContents(\League\CommonMark\ContextInterface $context, \League\CommonMark\Cursor $cursor)
    {
        // nothing to do; we already added the contents.
    }

    public function finalize(\League\CommonMark\ContextInterface $context)
    {
        parent::finalize($context);

        $this->finalStringContents = implode("\n", $this->getStrings());
    }
}