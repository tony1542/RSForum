<?php


namespace App\Models\Todo;

use App\Utils\Database\Connection;
use App\Utils\Http\Request;
use App\Utils\Input\Sanitizer;
use PDO;
use App\Utils\Http\Session;

class Todo
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

    public function getTaskID()
    {
        return $this->task_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getIsCompleted()
    {
        return (int)$this->is_completed; //casted the boolean with (int) to make bool show up if it's false;O
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getUID()
    {
        return $this->user_id;
    }

    public function edit($task_id, $user_id, $title, $description, $complete)
    {
        $db = getDatabase();
        $sql = $db->prepare("UPDATE todo SET title =  '$title', description = '$description', is_completed = '$complete'  WHERE task_id =? AND user_id = ?");
        $sql->execute([$task_id, $user_id]);

        redirect("Todo/Tasks/" . getSignedInUser()->getID());

    }

    public static function add($title, $description, $date, $user_id)
    {
        if (!count($_POST)) {
            redirect("Todo/Tasks/" . getSignedInUser()->getID());
        }
        //if we get this far, no errors, insert task into database.

        $db = getDatabase();
        $sql = $db->prepare("INSERT INTO todo (title, description, date, user_id) VALUES (?, ?, ?, ?)");

        $values = [
            $title,
            $description,
            $date,
            $user_id
        ];
        $sql->execute($values);

        redirect("Todo/Tasks/" . getSignedInUser()->getID());
    }

    public static function complete($user_id, $task_id)
    {
        $db = getDatabase();
        $sql = $db->prepare('UPDATE todo SET is_completed = 1 WHERE user_id =? AND task_id =?');
        $sql->execute([$user_id, $task_id]);

        redirect("Todo/Tasks/" . getSignedInUser()->getID());
    }

    public static function delete($user_id, $task_id)
    {
        $db = getDatabase();
        $stm = $db->prepare('DELETE FROM todo WHERE user_id =? AND task_id =?');
        $stm->execute([$user_id, $task_id]);
        redirect("Todo/Tasks/" . getSignedInUser()->getID());
    }

}
