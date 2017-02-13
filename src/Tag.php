<?php
/**
 * @package HTML
 */
namespace HTML;

/**
 * @dependences InterfaceTags
 */
use HTML\Interfaces\InterfaceTags;

/**
 * @class Tag
 * 
 * Contem um algoritmo de criação de tags HTML
 */
class Tag implements InterfaceTags
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
    private $listTag = ['br', 'link', 'meta', 'hr', 'img', 'input', 'base'];


    /**
     * @method __construct
     * @param string
     * @param mix
     * @param array
     */
    public function __construct(string $name, $value = null, array $attr = [])
    {
        $this->name = $name;
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
        if (is_int($value) || is_bool($value) || is_double($value)) {
            throw new Exception("Por favor insira um valor válido");
        }

        $this->value[] = $value;

        return $this;
    }

    /**
     * @method
     * @param string
     * @param array
     * @return object
     */
    public function attr(string $attr, array $value)
    {
        $this->attr[$attr] = $value;

        return $this;
    }

    /**
     * @method build
     * @return string;
     */
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
        $this->tag = trim($this->tag) . '>';

        if (!in_array(strtolower($this->name), $this->listTag)) {
            $this->tag .= $this->parseValue($this->value) . '</' . $this->name . '>';
        }

        return $this->tag;
    }

    /**
     * @method parseValue
     * @param mix
     * @return mix
     */
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