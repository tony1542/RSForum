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
        $tasks = []; //declaring within the construct so if the query doesnt get anything it doesn't throw an undefined error.
        $instance = getDatabase();
        $stmt = $instance->prepare('SELECT * FROM todo WHERE user_id =?');
        $stmt->execute([$user_id]);
        $value = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($value){
            foreach ($value as $row)
            {
                $task_id = $row['task_id'];
                $title = $row['title'];
                $description = $row['description'];
                $is_completed = $row['is_completed'];
                $date = $row['date'];
                $user_id = $row['user_id'];
                $tasks[] = new Todo($task_id, $title, $description, $is_completed, $date, $user_id);
            }
        }
        $this->tasks = $tasks;
    }
    public function getTasks()
    {
        return $this->tasks;
    }
}