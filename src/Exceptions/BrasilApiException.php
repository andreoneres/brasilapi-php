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
    
    public function __construct(string $message = "", int $code = 0, array $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message, $code);
    }
    
    /**
     * Returns the array of errors returned by BrasilApi
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}