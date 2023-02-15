<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/REGISTRO-BR
 */
class RegisterBR extends Endpoint
{
    /**
     * Find informations about a specific domain.
     *
     * @param string $domain Domain
     *
     * @return array
     * @throws BrasilApiException
     */
    public function domain(string $domain): array
    {
        return $this->client->request("/registrobr/v1/{$domain}");
    }
}