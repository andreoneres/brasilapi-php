<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "bank" => new MockHandler([
            new Response(200, [], $this->jsonMock("Bank")),
        ]),
        "banks" => new MockHandler([
            new Response(200, [], $this->jsonMock("Banks")),
        ]),
    ];
});

test("should search for a bank by code", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["bank"]);
    
    $bankId = 1;
    $bank = $brasilApi->banks()->get($bankId);
    
    expect($bank)
        ->toEqual($this->arrayMock("Bank"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("banks/v1/{$bankId}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("search for all the banks", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["banks"]);
    
    $banks = $brasilApi->banks()->getList();
    
    expect($banks)
        ->toBe($this->arrayMock("Banks"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("banks/v1");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});