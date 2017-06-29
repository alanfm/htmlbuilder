<?php

/**
 * @package HTML
 */
namespace HTML\Tags;

/**
 * @dependence InterfaceTags
 * @dependence Factory
 */
use HTML\Interfaces\InterfaceTags;
use HTML\Factory;

/**
 * @class Table
 * 
 * Implementa uma ferramenta de criação de tabelas em HTML
 * 
 * @author Alan Freire <alan_freire@msn.com>
 * @version 1.0.0
 * @copyright MIT 2017
 */
class Table implements InterfaceTags
{

    /**
     * @var InterfaceTags $table
     */
    private $table;

    /**
     * @var string $titles
     * 
     * Recebe os titulos das colunas da tabela
     */
    private $titles;

    /**
     * @var array $content
     * 
     * Recebe uma matriz com os dados da tabela
     */
    private $content;

    /**
     * @method __construct()
     * 
     * @param array $titles
     * @param array $content
     */
    public function __construct(array $titles = null, array $content = null)
    {
        $this->table = Factory::make('table');
        $this->titles = $titles;
        $this->value($content);
    }

    /**
     * @method titles
     * 
     * Seta o valor dos titulos das colunas da tabela
     * 
     * @param array $titles
     * 
     * @return InterfaceTags (Table)
     */
    public function titles(array $titles)
    {
        if (!is_array($titles)) {
            throw new \Exception('Parametro inválido! O valor esperado é um vetor');
        }

        $this->titles = $titles;

        return $this;
    }

    /**
     * @method thead_render()
     * 
     * Constroi a tag thead
     * 
     * @return string
     */
    private function thead_render()
    {
        $tr = Factory::make('tr');

        foreach ($this->titles as $text) {
            $tr->value(Factory::make('th')->value($text));
        }

        return Factory::make('thead')->value($tr)->render();
    }

    /**
     * @method tbody_render()
     * 
     * Constroi a tag tbody
     * 
     * @return string
     */
    private function tbody_render()
    {
        $tbody = Factory::make('tbody');

        foreach ($this->content as $row) {
            $tr = Factory::make('tr');

            foreach ($row as $cell) {
                $tr->value(Factory::make('td')->value($cell)->render());
            }

            $tbody->value($tr);
        }

        return $tbody->render();
    }

    /**
     * @method value()
     * 
     * Seta o conteúdo da tabela
     * 
     * @param array(matriz) $value
     * 
     * @return InterfaceTag(Table)
     */
    public function value($value)
    {
        if (!is_array($value)) {
            throw new \Exception('Parametro inválido! O valor esperado é uma matriz.');
        }

        foreach ($value as $v) {
            if (!is_array($v)) {
                throw new \Exception('Parametro inválido! O valor esperado é uma matriz.');
            }

            break;
        }

        $this->content = $value;

        return $this;

    }

    /**
     * @method attr()
     * 
     * Adiciona atributos para a tag table
     * 
     * @param string $attr
     * @param mix $value
     * 
     * @return InterfaceTag(Table)
     */
    public function attr($attr, $value)
    {
        $this->table->attr($attr, $value);

        return $this;
    }

    /**
     * @method render()
     * 
     * Renderiza o elemento table
     * 
     * @return string
     */
    public function render()
    {
        $this->table->value($this->thead_render())
                    ->value($this->tbody_render());

        return $this->table->render();
    }
}