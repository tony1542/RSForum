<?php

namespace App\Utils\API\CrystalMathLabs\Endpoints;

use Psr\Http\Message\StreamInterface;

class CurrentPlayerCount extends AbstractEndpoint
{
    protected string $end_point_url = 'type=players';
    
    public function format(StreamInterface $data): string
    {
        return number_format(
            explode(',' , $data)[1]
        );
    }
}
