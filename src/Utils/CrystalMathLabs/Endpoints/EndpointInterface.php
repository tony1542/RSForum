<?php

namespace App\Utils\CrystalMathLabs\Endpoints;

use App\Utils\CrystalMathLabs\Exceptions\ApiException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;

interface EndpointInterface
{
    /**
     * Call the endpoint and return the result
     *
     * @return mixed
     *
     * @throws RequestException|ApiException
     */
    public function call();
    
    /**
     * Format the data after retrieving it
     *
     * @param StreamInterface $data
     *
     * @return mixed
     */
    public function format(StreamInterface $data);
}
