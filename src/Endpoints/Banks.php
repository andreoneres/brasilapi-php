<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/BANKS
 */
class Banks extends Endpoint
{
    /**
     * Find all banks from BrasilApi.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function getList(): array
    {
        return $this->client->request("/banks/v1");
    }
    
    /**
     * Find a specific bank by code.
     *
     * @param int $bankCode Code of the bank
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(int $bankCode): array
    {
        return $this->client->request("/banks/v1/{$bankCode}");
    }
}