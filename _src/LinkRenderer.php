<?php
/**
 * Created by PhpStorm.
 * User: tjlytle
 * Date: 1/21/15
 * Time: 2:08 PM
 */
use League\CommonMark\HtmlElement;

class LinkRenderer implements \League\CommonMark\Inline\Renderer\InlineRendererInterface
{
    protected $hosts = [];

    public function __construct($hosts)
    {
        $this->hosts = $hosts;
    }

    /**
     * @param \League\CommonMark\Inline\Element\AbstractInline $inline
     * @param \League\CommonMark\HtmlRenderer $htmlRenderer
     *
     * @return \League\CommonMark\HtmlElement|string
     */
    public function render(\League\CommonMark\Inline\Element\AbstractInline $inline, \League\CommonMark\HtmlRenderer $htmlRenderer)
    {
        if (!($inline instanceof \League\CommonMark\Inline\Element\Link)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        $attrs = array();

        $attrs['href'] = $htmlRenderer->escape($inline->getUrl(), true);

        if (isset($inline->attributes['title'])) {
            $attrs['title'] = $htmlRenderer->escape($inline->attributes['title'], true);
        }

        if ($this->isExternalUrl($inline->getUrl())){
            $attrs['class'] = 'external-link';
        }

        return new HtmlElement('a', $attrs, $htmlRenderer->renderInlines($inline->getLabel()->getInlines()));
    }

    private function isExternalUrl($url)
    {
        $host = parse_url($url, PHP_URL_HOST);

        if(empty($host)){
            return false;
        } elseif (in_array($host, $this->hosts)){
            return false;
        }

        return true;
    }
}