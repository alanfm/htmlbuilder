<?php
header("Accept-Encoding: gzip");
header("cache-control: must-revalidate");

/**
 * Carregamento automatico das classes
 */
$autoload = __DIR__ . '/vendor/autoload.php';

if (!file_exists($autoload)) {
    echo 'Por favor instalar as dependências do composer: <code>$ composer install</code>';
    exit;
}

include_once $autoload;

use HTMLBuilder\Page;
use HTMLBuilder\Factory;
use HTMLBuilder\Tags\Table;

$page = new Page('Minha Página!');
$page->add_in_head(Factory::make('base')->attr('href', ['http://html.dev/htmlBuilder']));
$page->add_in_head(Factory::make('meta')->attr('charset', ['utf-8']));
$page->add_in_body(Factory::make('h1')->value('Minha Página!'));
$page->add_in_body(Factory::make('hr'));
$page->add_in_body(Factory::make('p')->value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'));

#########################
# Usando a classe Table #
#########################

// Titulo das colunas
$titles = ['#', 'Nome', 'Telefone'];
// Conteúdo das celulas
$content = [
    [1, 'Fulano de Tals', '(88) 652882369'],
    [2, 'Beltarno da Silva', '(88) 659556699'],
    [3, 'Cicrano Pereira', '(88) 875952369'],
    [4, 'Marciano Teles', '(88) 789456123'],
];
// Adicionando ao body
$page->add_in_body((new Table($titles, $content))->attr('border', 1)->render());

$page->render();