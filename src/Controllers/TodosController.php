<?php

namespace App\Controllers;

use App\Models\Todo\TodoCollector;
use App\Models\User\User;
use App\Utils\Http\Request;
use App\Models\Todo\Todo;
use App\Utils\Input\Sanitizer;

class TodosController extends AbstractBaseController
{
    protected function getIncludePrefix(): string
    {
        return 'user/';
    }
    
    public function index() {}

    public function canAccess($action, $parameters = []): bool
    {
        $signed_in_user = getSignedInUser();
        $same_user_as_requesting = $signed_in_user->getID() === Request::getID();

        switch ($action) {
            case 'add':
            case 'delete':
            case 'edit':
            case 'complete':
                return $same_user_as_requesting;
            default:
                return true;
        }
    }

    public function tasks()
    {
        $user_id = Request::getID();
        $user = new User($user_id);
        $todo = new TodoCollector($user_id);
        view($this->getIncludePrefix() . 'task', [
            'user' => $user,
            'todo' => $todo->getTasks()
        ]);
    }

    public function edit()
    {
        if (!count($_POST)) {
            view($this->getIncludePrefix() . 'task');
        }
        
        $title = Sanitizer::sanitize($_POST['title']);
        $description = Sanitizer::sanitize($_POST['description']);
        $complete = $_POST['complete'];
        $task_id = $_POST['hidden_edit'];
        $user_id = Request::getID();
        
        $user = new user($user_id);
        $todo = new TodoCollector($user_id);
        
        $errors = [];
        
        if (!$title) {
            $errors[] = 'Edit Canceled; User did not enter a title';
        }
        
        if (!$description) {
            $errors[] = 'Edit Canceled; User did not enter a description';
        }
        
        if (count($errors)) {
            view($this->getIncludePrefix() . 'task', [
                'errors' => $errors,
                'user' => $user,
                'todo' => $todo->getTasks()
            ]);
        }
        
        Todo::edit($task_id, $user_id, $title, $description, $complete);
    }

    public function delete()
    {
        if (!count($_POST)) {
            view($this->getIncludePrefix() . 'task');
        }
        
        $user_id = Request::getID();
        $task_id = $_POST['hidden_delete'];
        Todo::delete($user_id, $task_id);
    }

    public function complete()
    {
        if (!count($_POST)) {
            view($this->getIncludePrefix() . 'task');
        }
        
        $user_id = Request::getID();
        $task_id = $_POST['hidden_complete'];
        Todo::complete($user_id, $task_id);
    }

    public function add()
    {
        $errors = [];
        if (!$_POST['title']) {
            $errors[] = 'Please enter a title';
        }
        
        if (!$_POST['description']) {
            $errors[] = 'Please enter a description';
        }
        
        $user_id = Request::getID();
        $user = new User($user_id);
        $todo = new TodoCollector($user_id);

        if (count($errors)) {
            view($this->getIncludePrefix() . 'task', [
                'errors' => $errors,
                'user'   => $user,
                'todo'   => $todo->getTasks()
            ]);
        }
    
        $title = Sanitizer::sanitize($_POST['title']);
        $description = Sanitizer::sanitize($_POST['description']);
        $date = date('Y-m-d');
        
        Todo::add($title, $description, $date, $user_id);
    }
}
