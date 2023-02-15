<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/ISBN
 */
class ISBN extends Endpoint
{
    /**
     * Find informations about a specific book.
     *
     * @param string $bookCode Code of book
     *
     * @return array
     * @throws BrasilApiException
     */
    public function book(string $bookCode): array
    {
        return $this->client->request("/isbn/v1/{$bookCode}");
    }
}