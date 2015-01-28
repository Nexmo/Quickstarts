<?php
/**
 * Created by PhpStorm.
 * User: tjlytle
 * Date: 1/6/15
 * Time: 3:01 PM
 */

use League\CommonMark\HtmlElement;

class ExampleRenderer implements \League\CommonMark\Block\Renderer\BlockRendererInterface
{
    /**
     * @param \League\CommonMark\Block\Element\AbstractBlock $block
     * @param \League\CommonMark\HtmlRenderer $htmlRenderer
     * @param bool $inTightList
     *
     * @return \League\CommonMark\HtmlElement|string
     */
    public function render(\League\CommonMark\Block\Element\AbstractBlock $block, \League\CommonMark\HtmlRenderer $htmlRenderer, $inTightList = false)
    {
        if(!($block instanceof ExampleElement)){
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        //look for links
        $examples = [];
        foreach($block->getInlines() as $inline){
            if(!($inline instanceof \League\CommonMark\Inline\Element\Link)){
                continue;
            }

            $url = explode('#', $inline->getUrl());

            $file = realpath($block->getPath() . '/' . $url[0]);
            if(!$file) {
                throw new \RuntimeException('could not find example code: ' . $block->getPath() . '/' . $inline->getUrl());
            }

            $code = file($file);

            //check for specific ranges lines
            if(isset($url[1])){
                //check for valid range
                $range = explode('-', str_replace('L', '', $url[1]));

                if(!isset($code[--$range[0]])){
                    throw new Exception('invalid line range for example');
                }

                if(isset($range[1]) AND !isset($code[--$range[1]])){
                    throw new Exception('invalid line range for example');
                }

                if(isset($range[1])){
                    $code = array_slice($code, $range[0], $range[1] - $range[0] + 1);
                } else {
                    $code = array_slice($code, $range[0], 1);
                }

                //find smallest indent
                foreach($code as $line){
                    if(!preg_match('#\s*#', $line, $matches)){
                        $indent = 0;
                        break;
                    }

                    $current = strlen($matches[0]);

                    if(!isset($indent) OR ($indent > $current)){
                        $indent = $current;
                    }
                }

                if($indent){
                    foreach($code as $index => $line){
                        $code[$index] = substr($line, $indent);
                    }
                }
            }

            $code = implode('', $code);

            $examples[$htmlRenderer->renderInlines($inline->getLabel()->getInlines())] = $htmlRenderer->escape($code);
        }

        //just one example with the language 'example' just return a code block
        if(count($examples) == 1 AND strtolower(key($examples)) == 'example'){
            return new HtmlElement(
                'pre',
                array(),
                new HtmlElement('code', array(), $htmlRenderer->escape($code))
            );
        }

        ob_start();
        include __DIR__ . '/example.phtml';
        $html = ob_get_clean();
        return $html;
    }

}



