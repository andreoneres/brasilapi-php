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

- [Introdução](#introdução)
  - [Índice](#índice)
  - [Requisitos](#requisitos)
  - [Instalação](#instalação)
  - [Utilização](#utilização)
  - [Endpoints](#endpoints)
    - [Bancos](#bancos)
    - [CEP](#cep)
    - [CEP V2](#cep-v2)
    - [CNPJ](#cnpj)
    - [CPTEC](#cptec)
    - [DDD](#ddd)
    - [Feriados](#feriados)
    - [FIPE](#fipe)
    - [IBGE](#ibge)
    - [ISBN](#isbn)
    - [NCM](#ncm)
    - [Registro BR](#registro-br)
    - [Taxas](#taxas)
  - [Tratando exceções](#tratando-exceções)
  - [Criando endpoints](#criando-endpoints)
  - [Testes](#testes)
  - [Contribuindo](#contribuindo)
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

$brasilApi = new Client();

$address = $brasilApi->cep()->get('01001000');
```

## Endpoints

Abaixo você pode ver todos os endpoints disponíveis, por padrão, na biblioteca:

### Bancos

Buscando todos os bancos disponíveis na API.
```php
$brasilApi->banks()->getList();
```

Buscando um banco específico pelo seu código.
```php
$brasilApi->banks()->get(1);
```

### CEP

Buscando um CEP específico.

```php
$brasilApi->cep()->get('01001000');
```

### CEP V2

Buscando um CEP específico.

```php
$brasilApi->cepV2()->get('01001000');
```

### CNPJ

Buscando um CNPJ específico.

```php
$brasilApi->cnpj()->get('00000000000191');
```

### CPTEC

Buscando uma cidade pelo nome.

```php
$brasilApi->cptec()->cities('São Paulo');
```

Buscando todas as cidades disponíveis.

```php
$brasilApi->cptec()->cities();
```

Buscando as informações meteorológicas em todas as capitais dos estados brasileiros.

```php
$brasilApi->cptec()->weatherInCapitals();
```

Buscando as informações meteorológicas em um aeroporto específico através do seu código ICAO.

```php
$brasilApi->cptec()->weatherInAirport('SBGR');
```

Buscando as informações meteorológicas de uma cidade específica pelo seu código.

```php
$brasilApi->cptec()->weatherInCity(999);
```

Buscando as informações meteorológicas de uma cidade específica no período de X dias.

**Obs.:** O primeiro parâmetro se refere ao código da cidade e o segundo parâmetro refere-se a quantidade de dias.
Lembrando que só é possível buscar informações entre 1 a 6 dias.

```php
$brasilApi->cptec()->weatherInCityInXDays(999, 6);
```

Buscando a previsão oceânica em uma cidade específica.

```php
$brasilApi->cptec()->oceanForecastInCity(999);
```

Buscando a previsão oceânica em uma cidade específica no período de X dias.

**Obs.:** O primeiro parâmetro se refere ao código da cidade e o segundo parâmetro refere-se a quantidade de dias.
Lembrando que só é possível buscar informações entre 1 a 6 dias.

```php
$brasilApi->cptec()->oceanForecastInCityInXDays(999, 6);
```

### DDD

Buscando o estado e cidades que possuem determinado DDD.

```php
$brasilApi->ddd()->get(77);
```

### Feriados

Buscando todos os feriados nacionais em determinado ano.

```php
$brasilApi->holidays()->fromYear(2022);
```

### FIPE

Buscando todas as marcas de veículos referente a um tipo de veículo.

```php
$brasilApi->fipe()->brandsByTypeVehicle('caminhoes');
```

Buscando o preço de um veículo específico pelo seu código FIPE.

```php
$brasilApi->fipe()->price('001004-9');
```

Buscando as tabelas de referência existentes.

```php
$brasilApi->fipe()->referenceTables();
```

### IBGE

Buscando todos os municípios de um estado específico pela sua sigla.

```php
$brasilApi->ibge()->stateCities('BA');
```

Buscando informações de todos os estados brasileiros.

```php
$brasilApi->ibge()->states();
```

Buscando informações de um estado específico pela sua sigla.

```php
$brasilApi->ibge()->state('BA');
```

### ISBN

Buscando informações sobre um livro específico pelo seu código ISBN.

```php
$brasilApi->isbn()->book('9788545702870');
```

### NCM

Buscando informações sobre todos os NCMs.

```php
$brasilApi->ncm()->getList();
```

Buscando informações sobre um NCM específico.

```php
$brasilApi->ncm()->get('01012100');
```

Buscando informações de um NCM a partir de um código ou descrição.

```php
$brasilApi->ncm()->search('01012100');
```

### Pix

Buscando informações de todos os participantes do PIX no dia atual ou anterior.

```php
$brasilApi->pix()->participants();
```

### Registro BR

Buscando informações de um domínio específico.

```php
$brasilApi->registerBr()->domain('google.com');
```

### Taxas

Buscando as taxas de juros e alguns índices oficiais do Brasil.

```php
$brasilApi->taxes()->getList();
```

Buscando informações de uma taxa a partir do seu nome/sigla.

```php
$brasilApi->taxes()->get('Selic');
```

## Criando endpoints

Para adicionar novos ou sobreescrever os já existentes endpoints, você deve seguir os seguintes passos:

1. Crie uma classe que extenda a classe `BrasilApi\Endpoints\Abstracts\Endpoint`;

2. Nesta classe, você pode implementar todos os métodos que desejar e utilizar o método `$this->client->request()` 
para enviar as requisições para a API. Lembre-se que a base URL da API já está embutido no 'Client', portanto na uri 
do método você precisa adicionar apenas o complemento da rota. 

**Exemplo:** 

URL:      `https://brasilapi.com.br/api/cep/v2/01001000` <br />
BASE_URI: `https://brasilapi.com.br/api` <br />
URI:      `/cep/v2/01001000` <br />

3. Para incorporá-lo ao SDK, você deve possuir uma instância de `BrasilApi\Client` e utilizar o método
`addEndpoint`, passando como parâmetro o nome do endpoint e a classe criada no passo 1.

Exemplo:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BrasilApi\Client;
use BrasilApi\Endpoints\Abstracts\Endpoint;

class Hope extends Endpoint
{
    public function getList(): array
    {
        return $this->client->request("/hopes/list");
    }
}

$brasilApi = new Client();

$brasilApi->addEndpoint("hope", Hope::class);
```

4. Para utilizar este novo endpoint, você deve chamá-lo da seguinte forma:

```php
$address = $brasilApi->hope()->getList();
```

**Obs.:** A chamada do método do endpoint deve ser feito com o mesmo nome que foi definido no método `addEndpoint`, pois 
ele será utilizado na busca dinâmica do endpoint através do método mágico `__call`.

**Obs.2:** Além de criar, você pode sobrescrever endpoints existentes e atualizar os seus métodos.
Isso pode ser útil caso seja lançada uma nova versão de algum endpoint e você queira utilizá-lo
imediatamente. Dessa forma, você pode sobrescrever o endpoint existente e alterar a sua URI.

## Tratando exceções

Caso a API retorne um erro, a biblioteca irá lançar uma exceção do tipo `BrasilApi\Exceptions\BrasilApiException`.
Para capturar esta exceção, você deve utilizar o bloco `try/catch` e tratar o erro da forma que desejar.

Exemplo:

```php
try {
    $address = $brasilApi->cep()->get('01001000');
} catch (BrasilApiException $e) {
    echo $e->getMessage(); // Retorna a mensagem de erro da API
    echo $e->getCode(); // Retorna o código HTTP da API
    echo $e->getErrors(); // Retorna os erros retornados pela API
    echo $e->getRawResponse(); // Retorna a resposta bruta da API
}
```

## Testes

Neste projeto é utilizado o [Pest](https://pestphp.com/docs) para a implementação de testes automatizados.
Para executá-los, instale as dependências de desenvolvimento, caso não tenha instalado, e execute o seguinte comando:

```bash
composer test
```

## Contribuindo

Para contribuir com o projeto, você deve seguir os seguintes passos:

1. Faça um fork do projeto;
2. Crie uma branch para sua alteração: `git checkout -b feat-fix-refactor/my-changes`;
3. Faça commit das suas alterações: `git commit -m 'feat-fix-refactor: My changes'`;
4. Faça push para a sua branch: `git push origin feat-fix-refactor/my-changes`;
5. Abra um pull request.
6. Aguarde a análise do seu pull request.
7. Se seu pull request for aceito, ele será mesclado com a branch `main`.

**Obs.:** Não se esqueça de criar testes para o seu código.

## Licença

Veja em [LICENSE.md](./LICENSE.md).
