<?php


namespace App\Models\Todo;

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

    public function __construct($user_id = 1)
{
    if(!$user_id){
        return;
}
    //Create an instance of our DB, then PDO query db for task based off user_id
    $instance = getDatabase();
    $stmt = $instance->prepare('SELECT * FROM todo WHERE user_id =?');
    $stmt->execute([$user_id]);
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$values || !is_array($values)) {
        return;
    }

    $value = $values[0];
    $this->task_id = $value['task_id'];
    $this->title = $value['title'];
    $this->description = $value['description'];
    $this->is_completed = $value['is_completed'];
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
public static function show($user_id)
{
    $db = getDatabase();
    $sql = $db->prepare("SELECT * FROM todo WHERE user_id =?");
    $sql->execute([$user_id]);
    $values = $sql->fetchAll(PDO::FETCH_ASSOC);

    $todos = [];
    foreach($values as $task){
        $todos[] = new self($task['user_id']);
    }
   // dd($todos);
    return $todos;
}


}
