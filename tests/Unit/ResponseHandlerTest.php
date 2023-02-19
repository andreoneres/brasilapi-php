<?php

declare(strict_types=1);

use BrasilApi\Handlers\ResponseHandler;

test("should successfully return the response as array", function () {
    $response = "{\"nome\":\"Selic\",\"valor\":13.75}";
    
    $responseFormatted = ResponseHandler::success($response);

    expect($responseFormatted)
        ->toEqual([
            "nome" => "Selic",
            "valor" => 13.75,
        ]);
});