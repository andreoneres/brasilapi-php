<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "stateCities" => new MockHandler([
            new Response(200, [], $this->jsonMock("IBGEStateCities")),
        ]),
        "states" => new MockHandler([
            new Response(200, [], $this->jsonMock("IBGEStates")),
        ]),
        "state" => new MockHandler([
            new Response(200, [], $this->jsonMock("IBGEState")),
        ]),
    ];
});

test("should search all cities of a specific state", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["stateCities"]);
    
    $uf = "AL";
    $providers = "gov";
    $address = $brasilApi->ibge()->stateCities($uf, $providers);
    
    expect($address)
        ->toEqual($this->arrayMock("IBGEStateCities"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ibge/municipios/v1/{$uf}");
    
    expect($this->getQueryString($container[0]))
        ->toBe("providers={$providers}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search for information from all Brazilian states", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["states"]);
    
    $address = $brasilApi->ibge()->states();
    
    expect($address)
        ->toEqual($this->arrayMock("IBGEStates"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ibge/uf/v1");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should information from a specific state", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["state"]);
    
    $uf = "AL";
    $address = $brasilApi->ibge()->state($uf);
    
    expect($address)
        ->toEqual($this->arrayMock("IBGEState"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ibge/uf/v1/{$uf}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});