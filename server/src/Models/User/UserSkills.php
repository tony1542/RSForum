<?php

namespace App\Models\User;

use App\Utils\API\OSRS\Api;
use App\Utils\API\OSRS\Endpoints\Stats;
use App\Utils\Runescape\Levels;
use PDO;

class UserSkills extends AbstractHighscoreComponent
{
    protected array $skills = [];
    protected int $total_level = 0;
    protected string $username;
    protected int $account_type_id;

    public function __construct(string $username, int $account_type_id)
    {
        $this->username = $username;
        $this->account_type_id = $account_type_id;

        $this->skills = $this->getUpdatedInLastDay();

        if ($this->skills) {
            $this->total_level = Levels::getTotalLevel(
                array_column($this->getSkills(), 'level')
            );

            return;
        }

        $api = new Api(new Stats($username, $account_type_id));
        $this->skills = $api->call();

        if ($this->skills) {
            $this->total_level = Levels::getTotalLevel(
                array_column($this->getSkills(), 'level')
            );

            $this->insert();

            return;
        }

        if (!$this->skills) {
            $this->total_level = 0;
        }
    }

    protected function getUpdatedInLastDay(): array
    {
        $database = getDatabase();
        $sql = $database->prepare('SELECT * FROM user_skills
                                     WHERE username = ? AND date_added >= NOW() - INTERVAL 1 DAY
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
                'skill_name' => ucwords($row['skill_name']),
                'exp' => number_format($row['skill_exp']),
                'level' => $i === 0 ? null : Levels::findFromExp($row['skill_exp']),
                'rank' => number_format($row['rank'])
            ];
            $i++;
        }

        return $return_array;
    }

    public function getTotalLevel(): int
    {
        return $this->total_level;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    protected function insert(): void
    {
        $database = getDatabase();

        foreach ($this->skills as $skill_row) {
            $sql = '';
            $sql .= 'skill_exp = ' . (int)filter_var($skill_row['exp'], FILTER_SANITIZE_NUMBER_INT);
            $sql .= ', skill_name = ?';
            $sql .= ', `rank` = ' . (int)filter_var($skill_row['rank'], FILTER_SANITIZE_NUMBER_INT);
            $sql = $database->prepare('INSERT INTO user_skills SET ' . $sql . ', username = ?');
            $sql->execute([$skill_row['skill_name'], $this->username]);
        }
    }
}
