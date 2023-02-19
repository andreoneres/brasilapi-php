<?php

declare(strict_types=1);

use BrasilApi\Client;
use BrasilApi\Endpoints\CEP;
use BrasilApi\Exceptions\BrasilApiException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

test("should successfully overwrite an endpoint", function () {
    $container = [];
    $history = Middleware::history($container);
    
    $response = '{"cep":"01001000","state":"SP","city":"São Paulo","neighborhood":"Sé","street":"Praça da Sé","service":"correios"}';
    $handler = HandlerStack::create(new MockHandler([
        new Response(200, [], $response),
    ]));
    $handler->push($history);
    
    $brasilApi = new Client(["handler" => $handler]);
    
    $brasilApi->addEndpoint("zipCode", CEP::class);
    
    $address = $brasilApi->zipCode()->get("01001000");
    
    expect($address)
        ->toBe(json_decode($response, true));
});

test("must successfully throw request exception", function () {
    $container = [];
    $history = Middleware::history($container);
    
    $response = '{"message": "CEP not found"}';
    $handler = HandlerStack::create(new MockHandler([
        new Response(404, [], $response),
    ]));
    $handler->push($history);
    
    $brasilApi = new Client(["handler" => $handler]);
    
    $address = $brasilApi->cep()->get("01001000");
})->throws(BrasilApiException::class, "CEP not found");