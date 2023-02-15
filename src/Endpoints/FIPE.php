<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/FIPE
 */
class FIPE extends Endpoint
{
    /**
     * Find all vehicle brands referring to vehicle type.
     *
     * @param string $typeVehicle Type of vehicle
     * @param int|null $referenceTable Reference table FIPE
     *
     * @return array
     * @throws BrasilApiException
     */
    public function brandsByTypeVehicle(string $typeVehicle, ?int $referenceTable = null): array
    {
        return $this->client->request(
            "/fipe/marcas/v1/{$typeVehicle}",
            self::GET,
            ["tabela_referencia" => $referenceTable]);
    }
    
    /**
     * Find the price of a vehicle from fipe code.
     *
     * @param string $fipeCode Code FIPE of vehicle
     * @param int|null $referenceTable Reference table FIPE
     *
     * @return array
     * @throws BrasilApiException
     */
    public function price(string $fipeCode, ?int $referenceTable = null): array
    {
        return $this->client->request(
            "/fipe/preco/v1/{$fipeCode}",
            self::GET,
            ["tabela_referencia" => $referenceTable]);
    }
    
    /**
     * Find all references tables of FIPE.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function referenceTables(): array
    {
        return $this->client->request("/fipe/tabelas/v1");
    }
}