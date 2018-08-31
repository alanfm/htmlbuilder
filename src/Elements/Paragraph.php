<?php
/**
 * @package HTML
 */
namespace HTMLBuilder\Elements;

/**
 * @dependence InterfaceElements
 * @dependence Factory
 */
use HTMLBuilder\Interfaces\InterfaceElements;
use HTMLBuilder\Element;

/**
 * @class Table
 * 
 * Implementa uma ferramenta de criação de tabelas em HTML
 * 
 * @author Alan Freire <alan_freire@msn.com>
 * @version 1.2.0
 * @copyright MIT 2017
 */
class Paragraph extends Element
{
    public function __construct($content = null, array $attributes = array())
    {
        $this->setName('p');

        if (!is_null($content)) {
            $this->value($content);
        }

        if (count($attributes) > 0) {
            $this->attr($attributes);
        }
    }

    public function show()
    {
        print $this->render();
    }
}