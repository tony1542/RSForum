<?php

namespace App\Utils\CrystalMathLabs\Endpoints;

use Psr\Http\Message\StreamInterface;

interface EndpointInterface
{
    /**
     * Call the endpoint and return the result
     *
     * @return mixed
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
