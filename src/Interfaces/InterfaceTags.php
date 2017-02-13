<?php

namespace HTML\Interfaces;

interface InterfaceTags
{
    public function value($value);
    public function attr(string $name, array $value);
    public function build();
}