<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/DDD
 */
class DDD extends Endpoint
{
    /**
     * Find state by DDD.
     *
     * @param string $ddd DDD
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(string $ddd): array
    {
        return $this->client->request("/ddd/v1/{$ddd}");
    }
}