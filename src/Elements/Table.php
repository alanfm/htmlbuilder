<?php

/**
 * @package HTML
 */
namespace HTMLBuilder\Elements;

/**
 * @dependence InterfaceElements
 * @dependence Factory
 */
use HTMLHTMLBuilder\Interfaces\InterfaceElements;
use HTMLHTMLBuilder\Factory;

/**
 * @class Table
 * 
 * Implementa uma ferramenta de criação de tabelas em HTML
 * 
 * @author Alan Freire <alan_freire@msn.com>
 * @version 1.0.0
 * @copyright MIT 2017
 */
class Table implements InterfaceElements
{

    /**
     * @var InterfaceElements $table
     */
    private $table;

    /**
     * @var string $thead
     * 
     * Recebe os titulos das colunas da tabela
     */
    private $thead;

    /**
     * @var array $tbody
     * 
     * Recebe uma matriz com os dados da tabela
     */
    private $tbody;

    /**
     * @method __construct()
     * 
     * @param array $thead
     * @param array $tbody
     */
    public function __construct(array $thead = null, array $tbody = null)
    {
        $this->table = ElementFactory::make('table');
        $this->thead = $thead;
        $this->value($tbody);
    }

    /**
     * @method thead
     * 
     * Seta o valor dos titulos das colunas da tabela
     * 
     * @param array $thead
     * 
     * @return InterfaceElements (Table)
     */
    public function thead(array $thead)
    {
        if (!is_array($thead)) {
            throw new \Exception('Parametro inválido! O valor esperado é um vetor');
        }

        $this->thead = $thead;

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
        $tr = ElementFactory::make('tr');

        foreach ($this->thead as $text) {
            $tr->value(Factory::make('th')->value($text));
        }

        return ElementFactory::make('thead')->value($tr)->render();
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
        $tbody = ElementFactory::make('tbody');

        foreach ($this->tbody as $row) {
            $tr = ElementFactory::make('tr');

            foreach ($row as $cell) {
                $tr->value(ElementFactory::make('td')->value($cell)->render());
            }

            $tbody->value($tr);
        }

        return $tbody->render();
    }

    /**
     * @method tbody()
     * 
     * Seta o conteúdo da tabela
     * 
     * @param array(matriz) $tbody
     * 
     * @return InterfaceElement(Table)
     */
    public function tbody(array $tbody)
    {
        if (!is_array($tbody)) {
            throw new \Exception('Parametro inválido! O valor esperado é uma matriz.');
        }

        foreach ($tbody as $row) {
            if (!is_array($row)) {
                throw new \Exception('Parametro inválido! O valor esperado é uma matriz.');
            }
        }

        $this->tbody = $tbody;

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
     * @return InterfaceElement(Table)
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

    /**
     * @method value()
     * 
     * Adiciona valor(es) as colunas da tabela
     * 
     * @param array $tbody
     * @return InterfaceElement(Table)
     */
    public function value($tabody)
    {
        $this->tbody($tbody);

        return $this;
    }
}