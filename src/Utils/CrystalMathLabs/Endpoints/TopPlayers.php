<?php

namespace App\Utils\CrystalMathLabs\Endpoints;

use Psr\Http\Message\StreamInterface;

class TopPlayers extends AbstractEndpointBase
{
    const TIME_PERIOD_NAME = 'timePeriod';
    const TIME_PERIOD_DAY   = 'day';
    const TIME_PERIOD_WEEK  = 'week';
    const TIME_PERIOD_MONTH = 'month';
    
    const TIME_PERIODS = [
        self::TIME_PERIOD_DAY,
        self::TIME_PERIOD_WEEK,
        self::TIME_PERIOD_MONTH
    ];
    
    protected $end_point_url = 'type=currenttop';
    
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
    
    public function format(StreamInterface $result)
    {
        $result = $this->formatStandard($result);
        
        $currentTopPlayers = [];
        foreach ($result as $row) {
            $row = explode(',', $row);
            $name = $row[0] ?? null;
            $exp = $row[1] ?? null;
            
            if (!$name || !$exp) {
                continue;
            }
            
            $currentTopPlayers[] = [
                'name' => $name,
                'exp'  => number_format($exp)
            ];
        }
        
        return $currentTopPlayers;
    }
}
