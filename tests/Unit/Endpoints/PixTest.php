<?php

declare(strict_types=1);

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

beforeEach(function () {
    $this->mocks = [
        "participants" => new MockHandler([
            new Response(200, [], $this->jsonMock("PixParticipants")),
        ])
    ];
});

test("should search for all PIX participants on the current or previous day", function () {
    $container = [];
    $brasilApi = $this->buildClient($container, $this->mocks["participants"]);
    
    $participants = $brasilApi->pix()->participants();
    
    expect($participants)
        ->toEqual($this->arrayMock("PixParticipants"));
    
    expect($this->getRequestUri($container[0]))
        ->toBe("/api/pix/v1/participants");
    
    expect($this->getRequestMethod($container[0]))
        ->toBe("GET");
});