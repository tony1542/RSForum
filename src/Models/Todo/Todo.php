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

    public function __construct($user_id = null)
{
    if(!$user_id){
        return;
}
    //Create an instance of our DB, then PDO query db for task based off user_id
    $instance = getDatabase();
    $stmt = $instance->prepare('SELECT * FROM todo WHERE user_id =?');
    $stmt->execute([$user_id]);
    $value = $stmt->fetchAll(PDO::FETCH_ASSOC);



    if (!$value || !is_array($value)) {
        return;
    }
    $todos = [];;
$i = 0;
    foreach($value as $task[$i]){
         $this->task_id = $task[$i]['task_id'];
         $this->title = $task[$i]['title'];
         $this->description = $task[$i]['description'];
         $this->is_completed = $task[$i]['is_completed'];
         $this->user_id = $user_id;
         $todos[] = $task[$i];
         $i++;
    }
    return $todos;
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

public function add($user_id, $title, $description)
{
    if(!count($_POST)) {
        view($this->getIncludePrefix() . 'profile');
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
}

}
