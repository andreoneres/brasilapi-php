<?php

declare(strict_types=1);

namespace BrasilApi\Exceptions;

use Exception;

class BrasilApiException extends Exception
{
    /**
     * Array of errors returned by BrasilApi
     */
    private array $errors;
    
    /**
     * The raw response returned by BrasilApi
     */
    private string $rawResponse;
    
    public function __construct(
        string $message = "",
        int $code = 0,
        array $errors = [],
        string $rawResponse = ""
    )
    {
        $this->errors = $errors;
        $this->rawResponse = $rawResponse;
        parent::__construct($message, $code);
    }
    
    /**
     * Returns the array of errors returned by BrasilApi
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    
    /**
     * Returns the raw response returned by BrasilApi
     */
    public function getRawResponse(): string
    {
        return $this->rawResponse;
    }
}