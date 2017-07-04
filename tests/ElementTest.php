<?php

/**
 * @package Tests
 */
namespace Tests;

use \HTMLBuilder\Element;
use \HTMLBuilder\Interfaces\InterfaceElements;

class ElementTest extends \PHPUnit_Framework_TestCase
{

    public function testInstanceElement()
    {
        $this->assertInstanceOf(InterfaceElements::class, new Element('tag'));
    }

    public function testCreateElement()
    {
        $t = new Element('tag');

        $this->assertEquals('<tag></tag>', $t->render());
    }

    public function testCreateElementSimpleContent()
    {
        $t = new Element('tag', 'Content tag');

        $this->assertEquals('<tag>Content tag</tag>', $t->render());
    }

    public function testCreateElementCompositeContent()
    {
        $t = new Element('tag', ['Content tag', new Element('tag', 'Content tag')]);

        $this->assertEquals('<tag>Content tag<tag>Content tag</tag></tag>', $t->render());
    }

    public function testCreateElementWhithAttribute()
    {
        $t = new Element('tag', 'Content tag', ['attr'=>['value1', 'value2']]);

        $this->assertEquals('<tag attr="value1 value2">Content tag</tag>', $t->render());
    }

    public function testCreateElementNestedContent()
    {
        $t = new Element('tag', [new Element('tag', [new Element('tag')])]);

        $this->assertEquals('<tag><tag><tag></tag></tag></tag>', $t->render());
    }

    public function testCreateElementNoChild()
    {
        $t = new Element('br');

        $this->assertEquals('<br>', $t->render());
    }

    public function testCreateElementNoChildWhitAttribute()
    {
        $t = new Element('link', null, ['href'=>['path/to/file'], 'rel'=>['stylesheet']]);

        $this->assertEquals('<link href="path/to/file" rel="stylesheet">', $t->render());
    }
}