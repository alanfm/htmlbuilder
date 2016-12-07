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

$html->addInHead(new Tag('title', 'htmlBuilder'));
$html->addInBody(new Tag('h1', 'Pagina criado com htmlBuilder'))
     ->addInBody(new Tag('p', 'Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.'))
     ->addInBody(new Tag('hr'))
     ->addInBody(new Tag('small', ['Desenvolvido por ', new Tag('a', 'Alan Freire', ['href'=>['//facebook.com/alan.freire']])]));

echo $html->build();