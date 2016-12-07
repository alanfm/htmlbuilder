<?php

/**
 * @package Tests
 */
namespace Tests;

use \HTML\Tag;
use \HTML\Interfaces\InterfaceTags;

class TagTest extends \PHPUnit_Framework_TestCase
{

    public function testInstanceTag()
    {
        $this->assertInstanceOf(InterfaceTags::class, new Tag('tag'));
    }

    public function testCreateTag()
    {
        $t = new Tag('tag');

        $this->assertEquals('<tag></tag>', $t->build());
    }

    public function testCreateTagSimpleContent()
    {
        $t = new Tag('tag', 'Content tag');

        $this->assertEquals('<tag>Content tag</tag>', $t->build());
    }

    public function testCreateTagCompositeContent()
    {
        $t = new Tag('tag', ['Content tag', new Tag('tag', 'Content tag')]);

        $this->assertEquals('<tag>Content tag<tag>Content tag</tag></tag>', $t->build());
    }

    public function testCreateTagWhithAttribute()
    {
        $t = new Tag('tag', 'Content tag', ['attr'=>['value1', 'value2']]);

        $this->assertEquals('<tag attr="value1 value2">Content tag</tag>', $t->build());
    }

    public function testCreateTagNestedContent()
    {
        $t = new Tag('tag', [new Tag('tag', [new Tag('tag')])]);

        $this->assertEquals('<tag><tag><tag></tag></tag></tag>', $t->build());
    }

    public function testCreateTagNoChild()
    {
        $t = new Tag('br');

        $this->assertEquals('<br>', $t->build());
    }

    public function testCreateTagNoChildWhitAttribute()
    {
        $t = new Tag('link', null, ['href'=>['path/to/file'], 'rel'=>['stylesheet']]);

        $this->assertEquals('<link href="path/to/file" rel="stylesheet">', $t->build());
    }
}