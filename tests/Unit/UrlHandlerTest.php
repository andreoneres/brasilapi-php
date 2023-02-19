<?php

declare(strict_types=1);

use BrasilApi\Handlers\UriHandler;

test("should format the URI correctly for the Guzzle request", function () {
    $uri = "/cep/v1//01001000/";
    
    $uriFormatted = UriHandler::format($uri);
    
    expect($uriFormatted)
        ->toBe("cep/v1/01001000");
});