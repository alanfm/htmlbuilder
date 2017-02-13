# htmlBuilder


## Simples classe para criação de tags HTML

Ĉlasse que traz uma interface para criação de tags `HTML`. Feito em `PHP` para sistema que necessitam criar de forma dinâmica códigos `HTML`. E possibilita o uso dos scripts `PHP` sem a necessidade de misturar com códigos `HTML`

O sistema funciona de forma simples, podendo ser utilizado junto com um sistema de cache para não necessitar o processo de geração de código a toda requisição e diminuir o throughput.

### Pré-requisitos
* PHP 7.0
* Composer

### Instação

Use o comando de instalação do composer

`$ composer install`

### Como trabalhar com o htmlBuilder

Basta a chamado do autoload gerado pelo composer.

```php
<?php

include __DIR__ . '/vendor/autoload.php';

use HTML\Factory;

$tag = Factory::make('tag')->value('Valor')->attr('attr', ['value1', 'value2']);

echo $tag->show();

```
Resultado
```html
<tag attr="value1 value2">Valor</tag>
```
### Uso da classe Tag
A Classe Tag possui 4 métodos publicos:

1. Método construtor (`__construct($name, $value, $attr)`) recebe 3 parametros:
  1. Nome da tag do HTML.

        Exemplo:

                `new Tag('div')`
                `new Tag('p', 'Conteúdo do parágrafo.')`
                `new Tag('span', 'Conteúdo do span.', ['atributo'=>'atributo-do-span'])`

  2. Conteúdo da tag. Pode ser passado um objeto tipo InterfaceTags, strings ou um array com objetos ou strings.

        Exemplo:

                `new Tag('div','Uma string simples')`
                `new Tag('div', ['Uma string', 'Outra string'])`
                `new Tag('div', [new Tag('p'), 'Uma string'])`
                `new Tag('div', [new Tag('div', [new Tag('p', 'Texto simples', ['attr'=>['value1', 'value2']])])])`

  3. Atributos da tag. Recebe os artributos do elemento HTML em forma de um array, onde a chave é o nome do atributo e o valor é outro array com os valores possiveis do atributo.

        Exemplo:

                `new Tag('p', 'Meu paragrafo', ['class'=>['text-justify', 'text-muted']])`
                `new Tag('div', null, ['id'=>['main'], 'class'=>['align-top', 'cleaner']])`

2. Método para atribuir um conteúdo a tag (`value($value)`):
  * O valor pode ser uma string, um objeto do tipo InterfaceTags ou um array contendo objetos ou strings.
        ```php
        $p = new Tag('p');
        $p->value('Texto do meu parágrafo!');
        echo $p->build();

        ```

        Resultado:
        ```html
        <p>Texto do meu parágrafo!</p>
        ```
3. Método para atribuição de atributos (`attr($attr)`) a tag:
  * O parametro recebido por esse método deve ser um array como no item 1.3.
        ```php
        $div = new Tag('span', 'Conteúdo do span!');
        $div->attr(['class'=>['text-bold', 'clear']]);
        echo $div->build();

        ```

        Resultado:
        ```html
        <span class="text-bold clear">Conteúdo do span</span>
        ```

  * Outra forma de setar os atributos é passando dois parametros no método `attr($attr, $valor)`.
        ```php
        $div = new Tag('span', 'Conteúdo do span!');
        $div->attr('class', ['text-bold', 'clear']);
        echo $div->build();
        ```

        Resultado:
        ```html
        <span class="text-bold clear">Conteúdo do span</span>
        ```

4. Método que retorna a tag html (`build()`)
  * O método build não imprime na tela do browser, apenas retorna o códgo HTML gerado.

        ```php
        <?php

        use HTML\Tag;

        $div = new Tag('div');
        $div->value('Texto que está dentro da minha div.');
        $div->attr(['id'=>['main'], 'class'=>['content']]);

        echo $div->build();

        ```

        Resultado:
        ```html
        <div id="main" class="content">Texto que está dentro da minha div.</div>
        ```
### Exemplos

Veja abaixo alguns fragmentos de código possiveis de ser usados. Nos exemplos também será usado a classe `HTML` que foi criado com auxílio da classe `Tag`.

Estrutura simples de um parágrafo
```php
<?php

use HTML\Tag;

$p = new Tag('p');

$p->value('Texto que estará dentro do meu paragrafo.');

$attr = ['class'=>['text-justify', 'text-muted']];

$p->attr($attr);

echo $p->build();
```

Resultado:
```html
<p class="text-justify text-muted">Texto que estará dentro do meu paragrafo.</p>
```
Parágrafo com elementos filhos
```php
<?php

use HTML\Tag;

$strong = new Tag('strong');

$br = new Tag('br');

$p = new Tag('p');

$contentP[] = $strong->value('Nome: ');
$contentP[] = 'Fulano de Tals';
$contentP[] = $br;
$contentP[] = $strong->value('E-mail: ');
$contentP[] = 'fulano@de.tals';

echo $p->value($contentP)->attr(['class'=>['text-center']])->build();
```

Resultado:
```html
<p class="text-center">
    <strong>Nome: </strong>Fulano de Tals<br>
    <strong>E-mail: </strong>fulano@de.tals
</p>
```

Lista simples
```php
<?php

use HTML\Tag;

$contentUl = [];

for ($i = 0; $i < 5; $i++) {
    $contentUl[] = new Tag('li', 'Item ' . $i + 1);
}

$ul = new Tag('ul', $contentUl);

echo $ul->build();
```

Resultado
```html
<ul>
    <li>Item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
    <li>Item 4</li>
    <li>Item 5</li>
</ul>
```

### Usando a classe Factory

A classe Factory fabrica objetos do tipo Tag.

```php
<?php

use HTML\Factory;

$html = Factory::make('html')->attr('lang', ['pt-br']);
$title = Factory::make('title')->value('Titulo da Minha Página');
$h1 = Factory('h1')->value('Minha Página')->attr('class',['teste'])->attr('id', ['my-title']);
$p = Factory('p')->value('Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.');

$head = Factory::make('head');
$head->value($title);

$body = Factory::make('body');
$body->value($h1)->value($p);

$html->value($head)->value($body);
echo $html->build();
```

Resultado
```html
<html lang="pt-br">
    <head>
        <title>Titulo da Minha Página</title>
    </head>
    <body>
        <h1 class="teste" id="my-title">Minha Página</h1>
        <p>Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.</p>
    </body>
</html>
```

### Classe Page
A classe page abstrai a criação de alguns elementos básicos de uma página HTML

#### Métodos da classe
1. make:
        * Recebe um parametro que é o titulo da página
        `Factory::make('Titulo')`

Exemplo:

        ```php
        echo Factory::make('input')->attr(['type'=>['text'], 'name'=>['my_input'], 'value'=>['texto']])->build();
        ```

Resultado

        ```html
        <input type="text" name="my_input" value="texto">
        ```

### Licença

MIT © 2016 Alan Freire