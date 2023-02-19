<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "domain" => new MockHandler([
            new Response(200, [], $this->jsonMock("RegisterBRDomain")),
        ]),
    ];
});

test("should search for domain information", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["domain"]);
    
    $domain = "brasilapi.com.br";
    $infos = $brasilApi->registerBr()->domain($domain);
    
    expect($infos)
        ->toEqual($this->arrayMock("RegisterBRDomain"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/registrobr/v1/{$domain}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});