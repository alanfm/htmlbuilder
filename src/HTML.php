<?php

namespace HTML;

use \HTML\Interfaces\InterfaceTags;
use \HTML\Tag;

class HTML implements InterfaceTags
{
    private $lang;
    private $charset;
    private $head = [];
    private $body = [];

    public function __construct(string $lang = 'pt-BR', string $charset = 'UTF-8')
    {
        $this->lang = $lang;
        $this->charset = $charset;
    }

    public function build()
    {
        $this->head[] = new Tag('meta', null, ['charset'=>[$this->charset]]);
        $this->head[] = new Tag('meta', null, ['http-equiv'=>['X-UA-Compatible'], 'content'=>['IE=edge']]);
        $this->head[] = new Tag('meta', null, ['name'=>['viewport'], 'content'=>['width=device-width, initial-scale=1']]);

        $html = new Tag('html', [new Tag('head', $this->head), new Tag('body', $this->body)], ['lang'=>[$this->lang]]);

        return '<!DOCTYPE html>' . $html->build();
    }

    public function addInBody(InterfaceTags $tag)
    {
        $this->body[] = $tag;

        return $this;
    }

    public function addInHead(InterfaceTags $tag)
    {
        $this->head[] = $tag;

        return $this;
    }
}