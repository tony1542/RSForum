<?php

namespace App\Utils\API\OSRS\Endpoints;

use Psr\Http\Message\StreamInterface;

class Stats extends AbstractEndpoint
{
    protected string $end_point_url = 'player=';
    
    public function __construct(string $player_name)
    {
        parent::__construct();
        $this->end_point_url .= $player_name;
    }
    
    public function format(StreamInterface $body): array
    {
        dd($body);
    }
}
