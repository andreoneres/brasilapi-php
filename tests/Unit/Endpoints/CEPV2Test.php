<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "CEPV2" => new MockHandler([
            new Response(200, [], $this->jsonMock("CEPV2")),
        ])
    ];
});

test("should search for a address by zip code", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["CEPV2"]);
    
    $zipCode = "01001000";
    $address = $brasilApi->cepV2()->get($zipCode);
    
    expect($address)
        ->toEqual($this->arrayMock("CEPV2"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cep/v2/{$zipCode}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});