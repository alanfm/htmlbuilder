<?php

/**
 * @package HTMLBuilder
 */
namespace HTMLBuilder;

/**
 * @dependences Elements
 */
use HTMLBuilder\Element;

/**
 * @class ElementFactory
 * 
 * Fabrica instâncias da classe Elements
 */
class ElementFactory
{
    /**
     * @method make()
     * 
     * Cria instâncias da classe Element
     * 
     * @param string $name
     */
    public static function make(string $name)
    {
        if (!is_string($name)) {
            throw new \Exception("Argumento inválido!");
        }

        return new Element($name);
    }
}