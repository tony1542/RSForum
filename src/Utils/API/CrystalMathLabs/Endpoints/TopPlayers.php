<?php

namespace App\Utils\API\CrystalMathLabs\Endpoints;

use Psr\Http\Message\StreamInterface;

class TopPlayers extends AbstractEndpoint
{
    public const TIME_PERIOD_NAME = 'timePeriod';
    public const TIME_PERIOD_DAY   = 'day';
    public const TIME_PERIOD_WEEK  = 'week';
    public const TIME_PERIOD_MONTH = 'month';
    
    public const TIME_PERIODS = [
        self::TIME_PERIOD_DAY,
        self::TIME_PERIOD_WEEK,
        self::TIME_PERIOD_MONTH
    ];
    
    protected string $end_point_url = 'type=currenttop';
    
    /**
     * @param string $type
     */
    public function __construct($type = self::TIME_PERIOD_DAY)
    {
        parent::__construct();
        
        if (!in_array($type, self::TIME_PERIODS)) {
            $type = self::TIME_PERIOD_DAY;
        }
        
        $this->end_point_url .= '&timeperiod=' . $type;
    }
    
    public function format(StreamInterface $data)
    {
        $result = $this->formatStandard($data);
        
        $current_top_players = [];
        foreach ($result as $row) {
            $row = explode(',', $row);
            $name = $row[0] ?? null;
            $exp = $row[1] ?? null;
            
            if (!$name || !$exp) {
                continue;
            }
            
            $current_top_players[] = [
                'name' => $name,
                'exp'  => number_format($exp)
            ];
        }
        
        return $current_top_players;
    }
}
