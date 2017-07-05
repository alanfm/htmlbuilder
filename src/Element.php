<?php
/**
 * @package HTML
 */
namespace HTMLBuilder;

/**
 * @dependences InterfaceElements
 */
use HTMLBuilder\Interfaces\InterfaceElements;

/**
 * @class Element
 * 
 * Contem um algoritmo de criação de tags HTML
 */
class Element implements InterfaceElements
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $value = [];

    /**
     * @var array
     */
    private $attr = [];

    /**
     * @var string
     */
    private $tag;

    /**
     * @var array
     */
    private $elementsNoClosing = ['area', 'col', 'command', 'embed', 'keygen', 'param', 'source', 'track', 'wbr', 'br', 'link', 'meta', 'hr', 'img', 'input', 'base'];


    /**
     * @method __construct
     * @param string
     * @param mix
     * @param array
     */
    public function __construct(string $name, $value = null, array $attr = [])
    {
        $this->name = strtolower($name);
        $this->value($value);
        $this->attr = $attr;
    }

    /**
     * @method value
     * @param mix
     * @return object
     */
    public function value($value)
    {
        $this->value[] = $value;

        return $this;
    }

    /**
     * @method
     * @param string
     * @param array
     * @return object
     */
    public function attr($attr, $value = null)
    {
        if (is_array($attr)) {
            $this->attr = array_merge($attr, $this->attr);
            
            return $this;
        }

        $this->attr[$attr] = $value;

        return $this;
    }

    /**
     * @method render
     * 
     * @return string;
     */
    public function render()
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
        $this->tag = trim($this->tag) . '>';

        if (!in_array(strtolower($this->name), $this->elementsNoClosing)) {
            $this->tag .= $this->parseValue($this->value) . '</' . $this->name . '>';
        }

        return $this->tag;
    }

    public function __tostring()
    {
        $this->render();
    }

    /**
     * @method parseValue
     * @param mix
     * @return mix
     */
    private function parseValue($value)
    {
        if (is_object($value)) {
            return $value->render();
        }

        if (is_array($value)) {
            $str = '';
            foreach($value as $v) {
                $str .= $this->parseValue($v);
            }
            return $str;
        }

        if (is_null($value)) {
            return '';
        }

        return $value;
    }
}