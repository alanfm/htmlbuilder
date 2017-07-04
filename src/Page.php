<?php

/**
 * @package HTMLBuilder
 */
namespace HTMLBuilder;

/**
 * @dependence HTMLBuilder\ElementFactory
 */
use HTMLBuilder\ElementFactory;

/**
 * @class Page
 * 
 * Abstrai a criação de uma página básica em HTML
 * 
 * @author Alan Freire <alan_freire@msn.com>
 * @version 1.0
 * @copyright MIT (c) 2017
 */
class Page
{
    /**
     * @var InterfaceTags
     * 
     * Recebe uma instância de Tag para uma tag html
     */
    private $html;

    /**
     * @var InterfaceTags
     * 
     * Recebe uma instância de Tag para uma tag head
     */
    private $head;

    /**
     * @var InterfaceTags
     * 
     * Recebe uma instância de Tag para uma tag body
     */
    private $body;

    /**
     * @method __construct
     * @access public
     * 
     * Seta as configurações iniciais
     * 
     * @param string $title
     * @return void
     */
    public function __construct($title)
    {
        // Cria a tag html e seta a linguem
        $this->html = ElementFactory::make('html')->attr('lang', ['pt-br']);
        // Cria a tag head e seta um valor com o titulo da página
        $this->head = ElementFactory::make('head')->value(ElementFactory::make('title')->value($title));
        // Cria a tag body
        $this->body = ElementFactory::make('body');

        // Seta uma meta com a códificação dos caracteres
        $this->add_in_head(ElementFactory::make('meta')->attr('charset', ['utf-8']));
        // Seta uma meta com compatibilidade do código
        $this->add_in_head(ElementFactory::make('meta')->attr('http-equiv', ['X-UA-Compatible'])->attr('content',['IE=edge']));
        // Seta uma meta com os parametros de acessibilidade para o código CSS
        $this->add_in_head(ElementFactory::make('meta')->attr('name', ['viewport'])->attr('content', ['width=device-width, initial-scale=1']));
    }

    /**
     * @method add_in_body
     * @access public
     * 
     * Adiciona um valor na tag body
     * 
     * @param mix $value
     * @return object of Page
     */
    public function add_in_body($value)
    {
        $this->body->value($value);

        return $this;
    }

    /**
     * @method add_in_head
     * @access public
     * 
     * Adiciona um valor na tag head
     * 
     * @param minx
     * @return object of Page
     */
    public function add_in_head($value)
    {
        $this->head->value($value);

        return $this;
    }

    /**
     * @method render
     * @access public
     * 
     * Envia para o browser o código html
     * 
     * @return void
     */
    public function render()
    {
        echo '<!DOCTYPE html>', $this->html->value($this->head)->value($this->body)->render();
    }
}