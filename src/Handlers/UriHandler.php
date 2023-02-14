<?php

declare(strict_types=1);

namespace BrasilApi\Handlers;

class UriHandler
{
    /**
     * Format the URI to be used in the request.
     *
     * @param string $uri
     *
     * @return string
     */
    public static function format(string $uri): string
    {
        // Remove slashes from the beginning and end of the URI
        $uri = trim($uri, '/');
        
        // Remove double slashes
        return preg_replace('/\/\/+/', '/', $uri);
    }
}