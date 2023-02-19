<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "ncm" => new MockHandler([
            new Response(200, [], $this->jsonMock("NCM")),
        ]),
        "list" => new MockHandler([
            new Response(200, [], $this->jsonMock("NCMList")),
        ]),
        "ncmSearch" => new MockHandler([
            new Response(200, [], $this->jsonMock("NCMSearch")),
        ]),
    ];
});

test("should search information about all NCMs", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["list"]);

    $infos = $brasilApi->ncm()->getList();
    
    expect($infos)
        ->toEqual($this->arrayMock("NCMList"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ncm/v1");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search for information about a specific NCM", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["ncm"]);
    
    $code = "01012100";
    $infos = $brasilApi->ncm()->get($code);
    
    expect($infos)
        ->toEqual($this->arrayMock("NCM"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ncm/v1/{$code}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search for information about a specific NCM by code or description", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["ncmSearch"]);
    
    $code = "01012100";
    $infos = $brasilApi->ncm()->search($code);
    
    expect($infos)
        ->toEqual($this->arrayMock("NCMSearch"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/ncm/v1");
    
    expect($this->getQueryString($container[0]))
        ->toBe("search={$code}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});