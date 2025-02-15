<?php

namespace App\Utils\API;

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
