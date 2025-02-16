<?php

namespace App\Utils\API\OSRS;

use App\Utils\API\ApiException;
use App\Utils\API\OSRS\Endpoints\AbstractEndpoint;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Api
{
    private AbstractEndpoint $endpoint;

    public function __construct(AbstractEndpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function call(): array
    {
        try {
            $this->endpoint->setClient(new Client());
            return $this->endpoint->call();
        } catch (RequestException|ApiException) {
            return [];
        }
    }
}
