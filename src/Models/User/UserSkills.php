<?php

namespace App\Models\User;

use App\Utils\CrystalMathLabs\Api;
use App\Utils\Runescape\Levels;

class UserSkills {
    protected $user_id = 0;
    protected $skills = [];
    protected $total_level = 0;
    
    /**
     * @param int    $user_id
     * @param string $username
     */
    public function __construct($user_id, $username)
    {
        $this->user_id = $user_id;
        $this->skills = Api::getStatsForPlayer($username);
        $this->total_level = Levels::getTotalLevel($this->skills);
    }
    
    public function getSkills()
    {
        return $this->skills;
    }
    
    public function getTotalLevel()
    {
        return $this->total_level;
    }
}
