<?php

declare(strict_types=1);

namespace BrasilApi\Endpoints\Collections;

use BrasilApi\Endpoints\Abstracts\Endpoint;
use BrasilApi\Exceptions\EndpointNotFound;
use InvalidArgumentException;

class Endpoints
{
    /**
     * Array of BrasilApi\Endpoints\Endpoint
     *
     * @var array<string, string>
     */
    private array $endpoints = [];
    
    /**
     * Endpoints constructor.
     *
     * @param array<string, string> $endpoints
     *
     * @throws EndpointNotFound
     */
    public function __construct(array $endpoints = [])
    {
        if (empty($endpoints)) return;
        
        foreach ($endpoints as $name => $endpoint) {
            $this->add($name, $endpoint);
        }
    }
    
    /**
     * Add a new endpoint to the collection.
     *
     * @param string $name Name to identify the endpoint
     * @param string $endpointClass Class of endpoint
     *
     * @return self
     * @throws EndpointNotFound
     */
    public function add(string $name, string $endpointClass): self
    {
        if (! class_exists($endpointClass)) {
            throw new EndpointNotFound("The endpoint class {$endpointClass} doesn't exist.");
        }
        
        if (! is_subclass_of($endpointClass, Endpoint::class)) {
            throw new InvalidArgumentException(
                "Class {$endpointClass} doesn't extends Endpoints\\Abstracts\\Endpoint.
            ");
        }
        
        $this->endpoints[$name] = $endpointClass;
        
        return $this;
    }
    
    /**
     * Checks if the collection has an endpoint by key.
     *
     * @param string $key Endpoint identifier
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->endpoints[$key]);
    }
    
    /**
     * Returns an endpoint by key.
     *
     * @param string $key Endpoint identifier
     *
     * @return string|null
     */
    public function get(string $key): ?string
    {
        if ($this->has($key)) {
            return $this->endpoints[$key];
        }
        
        return null;
    }
    
    /**
     * Returns the array of endpoints.
     *
     * @return array<string, string>
     */
    public function all(): array
    {
        return $this->endpoints;
    }
}