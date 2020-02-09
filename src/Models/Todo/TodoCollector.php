<?php


namespace App\Models\Todo;
use PDO;


class TodoCollector
{

    /** @var \App\Models\Todo $tasks */
    protected $tasks = [];

    public function __construct($user_id)
    {
        if (!$user_id) {
            return;
        }
        //Create an instance of our DB, then PDO query db for task based off user_id
        $instance = getDatabase();
        $stmt = $instance->prepare('SELECT * FROM todo WHERE user_id =?');
        $stmt->execute([$user_id]);
        $value = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($value as $row)
        {
            $task_id = $row['task_id'];
            $title = $row['title'];
            $description = $row['description'];
            $is_completed = $row['is_completed'];
            $user_id = $row['user_id'];
            $tasks[] = new Todo($task_id, $title, $description, $is_completed, $user_id);
        }
        $this->tasks = $tasks;
    }
    public function getTasks()
    {
        return $this->tasks;
    }
}