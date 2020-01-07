<?php

namespace App\Models\User;

use App\Utils\CrystalMathLabs\Api;
use App\Utils\Runescape\Levels;
use PDO;

class UserSkills {
    protected $skills = [];
    protected $total_level = 0;
    protected $username;
    
    public function __construct($username)
    {
        $this->username = $username;
        $this->skills = Api::getStatsForPlayer($username);
        $this->total_level = Levels::getTotalLevel($this->skills);
        
        if ($this->skills) {
            $this->insertSkills();
            
            return;
        }
        
        // If our API isn't connecting, check the DB for a user's skills
        $this->skills = $this->getLastUpdated();
        $this->total_level = Levels::getTotalLevel($this->skills);
        
        // If we have no record in the DB, return 'N/A'
        if (!$this->skills) {
            $this->total_level = 'N/A';
        }
    }
    
    // Get latest updated stats from database
    protected function getLastUpdated()
    {
        $database = getDatabase();
        $sql = $database->prepare("SELECT * FROM user_skills WHERE username = ?");
        $sql->execute([$this->username]);
        
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    protected function insertSkills()
    {
        $query = [];
        foreach ($this->skills as $skill_row) {
            $query[] = $skill_row['skill_name'] . ' = ' . (int) filter_var($skill_row['exp'], FILTER_SANITIZE_NUMBER_INT);
        }
        
        $query = implode(', ', $query);
        
        $database = getDatabase();
        
        $sql = $database->prepare('INSERT INTO user_skills SET ' . $query . ', username = ?');
        $sql->execute([$this->username]);
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
