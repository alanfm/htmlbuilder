<?php

namespace HTML\Interfaces;

interface InterfaceTags
{
    public function value($value);
    public function attr($attr, array $value);
    public function build();
}