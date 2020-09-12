<?php

namespace App\Utils\CrystalMathLabs\Endpoints;

use Psr\Http\Message\StreamInterface;

class CurrentPlayerCount extends AbstractEndpointBase
{
    protected string $end_point_url = 'type=players';
    
    public function format(StreamInterface $data): string
    {
        return number_format(
            explode(',' , $data)[1]
        );
    }
}
