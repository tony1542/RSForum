<?php

namespace App\Models\User;

use App\Utils\CrystalMathLabs\Api;
use App\Utils\Runescape\Levels;
use PDO;

class UserSkills {
    protected array $skills = [];
    protected int $total_level = 0;
    protected string $username;
    
    public function __construct(string $username)
    {
        $this->username = $username;
        $this->skills = Api::getStatsForPlayer($username);
        
        if ($this->skills) {
            $this->total_level = Levels::getTotalLevel(
                array_column($this->getSkills(), 'level')
            );
        }
        
        // If we find a skills response from the API, insert a record into the database
        if ($this->skills) {
            $this->insertSkills();
        
            return;
        }
        
        // If our API isn't connecting, check the DB for a user's skills
        $this->skills = $this->getLastUpdated();
        
        if ($this->skills) {
            $this->total_level = Levels::getTotalLevel(
                array_column($this->getSkills(), 'level')
            );
        }
        
        // If we have no record in the DB, set total level to 0
        if (!$this->skills) {
            $this->total_level = 0;
        }
    }
    
    // Get latest updated stats from database
    protected function getLastUpdated(): array
    {
        $database = getDatabase();
        $sql = $database->prepare('SELECT * FROM user_skills
                                     WHERE username = ?
                                   ORDER BY user_stat_id DESC
                                   LIMIT 24');
        $sql->execute([$this->username]);
        
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $result = array_reverse($result);
        
        // Unset the rows we don't need
        unset($result['user_stat_id'], $result['username']);
        
        if (!is_array($result)) {
            return [];
        }
    
        $return_array = [];
        $i = 0;
        foreach ($result as $row) {
            $return_array[] = [
                'skill_index' => $i,
                'skill_name'  => ucwords($row['skill_name']),
                'exp'         => number_format($row['skill_exp']),
                'level'       => $i === 0 ? null : Levels::findFromExp($row['skill_exp']),
                'rank'        => number_format($row['rank'])
            ];
            $i++;
        }
        
        return $return_array;
    }
    
    protected function insertSkills(): void
    {
        $database = getDatabase();
    
        foreach ($this->skills as $skill_row) {
            $sql = '';
            $sql .= 'skill_exp = ' . (int) filter_var($skill_row['exp'], FILTER_SANITIZE_NUMBER_INT);
            $sql .= ', skill_name = ?';
            $sql .= ', rank = ' . (int) filter_var($skill_row['rank'], FILTER_SANITIZE_NUMBER_INT);
            $sql = $database->prepare('INSERT INTO user_skills SET ' . $sql . ', username = ?');
            $sql->execute([$skill_row['skill_name'], $this->username]);
        }
    }
    
    public function getSkills(): array
    {
        return $this->skills;
    }
    
    public function getTotalLevel(): int
    {
        return $this->total_level;
    }
}
