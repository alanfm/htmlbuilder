<?php

namespace HTML;

use HTML\Tag;

class Factory
{
    public static function make(string $name)
    {
        if (!is_string($name)) {
            throw new \Exception("Argumento inválido!");
        }

        return new Tag($name);
    }
}