<?php
/**
 * @package HTMLBuilder
 * @subpackage Interfaces
 */
namespace HTMLBuilder\Interfaces;

/**
 * Interface InterfaceElements
 * 
 * Cria um padrão para a criação dos elementos HTML
 */
interface InterfaceElements
{
    /**
     * @method value()
     * 
     * Seta um valor para o elemento
     * 
     * @param mix
     */
    public function value($value);

    /**
     * @method attr()
     * 
     * Seta um atributo para o elemento
     * 
     * @param array $attr
     * @param mix
     */
    public function attr($attr, $value);

    /**
     * @method render
     * 
     * Renderiza o elemento criando o código html
     */
    public function render();
}