<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\BrasilApiException;

/**
 * @see https://brasilapi.com.br/docs#tag/CPTEC
 */
class CPTEC extends Endpoint
{
    /**
     * Find all cities from CPTEC. It is possible to perform a filter by name.
     *
     * @param string $cityName
     *
     * @return array
     * @throws BrasilApiException
     */
    public function cities(string $cityName = ""): array
    {
        return $this->client->request("/cptec/v1/cidade/{$cityName}");
    }
    
    /**
     * Find weather information in all capitals of the country.
     *
     * @return array
     * @throws BrasilApiException
     */
    public function weatherInCapitals(): array
    {
        return $this->client->request("/cptec/v1/clima/capital");
    }
    
    /**
     * Find weather information for a specific airport.
     *
     * @param string $airportCode Code of airport
     *
     * @return array
     * @throws BrasilApiException
     */
    public function weatherInAirport(string $airportCode): array
    {
        return $this->client->request("/cptec/v1/clima/aeroporto/{$airportCode}");
    }
    
    /**
     * Find weather information for a specific city.
     *
     * @param int $cityCode Code of city
     *
     * @return array
     * @throws BrasilApiException
     */
    public function weatherInCity(int $cityCode): array
    {
        return $this->client->request("/cptec/v1/clima/previsao/{$cityCode}");
    }
    
    /**
     * Find weather information for a specific city within 1 to 6 days.
     *
     * @param int $cityCode Code of city
     * @param int $days Quantity of days
     *
     * @return array
     * @throws BrasilApiException
     */
    public function weatherInCityInXDays(int $cityCode, int $days = 6): array
    {
        return $this->client->request("/cptec/v1/clima/previsao/{$cityCode}/{$days}");
    }
    
    /**
     * Find ocean weather information for a specific city.
     *
     * @param int $cityCode Code of city
     *
     * @return array
     * @throws BrasilApiException
     */
    public function oceanWeatherInCity(int $cityCode): array
    {
        return $this->client->request("/cptec/v1/ondas/{$cityCode}");
    }
    
    /**
     * Find ocean weather information for a specific city within 1 to 6 days.
     *
     * @param int $cityCode Code of city
     * @param int $days Quantity of days
     *
     * @return array
     * @throws BrasilApiException
     */
    public function oceanWeatherInCityInXDays(int $cityCode, int $days = 6): array
    {
        return $this->client->request("/cptec/v1/ondas/{$cityCode}/{$days}");
    }
}