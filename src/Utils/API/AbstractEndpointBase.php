<?php

namespace App\Utils\API;

use GuzzleHttp\Client;
use Throwable;

abstract class AbstractEndpointBase
{
    protected string $base_api_url;
    protected string $end_point_url;
    
    protected Client $client;
    protected ApiErrorHandlerInterface $error_handler;
    
    public function __construct()
    {
        $this->client = new Client();
    }
    
    /**
     * @return array
     *
     * @throws ApiException
     */
    public function call(): array
    {
        $full_url = $this->base_api_url . $this->end_point_url;
        
        try {
            $body = $this->client->request('GET', $full_url)->getBody();
        } catch (Throwable $t) {
            return [];
        }
        
        $contents = substr($body->getContents(), 3, 5);
        $this->error_handler->checkForErrors($contents);
        
        return $this->format($body);
    }
}
