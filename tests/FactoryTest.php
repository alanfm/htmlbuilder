<?php

use \HTML\Factory;
use \HTML\Interfaces\InterfaceTags;

class FactoryTest extends PHPUnit_Framework_TestCase
{

    public function testInstanceTag()
    {
        $this->assertInstanceOf(InterfaceTags::class, Factory::make('tag'));
    }

    public function testCreateTag()
    {
        $t = Factory::make('tag');

        $this->assertEquals('<tag></tag>', $t->build());
    }

    public function testCreateTagSimpleContent()
    {
        $t = Factory::make('tag', 'Content tag');

        $this->assertEquals('<tag>Content tag</tag>', $t->build());
    }

    public function testCreateTagCompositeContent()
    {
        $t = Factory::make('tag')->value(['Content tag', Factory::make('tag')->value('Content tag')]);

        $this->assertEquals('<tag>Content tag<tag>Content tag</tag></tag>', $t->build());
    }

    public function testCreateTagWhithAttribute()
    {
        $t = Factory::make('tag')->value('Content tag')->attr(['attr'=>['value1', 'value2']]);

        $this->assertEquals('<tag attr="value1 value2">Content tag</tag>', $t->build());
    }

    public function testCreateTagNestedContent()
    {
        $t = Factory::make('tag')->value([Factory::make('tag')->value([Factory::make('tag')])]);

        $this->assertEquals('<tag><tag><tag></tag></tag></tag>', $t->build());
    }

    public function testCreateTagNoChild()
    {
        $t = Factory::make('br');

        $this->assertEquals('<br>', $t->build());
    }

    public function testCreateTagNoChildWhitAttribute()
    {
        $t = Factory::make('link')->att(['href'=>['path/to/file'], 'rel'=>['stylesheet']]);

        $this->assertEquals('<link href="path/to/file" rel="stylesheet">', $t->build());
    }
}