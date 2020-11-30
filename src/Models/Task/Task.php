<?php

namespace App\Models\Task;

class Task
{
    protected string $task_id = '';
    protected string $title = '';
    protected string $description = '';
    protected bool $is_completed = false;
    protected string $date = '';
    protected string $user_id = '';

    public function __construct($task_id, $title, $description, $is_completed, $date, $user_id)
    {
        if (!$user_id) {
            return;
        }
        
        $this->task_id = $task_id;
        $this->title = $title;
        $this->description = $description;
        $this->is_completed = $is_completed;
        $this->date = $date;
        $this->user_id = $user_id;
    }

    public function getTaskID(): string
    {
        return $this->task_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function getIsCompleted(): bool
    {
        return (int)$this->is_completed;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getUserID(): string
    {
        return $this->user_id;
    }

    public static function edit($task_id, $user_id, $title, $description, $complete): void
    {
        $db = getDatabase();
        $sql = $db->prepare('UPDATE task SET title =  '$title', description = '$description', is_completed = '$complete'  WHERE task_id =? AND user_id = ?');
        $sql->execute([$task_id, $user_id]);

        redirect('Task/All/' . getSignedInUser()->getID());
    }

    public static function add($title, $description, $date, $user_id): void
    {
        if (!count($_POST)) {
            redirect('Task/All/' . getSignedInUser()->getID());
        }
        
        $db = getDatabase();
        $sql = $db->prepare('INSERT INTO task (title, description, date, user_id) VALUES (?, ?, ?, ?)');
        $sql->execute([
            $title,
            $description,
            $date,
            $user_id
        ]);

        redirect('Task/All/' . getSignedInUser()->getID());
    }

    public static function complete($user_id, $task_id): void
    {
        $db = getDatabase();
        $sql = $db->prepare('UPDATE task SET is_completed = 1 WHERE user_id =? AND task_id =?');
        $sql->execute([$user_id, $task_id]);

        redirect('Task/All/' . getSignedInUser()->getID());
    }

    public static function delete($user_id, $task_id): void
    {
        $db = getDatabase();
        $sql = $db->prepare('DELETE FROM task WHERE user_id =? AND task_id =?');
        $sql->execute([$user_id, $task_id]);
        
        redirect('Task/All/' . getSignedInUser()->getID());
    }
}
