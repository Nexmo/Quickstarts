<?php
/**
 * Builds static pages from README and code samples.
 */

use Aura\Cli\CliFactory;
require_once 'vendor/autoload.php';

//cli setup
$factory = new CliFactory();
$cli = $factory->newContext($GLOBALS);
$io = $factory->newStdio();

$getop = $cli->getopt([
    'b,build:',
    'p,path:',
    'e,env:'
]);

//config
$buildDir    = $getop->get('--build', __DIR__ . '/_build');
$webPath     = $getop->get('--path',  '/Quickstarts');
$environment = $getop->get('--env',   'development');

//markdown
$io->out('setting up markdown...');
$env = \League\CommonMark\Environment::createCommonMarkEnvironment();
$exampleParser = new ExampleParser();
$exampleRenderer = new ExampleRenderer();
$linkRenderer = new LinkRenderer(['nexmo.github.io', 'nexmo.com', 'docs.nexmo.com', 'dashboard.nexmo.com', 'help.nexmo.com']);

$io->out('adding custom parsers/renderers...');
$env->addBlockParser($exampleParser);
$env->addBlockRenderer('ExampleElement', $exampleRenderer);
$env->addInlineRenderer('League\CommonMark\Inline\Element\Link', $linkRenderer);

$parser = new \League\CommonMark\DocParser($env);
$renderer = new \League\CommonMark\HtmlRenderer($env);
$io->outln('done');

//mustache
$io->out('setting up mustache template loader...');
$mustache = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . '/_templates')
]);
$io->outln('done');

$io->out('checking for index README.md...');
if(!file_exists('./README.md')){
    throw new Exception('missing quickstart index');
}

$index = $parser->parse(file_get_contents('./README.md'));
$io->outln('done');

$io->outln('parsing index README.md for sections and quickstarts');
$nav = [];
$current = null;
foreach($index->getChildren() as $child){
    if($child instanceof \League\CommonMark\Block\Element\Header AND $child->getLevel() == 2){
        $current = [
            'label' => $child->getStringContent(),
            'pages' => []
        ];
        $io->outln('found section: ' . $current['label']);
        continue;
    }

    if($current AND $child instanceof \League\CommonMark\Block\Element\ListBlock){
        foreach($child->getChildren() as $item){
            foreach($item->getChildren() as $inline){
                if($inline instanceof \League\CommonMark\Block\Element\AbstractInlineContainer){
                    foreach($inline->getInlines() as $element){
                        if($element instanceof \League\CommonMark\Inline\Element\Link){
                            $label = '';
                            foreach($element->getLabel()->getInlines() as $string){
                                if($string instanceof \League\CommonMark\Inline\Element\AbstractStringContainer){
                                    $label .= $string->getContent();
                                }
                            }
                            $page = [
                                'path' => $element->getUrl(),
                                'label' => $label
                            ];
                            $current['pages'][] = $page;
                            $io->outln('found page: ' . $page['label']);
                        }
                    }
                }
            }
        }
        $nav[] = $current;
        $current  = null;
    }
}
$io->outln('navigation parsed');

$io->outln('generating pages...');
foreach($nav as $sectionIndex => $section){
    foreach($section['pages'] as $pageIndex => $page){
        $exampleParser->setCurrentPath($page['path']);
        $io->outln('looking for: ' . $page['label']);
        $source = file_get_contents($page['path'] . '/README.md');
        if(empty($source)){
            throw new Exception('missing readme for ' . $page['path']);
        }

        $parsed = $parser->parse($source);

        $io->out('looking for page variables...');
        $title = null;
        $lead  = null;
        $video = null;
        $next = null;

        foreach($parsed->getChildren() as $child){
            //first H1 is the title, we pull it out
            if(!$title AND $child instanceof \League\CommonMark\Block\Element\Header AND $child->getLevel() == 1){
                $io->out('title...');
                $title = $child->getStringContent();
                $parsed->removeChild($child);
                continue;
            }

            //look for first 'video' link, remove from doc, use as template var
            if(!$video AND $child instanceof \League\CommonMark\Block\Element\Paragraph AND $child->getInlines()){
                foreach($child->getInlines() as $inline){
                    if($inline instanceof \League\CommonMark\Inline\Element\Link AND 'video' == strtolower($renderer->renderInlines($inline->getLabel()->getInlines()))){
                        $io->out('video...');
                        $video = $inline->getUrl();
                        $video = substr($video, strpos($video, 'vimeo.com') + 10); //we only want the id
                        $parsed->removeChild($child);
                        continue 2;
                    }
                }
            }

            //first paragraph without a video link is the lead, not removed, but used in the template as well
            if(!$lead AND $child instanceof \League\CommonMark\Block\Element\Paragraph){
                $io->out('lead...');
                $lead = $child->getStringContent();
                continue;
            }

            if($lead AND $video AND $title){
                break;
            }
        }
        $io->outln('done');

        $io->out('rendering markdown...');
        $content = $renderer->renderBlock($parsed);
        $io->outln('done');

        $io->out('looking for next page...');
        if(isset($section['pages'][$pageIndex + 1])){
            $next = $section['pages'][$pageIndex + 1];
            $io->out('found ' . $next['label'] . '...');
        }
        $io->outln('done');

        $io->out('rendering page...');
        $sidebar = $nav;
        $sidebar[$sectionIndex]['pages'][$pageIndex]['current'] = true;
        $html = $mustache->render('page', [
            'title'   => $title,
            'lead'    => $lead,
            'video'   => $video,
            'next'    => $next,
            'content' => $content,
            'sidebar' => $sidebar,
            'env'     => $environment,
            'webpath' => $webPath
        ]);
        $io->outln('done');

        $io->out('saving page...');
        $path = $buildDir . '/' . $page['path'] . '/';
        $path = str_replace('/./', '/', $path);
        if(!file_exists($path)){
            $io->out('creating ' . $path . '...');
            mkdir($path, 0777, true);
        }

        file_put_contents($path . '/index.html', $html);
        $io->outln('done');
    }
}

//find icons for main navigation
$io->out('finding section icons...');
foreach($nav as $sectionIndex => $section){
    $icon = '/img/icon-' . strtolower($section['label']) . '.png';
    if(file_exists('./_assets' . $icon)){
        $io->out($section['label'] . '...');
        $nav[$sectionIndex]['icon'] = $icon;
    }
}
$io->outln('done');

$io->out('rendering index...');
$html = $mustache->render('index', [
    'nav'     => $nav,
    'env'     => $environment,
    'webpath' => $webPath
]);

$io->out('saving...');
file_put_contents($buildDir . '/index.html', $html);
$io->outln('done');

$io->out('copying static assets...');
system('cp -r ./_assets/* ' . $buildDir, $return);
if($return != 0){
    throw new Exception('failed to copy assets');
}
$io->outln('done');

$io->outln('build complete');
