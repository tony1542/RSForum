<?php

namespace App\Utils\API\OSRS\Endpoints;

use App\Utils\Runescape\Skills;
use App\Utils\Runescape\Accolades as OSRSAccolade;
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
        
        $accolades = [];
        foreach ($data as $key => $row) {
            $row = explode(',', $row);
            $rank = $row[0] ?? null;
            $score = $row[1] ?? null;
            
            if ((int) $rank === -1 || (int) $score === -1) {
                continue;
            }
            
            $accolade_name = OSRSAccolade::getAccoladeFromIndex($key);
            
            if (!$accolade_name) {
                continue;
            }
            
            $accolades[] = [
                'accolade_index' => $key,
                'accolade_name'  => $accolade_name,
                'score'          => $score,
                'rank'           => number_format((float) $rank)
            ];
        }
        
        return $accolades;
    }
}
