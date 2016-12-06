<?php

namespace HTML;

use HTML\Interfaces\InterfaceTags;

class Tag implements InterfaceTags
{
    private $name;
    private $value;
    private $attr = [];
    private $tag;
    private $listTag;

    public function __construct(string $name, $value = null, array $attr = [])
    {
        $this->name = $name;
        $this->value = $value;
        $this->attr = $attr;
        $this->listTag = ['br', 'link', 'meta', 'hr', 'img', 'input'];
    }

    public function build()
    {
        $this->tag = '<' . $this->name;

        if (count($this->attr)) {
            $this->tag .= ' ';
            foreach ($this->attr as $key => $value) {
                $this->tag .= $key . '="';
                if (is_array($value)) {
                    $this->tag .= implode(' ', $value);
                }
                $this->tag .= '" ';
            }
        }
        $this->tag .= '>';

        if (!in_array(strtolower($this->name), $this->listTag)) {
            $this->tag .= $this->parseValue($this->value) . '</' . $this->name . '>';
        }

        return $this->tag;
    }

    private function parseValue($value)
    {
        if (is_object($value)) {
            return $value->build();
        }

        if (is_array($value)) {
            $str = '';
            foreach($value as $v) {
                $str .= $this->parseValue($v);
            }
            return $str;
        }

        return $value;
    }
}