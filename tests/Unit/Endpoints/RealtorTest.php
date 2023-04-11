<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "realtor" => new MockHandler([
            new Response(200, [], $this->jsonMock("Realtor")),
        ]),
        "realtors" => new MockHandler([
            new Response(200, [], $this->jsonMock("Realtors")),
        ]),
    ];
});

test("should search for a realtor by CNPJ", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["realtor"]);
    
    $cnpj = "76621457000185";
    $realtor = $brasilApi->realtors()->get($cnpj);
    
    expect($realtor)
        ->toEqual($this->arrayMock("Realtor"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cvm/corretoras/v1/{$cnpj}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("search for all the realtors listed", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["realtors"]);
    
    $realtors = $brasilApi->realtors()->getList();
    
    expect($realtors)
        ->toBe($this->arrayMock("Realtors"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cvm/corretoras/v1");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});