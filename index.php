<?php

/**
 * Carregamento automatico das classes
 */
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload) === false) {
    print('Por favor instalar as dependências do composer');
    exit;
}

include_once $autoload;

use HTML\Tag as Tag;

$html = new HTML\HTML();

$style[] = '.text-justify {text-align: justify;text-indent: 4rem;}';
$style[] = '.text-justify:first-letter {font-size: 140%}';

$html->addInHead(new Tag('title', 'htmlBuilder'))
     ->addInHead(new Tag('link', null, ['href'=>['https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.min.css'], 'rel'=>['stylesheet']]))
     ->addInHead(new Tag('style', $style));


$section = new Tag('section', null, ['class'=>['section']]);

$content[] = new Tag('h1', 'Pagina criada com htmlBuilder');
$content[] = new Tag('p', 'Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.', ['class'=>['text-justify']]);
$content[] = new Tag('p', 'Morbi a metus. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Nullam sapien sem, ornare ac, nonummy non, lobortis a, enim. Nunc tincidunt ante vitae massa. Duis ante orci, molestie vitae, vehicula venenatis, tincidunt ac, pede. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Etiam commodo dui eget wisi. Donec iaculis gravida nulla. Donec quis nibh at felis congue commodo. Etiam bibendum elit eget erat.', ['class'=>['text-justify']]);
$content[] = new Tag('p', 'Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris vitae tortor. In dapibus augue non sapien. Aliquam ante. Curabitur bibendum justo non orci.', ['class'=>['text-justify']]);
$content[] = new Tag('hr');
$content[] = new Tag('small', ['Desenvolvido por ', new Tag('a', 'Alan Freire', ['href'=>['//facebook.com/alan.freire']])]);

$section->setValue(new Tag('div', new Tag('div', $content, ['class'=>['content']]), ['class'=>['container']]));

$html->addInBody($section);

echo $html->build();