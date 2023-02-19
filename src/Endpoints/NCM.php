<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/NCM
 */
class NCM extends Endpoint
{
    /**
     * Find informations about all NCMs.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function getList(): array
    {
        return $this->client->request("/ncm/v1");
    }
    
    /**
     * Find informations about a specific NCM.
     *
     * @param string $ncmCode
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(string $ncmCode): array
    {
        return $this->client->request("/ncm/v1/{$ncmCode}");
    }
    
    /**
     * Find informations about specifics NCMs from a code or description.
     *
     * @param string $search
     *
     * @return array
     * @throws BrasilApiException
     */
    public function search(string $search): array
    {
        return $this->client->request("/ncm/v1",
            self::GET,
            ["query" => ["search" => $search]]
        );
    }
}