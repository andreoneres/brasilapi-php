<?php

declare(strict_types=1);

namespace Unit;

use BrasilApi\Exceptions\BrasilApiException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

test("should build exception when return error with invalid json", function () {
    $mock = new MockHandler([
        new Response(400, [], "invalid json"),
    ]);
    
    $container = [];
    $brasilApi = $this->buildClient($container, $mock);
    
    try {
        $brasilApi->cep()->get('01001000');
    } catch (BrasilApiException $e) {
        expect($e->getMessage())
            ->toBe("An error occurred");
        
        expect($e->getCode())
            ->toBe(400);
        
        expect($e->getRawResponse())
            ->toBe("invalid json");
        
        expect($e->getErrors())
            ->toEqual([]);
    }
});

test("should build exception when return error with valid json", function () {
    $mock = new MockHandler([
        new Response(404, [], '{"message":"Todos os serviços de CEP retornaram erro.","type":"service_error","name":"CepPromiseError","errors":[{"name":"ServiceError","message":"CEP INVÁLIDO","service":"correios"},{"name":"ServiceError","message":"CEP não encontrado na base do ViaCEP.","service":"viacep"}]}'),
    ]);
    
    $container = [];
    $brasilApi = $this->buildClient($container, $mock);
    
    try {
        $brasilApi->cep()->get('01001000');
    } catch (BrasilApiException $e) {
        expect($e->getMessage())
            ->toBe("Todos os serviços de CEP retornaram erro.");
        
        expect($e->getCode())
            ->toBe(404);
        
        expect($e->getRawResponse())
            ->toBe('{"message":"Todos os serviços de CEP retornaram erro.","type":"service_error","name":"CepPromiseError","errors":[{"name":"ServiceError","message":"CEP INVÁLIDO","service":"correios"},{"name":"ServiceError","message":"CEP não encontrado na base do ViaCEP.","service":"viacep"}]}');
        
        expect($e->getErrors())
            ->toEqual([
                [
                    "name" => "ServiceError",
                    "message" => "CEP INVÁLIDO",
                    "service" => "correios",
                ],
                [
                    "name" => "ServiceError",
                    "message" => "CEP não encontrado na base do ViaCEP.",
                    "service" => "viacep",
                ]
            ]);
    }
});