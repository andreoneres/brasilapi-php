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
     * @param int $ddd DDD
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(int $ddd): array
    {
        return $this->client->request("/ddd/v1/{$ddd}");
    }
}