<?php


namespace App\Models\Todo;

use App\Utils\Http\Request;
use App\Utils\Input\Sanitizer;
use PDO;
use App\Utils\Http\Session;

class Todo
{
    protected string $todo_id='';
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
    $this->todo_id = $value['todo_id'];
    $this->title = $value['title'];
    $this->description = $value['description'];
    $this->is_completed = $value['is_completed'];
    $this->user_id = $user_id;
}
public function getTodoID()
{
    return $this->todo_id;
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
    return $this->is_completed;
}

public function add()
{
    if(!count($_POST)) {
        view($this->getIncludePrefix() . 'profile');
    }

    //if we get this far, no errors, insert task into database.

    $db = getDatabase();
    $sql = $db->prepare("INSERT INTO todo (title, description, is_completed) VALUES (?, ?, ?)");

    $values = [
        $title,
    $description,
    $is_completed
        ];

    $sql->execute($values);
    redirect('/Details');
}
public static function show($user_id)
{
    $db = getDatabase();
    $sql = $db->prepare("SELECT * FROM todo WHERE user_id =?");
    $sql->execute([$user_id]);
    $values = $sql->fetchAll(PDO::FETCH_ASSOC);

    $todos = [];
    foreach($values as $task){
        $todos[] = new self($task['todo_id']);
        $todos[] = new self($task['title']);
        $todos[] = new self($task['description']);
        $todos[] = new self($task['is_complete']);
        $todos[] = new self($task['user_id']);
    }
    return $todos;
}


}
