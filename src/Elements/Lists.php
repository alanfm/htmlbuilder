<?php

namespace HTMLBuilder\Elements;

use HTMLBuilder\Element;

class Lists extends Element
{
    private $items;

    public function __construct(array $items = null, string $type = 'unordered')
    {
        $this->type($type);
        $this->item($items);
    }

    private function type(string $type)
    {
        $type = strtolower($type);
        switch($type) {
            case 'unordered':
                $this->setName('ul');
                break;
            case 'ordered':
                $this->setName('ol');
                break;
            default:
                $this->setName('ul');
        }
    }

    private function item($item)
    {
        if (is_array($item)) {
            foreach($item as $chave => $value) {
                if (is_array($value)) {
                    $this->addItems($key, $value);
                } else {
                    $this->addItems($value);
                }
            }

            return $this;
        }

        $this->addItems($item);

        return $this;
    }

    public function addItems($value, $attr = null)
    {
        $this->items[] = new Element('li', $value, $attr);

        return $this;
    }

    public function show()
    {
        $this->value($this->items);

        echo $this->render();
    }
}