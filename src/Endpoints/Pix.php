<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/PIX
 */
class Pix extends Endpoint
{
    /**
     * Find information for all PIX participants on the current or previous day.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function participants(): array
    {
        return $this->client->request("/pix/v1/participants");
    }
}