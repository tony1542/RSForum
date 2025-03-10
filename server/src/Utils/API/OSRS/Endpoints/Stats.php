<?php

namespace App\Utils\API\OSRS\Endpoints;

use App\Utils\Runescape\Levels;
use App\Utils\Runescape\Skills;

class Stats extends AbstractEndpoint
{
    protected string $end_point_url = 'player=';

    public function format(string $body): array
    {
        $data = $this->formatStandard($body);

        $skills = [];
        $counter = 0;
        foreach ($data as $key => $row) {
            $row = explode(',', $row);
            $rank = $row[0] ?? null;
            $level = $row[1] ?? null;
            $exp = $row[2] ?? null;

            if (!$exp || !$rank || !$level) {
                continue;
            }

            $skills[] = [
                'skill_index' => $key,
                'skill_name' => Skills::getSkillNameFromIndex($key),
                'exp' => number_format((int) $exp),
                'level' => $counter !== 0 ? Levels::findFromExp($exp) : null,
                'rank' => number_format((int) $rank)
            ];

            $counter++;
        }

        return $skills;
    }
}
