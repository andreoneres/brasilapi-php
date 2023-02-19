<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "city" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECCity")),
        ]),
        "cities" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECCities")),
        ]),
        "weatherInCapitals" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECWeatherInCapitals")),
        ]),
        "weatherInAirport" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECWeatherInAirport")),
        ]),
        "weatherInCity" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECWeatherInCity")),
        ]),
        "weatherInCityInXDays" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECWeatherInCityInXDays")),
        ]),
        "oceanForecastInCity" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECOceanForecastInCity")),
        ]),
        "oceanForecastInCityInXDays" => new MockHandler([
            new Response(200, [], $this->jsonMock("CPTECOceanForecastInCityInXDays")),
        ]),
    ];
});

test("should search for a city by name", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["city"]);
    
    $cityName = "Salvador";
    $infos = $brasilApi->cptec()->cities($cityName);
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECCity"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/cidade/{$cityName}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search all available cities", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["cities"]);
    
    $infos = $brasilApi->cptec()->cities();
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECCities"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/cidade");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search all meteorological information in the capitals of the Brazilian states", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["weatherInCapitals"]);
    
    $infos = $brasilApi->cptec()->weatherInCapitals();
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECWeatherInCapitals"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/clima/capital");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search weather information on a specific airport.", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["weatherInAirport"]);
    
    $airportCode = "SBGR";
    $infos = $brasilApi->cptec()->weatherInAirport($airportCode);
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECWeatherInAirport"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/clima/aeroporto/{$airportCode}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should search weather information for a specific city", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["weatherInCity"]);
    
    $cityCode = 999;
    $infos = $brasilApi->cptec()->weatherInCity($cityCode);
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECWeatherInCity"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/clima/previsao/{$cityCode}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("should searches the weather information of a specific city in the period of X days", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["weatherInCityInXDays"]);
    
    $cityCode = 999;
    $quantityOfDays = 5;
    $infos = $brasilApi->cptec()->weatherInCityInXDays($cityCode, $quantityOfDays);
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECWeatherInCityInXDays"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/clima/previsao/{$cityCode}/{$quantityOfDays}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("searches the ocean forecast in a specific city", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["oceanForecastInCity"]);
    
    $cityCode = 241;
    $infos = $brasilApi->cptec()->oceanForecastInCity($cityCode);
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECOceanForecastInCity"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/ondas/{$cityCode}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});

test("searches the ocean forecast in a specific city in the period of X days", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["oceanForecastInCityInXDays"]);
    
    $cityCode = 241;
    $quantityOfDays = 5;
    $infos = $brasilApi->cptec()->oceanForecastInCityInXDays($cityCode, $quantityOfDays);
    
    expect($infos)
        ->toEqual($this->arrayMock("CPTECOceanForecastInCityInXDays"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/cptec/v1/ondas/{$cityCode}/{$quantityOfDays}");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});