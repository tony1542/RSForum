<?php

namespace App\Models\User;

use App\Utils\API\OSRS\Api as OSRS;
use PDO;

class UserAccolades extends AbstractHighscoreComponent
{
    protected array $accolades = [];
    protected string $username;
    
    public function __construct(string $username, int $account_type_id)
    {
        $this->username = $username;
        
        $this->accolades = $this->getUpdatedInLastDay();
        if ($this->accolades) {
            return;
        }
    
        // If we find a accolades response from the API, insert a record into the database
        $this->accolades = OSRS::getAccoladesForPlayer($username, $account_type_id);
        if ($this->accolades) {
            $this->insert();
        }
    }
    
    public function getAccolades(): array
    {
        return $this->accolades;
    }
    
    // Get latest updated stats from database
    protected function getUpdatedInLastDay(): array
    {
        $database = getDatabase();
        $sql = $database->prepare('SELECT * FROM user_accolades ua
                                        INNER JOIN user_accolades_line ual ON ua.user_accolade_id = ual.user_accolade_id
                                     WHERE username = ? AND date_added >= NOW() - INTERVAL 1 DAY
                                   ORDER BY ua.user_accolade_id DESC, ual.accolade_index');
        $sql->execute([$this->username]);
        
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        if (!is_array($result)) {
            return [];
        }
        
        $return_array = [];
        foreach ($result as $row) {
            $return_array[] = [
                'accolade_index' => $row['accolade_index'],
                'accolade_name'  => $row['accolade_name'],
                'score'          => number_format($row['score']),
                'rank'           => number_format($row['rank'])
            ];
        }
        
        return $return_array;
    }
    
    protected function insert(): void
    {
        $database = getDatabase();
        
        $sql = $database->prepare('INSERT INTO user_accolades SET username = ?');
        $sql->execute([$this->username]);
        $accolade_id = $database->lastInsertId();
        
        foreach ($this->accolades as $accolade_row) {
            $sql = '';
            $sql .= 'score = ' . (int) filter_var($accolade_row['score'], FILTER_SANITIZE_NUMBER_INT);
            $sql .= ', rank = ' . (int) filter_var($accolade_row['rank'], FILTER_SANITIZE_NUMBER_INT);
            $sql .= ', accolade_name = ?';
            $sql .= ', accolade_index = ?';
            $sql = $database->prepare('INSERT INTO user_accolades_line SET ' . $sql . ', user_accolade_id = ?');
            $sql->execute([
                $accolade_row['accolade_name'],
                $accolade_row['accolade_index'],
                $accolade_id
            ]);
        }
    }
}
