<?php

declare(strict_types=1);

namespace Unit;

use BrasilApi\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\TestCase;

abstract class BrasilApiTestCase extends TestCase
{
    /**
     * Returns the mocked array response from the given file.
     *
     * @param string $mockName
     *
     * @return array
     */
    protected function arrayMock(string $mockName): array
    {
        $content = $this->jsonMock($mockName);
        
        return json_decode($content, true);
    }
    
    /**
     * Returns the mocked json response from the given file.
     *
     * @param string $mockName
     *
     * @return string
     */
    protected function jsonMock(string $mockName): string
    {
        return file_get_contents(__DIR__ . "/Mocks/$mockName.json");
    }
    
    /**
     * Builds a GuzzleHttp\Client mock with a mocked response.
     *
     * @param array $container
     * @param MockHandler $mock
     *
     * @return Client
     */
    protected function buildClient(array &$container, MockHandler $mock): Client
    {
        $history = Middleware::history($container);
        
        $handler = HandlerStack::create($mock);
        $handler->push($history);
        
        return new Client(["handler" => $handler]);
    }
    
    /**
     * Returns the mock container HTTP method from GuzzleHttp\Middleware.
     *
     * @param array $container
     *
     * @return string
     */
    protected function getRequestMethod(array $container): string
    {
        return $container["request"]->getMethod();
    }
    
    /**
     * Returns the mock container request URI from GuzzleHttp\Middleware.
     *
     * @param array $container
     *
     * @return string
     */
    protected function getRequestUri(array $container): string
    {
        return $container["request"]->getUri()->getPath();
    }
    
    /**
     * Returns the mock container query string from GuzzleHttp\Middleware.
     *
     * @param array $container
     *
     * @return string
     */
    protected function getQueryString(array $container): string
    {
        return $container["request"]->getUri()->getQuery();
    }
    
    /**
     * Returns the mock container body from GuzzleHttp\Middleware.
     *
     * @param array $container
     *
     * @return string
     */
    protected function getBody(array $container): string
    {
        $requestBody = $container["request"]->getBody();
        $bodySize = $requestBody->getSize();
        
        return $requestBody->read($bodySize);
    }
}