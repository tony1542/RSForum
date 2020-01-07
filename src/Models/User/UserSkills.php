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
        $this->total_level = Levels::getTotalLevel(
            array_column($this->getSkills(), 'level')
        );
        
        $this->skills = null;
        
        // If we find a skills response from the API, insert a record into the database
        if ($this->skills) {
            $this->insertSkills();
            
            return;
        }
        
        // If our API isn't connecting, check the DB for a user's skills
        $this->skills = $this->getLastUpdated();
        $this->total_level = Levels::getTotalLevel(
            array_column($this->getSkills(), 'level')
        );
        
        // If we have no record in the DB, return 'N/A'
        if (!$this->skills) {
            $this->total_level = 'N/A';
        }
    }
    
    // Get latest updated stats from database
    protected function getLastUpdated()
    {
        $database = getDatabase();
        $sql = $database->prepare('SELECT * FROM user_skills
                                     WHERE username = ?
                                   ORDER BY user_stat_id DESC
                                   LIMIT 1');
        $sql->execute([$this->username]);
        
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        // Unset the rows we don't need
        unset($result['user_stat_id'], $result['username'], $result['overall']);
        
        if (!is_array($result)) {
            return [];
        }
    
        $return_array = [];
        foreach ($result as $skill => $exp) {
            $return_array[] = [
                'skill_name' => ucwords($skill),
                'exp'   => $exp,
                'level' => Levels::findFromExp($exp, false)
            ];
        }
        
        return $return_array;
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
