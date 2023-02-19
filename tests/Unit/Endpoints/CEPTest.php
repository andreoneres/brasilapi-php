<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "CEP" => new MockHandler([
            new Response(200, [], $this->jsonMock("CEP")),
        ])
    ];
});

test("should search for a address by zip code", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["CEP"]);
    
    $zipCode = "01001000";
    $address = $brasilApi->cep()->get($zipCode);
    
    expect($address)
        ->toEqual($this->arrayMock("CEP"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cep/v1/{$zipCode}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});