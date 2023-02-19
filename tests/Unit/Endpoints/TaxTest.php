<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "fee" => new MockHandler([
            new Response(200, [], $this->jsonMock("TaxFee")),
        ]),
        "fees" => new MockHandler([
            new Response(200, [], $this->jsonMock("TaxFees")),
        ]),
    ];
});

test("should search for interest rates and some official indices in Brazil", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["fees"]);
    
    $taxe = $brasilApi->taxes()->getList();
    
    expect($taxe)
        ->toEqual($this->arrayMock("TaxFees"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/taxas/v1");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search information of a tax by its name/acronym", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["fee"]);
    
    $acronym = "Selic";
    $taxes = $brasilApi->taxes()->get($acronym);
    
    expect($taxes)
        ->toEqual($this->arrayMock("TaxFee"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/taxas/v1/{$acronym}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});