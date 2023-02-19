<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "book" => new MockHandler([
            new Response(200, [], $this->jsonMock("ISBNBook")),
        ])
    ];
});

test("should search for information about a specific book", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["book"]);
    
    $code = "9788545702870";
    $providers = "open-library";
    $book = $brasilApi->isbn()->book($code, $providers);
    
    expect($book)
        ->toEqual($this->arrayMock("ISBNBook"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/isbn/v1/{$code}");
    
    expect($this->getQueryString($container[0]))
        ->toBe("providers={$providers}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});