<?php

declare(strict_types=1);

namespace BrasilApi;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Endpoints\Banks;
use BrasilApi\Endpoints\CEP;
use BrasilApi\Endpoints\CEP2;
use BrasilApi\Endpoints\CNPJ;
use BrasilApi\Endpoints\Collections\Endpoints;
use BrasilApi\Endpoints\CPTEC;
use BrasilApi\Endpoints\DDD;
use BrasilApi\Endpoints\Holidays;
use BrasilApi\Endpoints\FIPE;
use BrasilApi\Endpoints\IBGE;
use BrasilApi\Endpoints\ISBN;
use BrasilApi\Endpoints\NCM;
use BrasilApi\Endpoints\RegisterBR;
use BrasilApi\Endpoints\Taxes;
use BrasilApi\Exceptions\BrasilApiException;
use BrasilApi\Exceptions\EndpointNotFound;
use BrasilApi\Handlers\ResponseHandler;
use BrasilApi\Handlers\UriHandler;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

/**
 * @method Banks banks()
 * @method CEP cep()
 * @method CEP2 cep2()
 * @method CNPJ cnpj()
 * @method CPTEC cptec()
 * @method DDD ddd()
 * @method Holidays holidays()
 * @method FIPE fipe()
 * @method IBGE ibge()
 * @method ISBN isbn()
 * @method NCM ncm()
 * @method RegisterBR registerBr()
 * @method Taxes taxes()
 */
class Client
{
    const BASE_URI = "https://brasilapi.com.br/api/";
    
    /**
     * Instance of GuzzleHttp\Client
     */
    private GuzzleClient $client;
    
    /**
     * Collection of endpoints
     */
    private Endpoints $endpoints;
    
    public function __construct()
    {
        $this->client = new GuzzleClient([
            "base_uri" => self::BASE_URI,
        ]);
        
        $this->loadDefaults();
    }
    
    /**
     * Send an HTTP request to BrasilApi
     *
     * @param string $uri URI of resource
     * @param string $method HTTP Method
     * @param array $options GuzzleHttp options
     *
     * @return array Response body
     * @throws BrasilApiException
     */
    public function request(string $uri, string $method = "GET", array $options = []): array
    {
        try {
            $response = $this->client->request(
                $method,
                UriHandler::format($uri),
                $options
            );
            
            return ResponseHandler::success((string)$response->getBody());
        } catch (RequestException $exception) {
            ResponseHandler::failure($exception);
        } catch (GuzzleException $exception) {
            throw new BrasilApiException($exception->getMessage());
        }
    }
    
    /**
     * Add an endpoint to the collection.
     *
     * @param string $name Name to identify the endpoint when calling it via __call
     * @param string $endpointClass Class of the endpoint
     *
     * @return void
     * @throws EndpointNotFound
     */
    public function addEndpoint(string $name, string $endpointClass): void
    {
        $this->endpoints->add($name, $endpointClass);
    }
    
    /**
     * Magic method to call an endpoint.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return Endpoint
     * @throws EndpointNotFound
     */
    public function __call(string $name, array $arguments = []): Endpoint
    {
        if (! $this->endpoints->has($name)) {
            throw new EndpointNotFound("The endpoint {$name} doesn't exist.");
        }
        
        $endpoint = $this->endpoints->get($name);
        
        return new $endpoint($this);
    }
    
    /**
     * Load all default endpoints.
     *
     * @return void
     */
    private function loadDefaults(): void
    {
        $this->endpoints = new Endpoints([
            "banks"      => Banks::class,
            "cep"        => CEP::class,
            "cep2"       => CEP2::class,
            "cnpj"       => CNPJ::class,
            "cptec"      => CPTEC::class,
            "ddd"        => DDD::class,
            "holidays"   => Holidays::class,
            "fipe"       => FIPE::class,
            "ibge"       => IBGE::class,
            "isbn"       => ISBN::class,
            "ncm"        => NCM::class,
            "registerBr" => RegisterBR::class,
            "taxes"      => Taxes::class,
        ]);
    }
}