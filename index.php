<?php
header("Accept-Encoding: gzip");
header("cache-control: must-revalidate");

/**
 * Carregamento automatico das classes
 */
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload) === false) {
    print('Por favor instalar as dependências do composer');
    exit;
}

include_once $autoload;

use HTML\Page;
use HTML\Factory;

$page = new Page('Minha Página!');
$page->add_in_head(Factory::make('base')->attr('href', ['http://html.dev']));
$page->add_in_head(Factory::make('meta')->attr('charset', ['utf-8']));
$page->add_in_body(Factory::make('h1')->value('Minha Página!'));
$page->add_in_body(Factory::make('hr'));
$page->add_in_body(Factory::make('p')->value('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'));
$page->show();