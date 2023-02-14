<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

class CNPJ extends Endpoint
{
    /**
     * Find a CNPJ
     *
     * @param string $cnpj
     *
     * @return array
     * @throws BrasilApiException
     */
    public function get(string $cnpj): array
    {
        return $this->client->request("/cnpj/v1/{$cnpj}");
    }
}