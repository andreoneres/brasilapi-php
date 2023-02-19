<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "brandsByTypeVehicle" => new MockHandler([
            new Response(200, [], $this->jsonMock("FIPEBrandsByTypeVehicle")),
        ]),
        "price" => new MockHandler([
            new Response(200, [], $this->jsonMock("FIPEPrice")),
        ]),
        "referenceTables" => new MockHandler([
            new Response(200, [], $this->jsonMock("FIPEReferenceTables")),
        ]),
    ];
});

test("should search all vehicle brands for a vehicle type", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["brandsByTypeVehicle"]);
    
    $type = "carros";
    $brands = $brasilApi->fipe()->brandsByTypeVehicle($type);
    
    expect($brands)
        ->toEqual($this->arrayMock("FIPEBrandsByTypeVehicle"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/fipe/marcas/v1/{$type}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should searches for the price of a specific vehicle", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["price"]);
    
    $code = "001004-9";
    $price = $brasilApi->fipe()->price($code);
    
    expect($price)
        ->toEqual($this->arrayMock("FIPEPrice"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/fipe/preco/v1/{$code}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search existing reference tables", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["referenceTables"]);
    
    $tables = $brasilApi->fipe()->referenceTables();
    
    expect($tables)
        ->toEqual($this->arrayMock("FIPEReferenceTables"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/fipe/tabelas/v1");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});