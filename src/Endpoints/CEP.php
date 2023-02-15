<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/CEP
 */
class CEP extends Endpoint
{
    /**
     * Find a CEP
     *
     * @param string $zipCode CEP
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(string $zipCode): array
    {
        return $this->client->request("/cep/v1/{$zipCode}");
    }
}