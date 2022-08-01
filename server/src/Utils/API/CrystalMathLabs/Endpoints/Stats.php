<?php

namespace App\Utils\API\CrystalMathLabs\Endpoints;

use Psr\Http\Message\StreamInterface;

use App\Utils\Runescape\Skills;
use App\Utils\Runescape\Levels;

class Stats extends AbstractEndpoint
{
    protected string $end_point_url = 'type=stats&player=';
    
    public function format(StreamInterface $data): array
    {
        $result = $this->formatStandard($data);
        array_shift($result);
        
        $skills = [];
        $counter = 0;
        foreach ($result as $key => $row) {
            $row = explode(',', $row);
            $exp = $row[0] ?? null;
            $rank = $row[1] ?? null;
            
            if (!$exp || !$rank) {
                continue;
            }
    
            $skills[] = [
                'skill_index' => $key,
                'skill_name'  => Skills::getSkillNameFromIndex($key),
                'exp'         => number_format($exp),
                'level'       => $counter !== 0 ? Levels::findFromExp($exp) : null,
                'rank'        => number_format($rank)
            ];
            
            $counter++;
        }
        
        return $skills;
    }
}
