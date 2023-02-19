<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "CNPJ" => new MockHandler([
            new Response(200, [], $this->jsonMock("CNPJ")),
        ])
    ];
});

test("should search for company information by CNPJ", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["CNPJ"]);
    
    $cnpj = "00000000000191";
    $infos = $brasilApi->cnpj()->get($cnpj);
    
    expect($infos)
        ->toEqual($this->arrayMock("CNPJ"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cnpj/v1/{$cnpj}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});