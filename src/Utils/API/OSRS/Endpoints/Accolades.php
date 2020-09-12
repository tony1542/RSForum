<?php

namespace App\Utils\API\OSRS\Endpoints;

use App\Utils\Runescape\Skills;
use Psr\Http\Message\StreamInterface;

class Accolades extends AbstractEndpoint
{
    protected string $end_point_url = 'player=';
    
    public function format(StreamInterface $body): array
    {
        $data = $this->formatStandard($body);

        // Strip anything not related
        $data = array_slice($data, count(Skills::ALL));
        array_shift($data);
        
        dd($data);
        
        $accolades = [];
        $counter = 0;
        foreach ($data as $key => $row) {
            $row = explode(',', $row);
            $rank = $row[0] ?? null;
            $score = $row[1] ?? null;
            
            if (!$rank || !$score) {
                continue;
            }
            
            $accolades[] = [];
            
            $counter++;
        }
        
        return $accolades;
    }
}
