<?php

namespace App\Models\Task;

use PDO;

class TaskCollector
{
    /** @var Task[] $tasks */
    protected array $tasks = [];

    public function __construct($user_id)
    {
        if (!$user_id) {
            return;
        }
        
        $tasks = [];
        $instance = getDatabase();
        $stmt = $instance->prepare('SELECT * FROM task WHERE user_id = ? ORDER BY complete_order');
        $stmt->execute([$user_id]);
        $value = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$value) {
            return;
        }
        
        foreach ($value as $row) {
            $task_id = $row['task_id'];
            $title = $row['title'];
            $description = $row['description'];
            $is_completed = $row['is_completed'];
            $date = $row['date'];
            $user_id = $row['user_id'];
            $complete_order = $row['complete_order'];
            $tasks[] = new Task($task_id, $title, $description, $is_completed, $date, $user_id, $complete_order);
        }
        
        $this->tasks = $tasks;
    }
    
    public function getTasks()
    {
        return $this->tasks;
    }
}
