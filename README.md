<h1 align="center"><img src="https://raw.githubusercontent.com/BrasilAPI/BrasilAPI/master/public/brasilapi-logo-small.png" alt="Logo da BrasilAPI"></h1>

<div align="center">
  <p>
    <strong>Vamos transformar o Brasil em uma API?</strong>
  </p>
</div>

# Introdução

Esse SDK foi construído com o intuito de ser flexível, de forma que todos possam utilizar todas as features 
e versões da BrasilAPI.

Você pode acessar a documentação oficial da BrasilAPI acessando esse [link](https://brasilapi.com.br/docs).

## Índice

- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Utilização](#utilização)
- [Endpoints](#endpoints)
- [Criando endpoints](#criando-endpoints)
- [Licença](#licença)

## Requisitos

* PHP versão 8.1 ou maior;
* Guzzle Http versão 7.4 ou maior.

## Instalação

Para instalar o SDK, você deve utilizar o [Composer](https://getcomposer.org/) com o
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

## Endpoints

Abaixo você pode ver todos os endpoints disponíveis, por padrão, na biblioteca:

* BANKS
* CEP
* CEP V2
* CNPJ
* CPTEC
* DDD
* Feriados Nacionais
* FIPE
* IBGE
* ISBN
* NCM
* Registro BR
* Taxas

## Criando endpoints

Para adicionar novos ou sobreescrever os já existentes endpoints, você deve seguir os seguintes passos:

1. Crie uma classe que extenda a classe `BrasilApi\Endpoints\Abstracts\Endpoint`;


2. Nesta classe, você pode implementar todos os métodos que desejar e utilizar o método `$this->client->request()` 
para enviar as requisições para a API. Lembre-se que a base URL da API já está embutido no 'Client', portanto na uri 
do método você precisa adicionar apenas o complemento da rota. 
**Exemplo:** 

URL: `https://brasilapi.com.br/api/cep/v2/01001000`
BASE_URI: `https://brasilapi.com.br/api/`
URI: `/cep/v2/01001000`;

3. Para incorporá-lo ao SDK, você deve possuir uma instância de `BrasilApi\Client` e utilizar o método
`addEndpoint`, passando como parâmetro o nome do endpoint e a classe criada no passo 1.

Exemplo:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BrasilApi\Client;

$client = new Client();

$client->addEndpoint("hope", App\Endpoints\Hope::class);
```

**Obs.:** O nome do endpoint deve ser o mesmo que você passou no método `addEndpoint` pois ele será utilizado
no método mágico __call ao ser chamado.

4. Para utilizar este novo endpoint, você deve chamá-lo da seguinte forma:

```php
$address = $client->hope();
```

**Obs.2:** Além de criar, você pode sobrescrever endpoints existentes e atualizar os seus métodos.
Isso pode ser útil caso seja lançada uma nova versão de algum endpoint e você queira utilizá-lo
imediatamente. Dessa forma, você pode sobrescrever o endpoint existente e alterar a sua URI.

## Licença

Veja em [LICENSE.md](./LICENSE.md).
