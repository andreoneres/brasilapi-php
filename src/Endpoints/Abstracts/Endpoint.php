<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints\Abstracts;

use BrasilApi\Client;

abstract class Endpoint
{
    /**
     * HTTP METHOD - GET
     */
    const GET = "GET";
    
    /**
     * HTTP METHOD - POST
     */
    const POST = "POST";
    
    /**
     * Instance of BrasilApi\Client
     */
    protected Client $client;
    
    /**
     * Endpoint constructor.
     *
     * @param Client $client Instance of BrasilApi\Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}