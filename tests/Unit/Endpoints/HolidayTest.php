<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "holiday" => new MockHandler([
            new Response(200, [], $this->jsonMock("Holidays")),
        ])
    ];
});

test("should search all national holidays", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["holiday"]);
    
    $year = 2023;
    $holidays = $brasilApi->holidays()->fromYear($year);
    
    expect($holidays)
        ->toEqual($this->arrayMock("Holidays"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/feriados/v1/{$year}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});