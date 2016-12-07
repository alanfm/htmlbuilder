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

$ul = new Tag('ul', [new Tag('li', 'Item 1'), new Tag('li', 'Item 2'), new Tag('li', 'Item 2')]);

$html->addInBody(new Tag('h1', 'Minha Página com PHP!', ['class'=>['teste'], 'id'=>['my-title']]))
     ->addInBody(new Tag('p', ['Pequeno texto para teste', new Tag('br'), 'Minha Página!', new Tag('br'), 'Outra linha!']))
     ->addInHead(new Tag('title', 'Minha Página!'))
     ->addInBody($ul)
     ->addInBody(new Tag('div', [new Tag('ul', [new Tag('li', [new Tag('a', 'Link', ['href'=>['#teste']])])])]));

echo $html->build();