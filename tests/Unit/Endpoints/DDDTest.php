<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "DDD" => new MockHandler([
            new Response(200, [], $this->jsonMock("DDD")),
        ])
    ];
});

test("should search for the state and cities that have a certain area code", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["DDD"]);
    
    $ddd = 21;
    $address = $brasilApi->ddd()->get($ddd);
    
    expect($address)
        ->toEqual($this->arrayMock("DDD"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ddd/v1/{$ddd}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});