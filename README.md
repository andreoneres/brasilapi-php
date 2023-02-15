<h1 align="center"><img src="https://raw.githubusercontent.com/BrasilAPI/BrasilAPI/master/public/brasilapi-logo-small.png"></h1>

<div align="center">
  <p>
    <strong>Vamos transformar o Brasil em uma API?</strong>
  </p>
</div>

# Introdução

Essa SDK foi construída com o intuito de torná-la flexível, de forma que todos possam utilizar todas as features, de
todas as versões da BrasilAPI.

Você pode acessar a documentação oficial da BrasilAPI acessando esse [link](https://brasilapi.com.br/docs).

## Índice

- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Utilização](#utilização)

## Requisitos

* PHP versão 8.1 ou maior;
* Guzzle Http versão 7.4 ou maior.

## Instalação

Para instalar o SDK, você pode utilizar o [Composer](https://getcomposer.org/) com o
seguinte comando:

```bash
composer require andreoneres/brasilapi-php
```

## Utilização

O uso mais simples da biblioteca seria o seguinte:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BrasilApi\Client;

$client = new Client();

$address = $client->cnpj()->get('00000000000191');
```
