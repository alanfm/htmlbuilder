<?php

namespace HTML;

use HTML\Factory;

class Page
{
    private $html;
    private $head;
    private $body;

    public function __construct($title)
    {
        $this->html = Factory::make('html')->attr('lang', ['pt-br']);
        $this->head = Factory::make('head')->value(Factory::make('title')->value($title));
        $this->body = Factory::make('body');
    }

    public function add_in_body($value)
    {
        $this->body->value($value);
    }

    public function add_in_head($value)
    {
        $this->head->value($value);
    }

    public function show()
    {
        echo '<!DOCTYPE html>', $this->html->value($this->head)->value($this->body)->build();
    }
}