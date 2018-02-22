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
use HTMLBuilder\ElementFactory;

/**
 * @class Table
 * 
 * Implementa uma ferramenta de criação de tabelas em HTML
 * 
 * @author Alan Freire <alan_freire@msn.com>
 * @version 1.0.0
 * @copyright MIT 2017
 */
class Paragraph implements InterfaceElements
{
    public function __construct($content = null, array $attributes = array())
    {
        $this->paragraph = ElementFactory::make("p");

        $this->paragraph->value($content);

        if (count($attributes) > 0) {
            $this->paragraph->attr($attributes);
        }
    }

    public function value($content)
    {
        $this->paragraph->value($content);

        return $this;
    }

    public function attr($attributes, $value = null)
    {
        $this->paragraph->attr($attributes, $value);

        return $this;
    }

    public function render()
    {
        echo $this->paragraph->render();
    }
}