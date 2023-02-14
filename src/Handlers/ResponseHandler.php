<?php

declare(strict_types=1);

namespace BrasilApi\Handlers;

use BrasilApi\Exceptions\BrasilApiException;
use BrasilApi\Exceptions\InvalidJsonException;
use GuzzleHttp\Exception\RequestException;

class ResponseHandler
{
    /**
     * Decode a json string into an array and return it.
     *
     * @param string $body The response body
     *
     * @return array
     */
    public static function success(string $body): array
    {
        try {
            return self::toArray($body);
        } catch (InvalidJsonException) {
            return [];
        }
    }
    
    /**
     * Try to parse a GuzzleHttp\Exception\RequestException into a BrasilApiException
     * and throw it, otherwise throw the original exception.
     *
     * @param RequestException $exception The exception to be parsed
     *
     * @throws BrasilApiException|RequestException
     */
    public static function failure(RequestException $exception): void
    {
        throw self::parseException($exception);
    }
    
    /**
     * Parse a GuzzleHttp\Exception\RequestException into a BrasilApiException,
     * if possible depending on the response body.
     *
     * @param RequestException $exception The exception to be parsed
     *
     * @return BrasilApiException|RequestException
     */
    private static function parseException(RequestException $exception): BrasilApiException|RequestException
    {
        $response = $exception->getResponse();
        
        $body = $response->getBody()->getContents();
        
        try {
            $error = self::toArray($body);
        } catch (InvalidJsonException) {
            return $exception;
        }
        
        return new BrasilApiException(
            $error["message"] ?? "An error occurred",
            $response->getStatusCode(),
            $error["errors"] ?? []
        );
    }
    
    /**
     * Transform a json string into an array.
     *
     * @param string $json The json string to be transformed
     *
     * @return array
     * @throws InvalidJsonException
     */
    private static function toArray(string $json): array
    {
        $array = json_decode($json, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg());
        }
        
        return $array;
    }
}