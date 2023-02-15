<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/TAXAS
 */
class Taxes extends Endpoint
{
    /**
     * Find information about some taxes from country.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function getList(): array
    {
        return $this->client->request("/taxas/v1");
    }
    
    /**
     * Find information about a specific tax from country.
     *
     * @param string $taxCode Code of tax
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(string $taxCode): array
    {
        return $this->client->request("/taxas/v1/{$taxCode}");
    }
}