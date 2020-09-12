<?php

namespace App\Utils\API\OSRS\Endpoints;

use App\Utils\API\EndpointInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractEndpoint implements EndpointInterface
{
    public function call()
    {
        // TODO: Implement call() method.
    }
    
    abstract public function format(StreamInterface $data);
}
