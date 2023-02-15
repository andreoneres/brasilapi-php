<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/Feriados-Nacionais
 */
class Holidays extends Endpoint
{
    /**
     * Find all holidays in a specific year.
     *
     * @param int $year Year
     *
     * @return array
     * @throws BrasilApiException
     */
    public function fromYear(int $year): array
    {
        return $this->client->request("/feriados/v1/{$year}");
    }
}