<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/Corretoras
 */
class Realtors extends Endpoint
{
    /**
     * Find a specific realtor by CNPJ.
     *
     * @param string $cnpj Realtor CNPJ
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(string $cnpj): array
    {
        return $this->client->request("/cvm/corretoras/v1/{$cnpj}");
    }
    
    /**
     * Find the realtors listed on the CVM.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function getList(): array
    {
        return $this->client->request("/cvm/corretoras/v1");
    }
}