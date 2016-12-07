# htmlBuilder


#### Pequeno e simples sistema de criação de tags HTML

Sistema simples que traz uma interface para criação de tags `HTML`, feito em `PHP` para sistema que necessitem de criação de forma dinâmica do código `HTML`.

O sistema funciona de forma simples e rápido, podendo ser utilizado também com um sistema de cache para não necessitar o processo de geração de código toda requisição e diminuir o throughput.

### Pré-requisitos
* PHP 7
* Composer

### Instação

Use o comando simple de instalação do composer

`$ composer install`

### Como trabalhar com o htmlBuilder

Basta a chamado do autoload gerado pelo composer.

```php
<?php

include __DIR__ . '/vendor/autoload.php';

$tag = \HTML\Tag('name_tag', $value, array('attribute'=>array('value1', 'value2')));

echo $tag->build();

```

Os parametros recebido pela instaciação da classe Tag são:

1. Nome da tag do HTML.

        Exemplo:
        
                * `new Tag('div')`
                * `new Tag('p', array(new Tag('strong', 'Nome: '), 'Fulano de tal'))`

2. O que será colocado dentro da tag. Pode ser passado um objeto tipo InterfaceTags, strings ou um array com objetos ou strings.

        Exemplo:
        
                1. `'Uma string simples'`
                2. `array('Uma string', 'Outra string')`
                3. `array(new Tag('name'), 'Uma string')`
                4. `array(new Tag('name', array(new Tag('name', 'Texto simples', array('attr'=>array('value1', 'value2')))))`

3. Recebe os artributos do elemento HTML em forma de um array, onde a chave é o nome do atributo e o valor é outro array com os valores possiveis do atributo

        Exemplo:
        
                * `new Tag('p', 'Meu paragrafo', array('class'=>array('text-justify', 'text-muted')))`
                * `new Tag('div', null, array('id'=>array('main'), 'class'=>array('align-top', 'cleaner')`

E para exibir o código gerado basta chamar o método build.
O método build não imprime na tela do browser, apenas retorna o códgo HTML gerado.

```php
<?php

use HTML\Tag;

$div = new Tag('div', 'Texto que está dentro da minha div.');

echo $div->build();

```

Resultado:
```html
<div>Texto que está dentro da minha div.</div>
```
### Exemplos

Veja abaixo alguns fragmentos de código possiveis de ser usados. Nos exemplos também será usado a classe `HTML` que foi criado com auxílio da classe `Tag`.

Estrutura simples de um parágrafo
```php
<?php

use HTML\Tag;

$p = new Tag('p');

$p->setValue('Texto que estará dentro do meu paragrafo.');

$attr = array('class'=>array('text-justify', 'text-muted'));

$p->setAttr($attr);

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

$contentP[] = $strong->setValue('Nome: ');
$contentP[] = 'Fulano de Tals';
$contentP[] = $br;
$contentP[] = $strong->setValue('E-mail: ');
$contentP[] = 'fulano@de.tals';

echo $p->setValue($contentP)->setAttr(['class'=>['text-center']])->build();
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

Usando a classe HTML

```php
<?php

use HTML\Tag;
use HTML\HTML;

$html = new HTML();
$title = new Tag('title', 'Titulo da Minha Página');
$h1 = new Tag('h1', 'Minha Página');
$p = new Tag('p', 'Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.');

$html->addInHead($title);
$html->addInBody($h1)->addInBody($p);

echo $html->build();
```

Resultado
```html
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Titulo da Minha Página</title>
    </head>
    <body>
        <h1 class="teste" id="my-title">Minha Página</h1>
        <p>Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.</p>
    </body>
</html>
```
