<?php


namespace App\Models\Todo;

use App\Utils\Database\Connection;
use App\Utils\Http\Request;
use App\Utils\Input\Sanitizer;
use PDO;
use App\Utils\Http\Session;

class Todo
{
    protected string $task_id='';
    protected string $title='';
    protected string $description='';
    protected bool $is_completed= false;
    protected string $user_id='';

    public function __construct($task_id, $title, $description, $is_completed, $user_id)
{
    if(!$user_id){
        return;
}
        $this->task_id = $task_id;
       $this->title= $title;
        $this->description = $description;
       $this->is_completed = $is_completed;
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
    public function getUID()
    {
        return $this->user_id;
    }

public static function add($title, $description, $user_id)
{
    if(!count($_POST)) {
        redirect("Todo/Tasks/" . getSignedInUser()->getID());
    }
    //if we get this far, no errors, insert task into database.

    $db = getDatabase();
    $sql = $db->prepare("INSERT INTO todo (title, description, user_id) VALUES (?, ?, ?)");

    $values = [
        $title,
    $description,
        $user_id
        ];
    $sql->execute($values);

    redirect("Todo/Tasks/" . getSignedInUser()->getID());
}

}
