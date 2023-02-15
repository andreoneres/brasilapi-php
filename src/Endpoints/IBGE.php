<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/IBGE
 */
class IBGE extends Endpoint
{
    /**
     * Find all cities from a specific state.
     *
     * @param string $stateCode Code of state
     * @param string|null $providers Data provider
     *
     * @return array
     * @throws BrasilApiException
     */
    public function stateCities(string $stateCode, ?string $providers = null): array
    {
        return $this->client->request(
            "/ibge/municipios/v1/{$stateCode}",
            self::GET,
            ["providers" => $providers]
        );
    }
    
    /**
     * Find informations about all states of country.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function states(): array
    {
        return $this->client->request("/ibge/uf/v1");
    }
    
    /**
     * Find informations about a specific state.
     *
     * @param string $stateCode Code of state
     *
     * @return array
     * @throws BrasilApiException
     */
    public function state(string $stateCode): array
    {
        return $this->client->request("/ibge/uf/v1/{$stateCode}");
    }
}