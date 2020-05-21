<?php

namespace App\Controllers;

use App\Models\Task\TaskCollector;
use App\Models\User\User;
use App\Utils\Http\Request;
use App\Models\Task\Task;
use App\Utils\Input\Sanitizer;

class TasksController extends AbstractBaseController
{
    protected function getModelClass(): string
    {
        return TaskCollector::class;
    }
    
    protected function getModel(): TaskCollector
    {
        return $this->model;
    }
    
    protected function toView(string $view, array $parameters = []): void
    {
        $return_array = [];
    
        $user_id = Request::getID();
        $user = new User($user_id);
        
        $return_array['user'] = $user;
        $return_array['tasks'] = $this->getModel()->getTasks();
        
        $return_array = array_merge($parameters, $return_array);
        view($this->getIncludePrefix() . $view, $return_array);
    }
    
    // TODO this shouldn't be the user folder - should be a task folder
    protected function getIncludePrefix(): string
    {
        return 'user/';
    }
    
    public function index(): void {}

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

    public function all(): void
    {
        $this->toView('task');
    }

    public function edit(): void
    {
        if (!count($_POST)) {
            $this->toView('task');
        }
        
        $title = Sanitizer::sanitize($_POST['title']);
        $description = Sanitizer::sanitize($_POST['description']);
        $complete = $_POST['complete'];
        $task_id = $_POST['hidden_edit'];
        $user_id = Request::getID();
        
        $errors = [];
        
        if (!$title) {
            $errors[] = 'Edit canceled; user did not enter a title';
        }
        
        if (!$description) {
            $errors[] = 'Edit canceled; user did not enter a description';
        }
        
        if (count($errors)) {
            $this->toView('task');
        }
        
        Task::edit($task_id, $user_id, $title, $description, $complete);
    }

    public function delete(): void
    {
        if (!count($_POST)) {
            $this->toView('task');
        }
        
        $user_id = Request::getID();
        $task_id = $_POST['hidden_delete'];
        
        Task::delete($user_id, $task_id);
    }

    public function complete(): void
    {
        if (!count($_POST)) {
            $this->toView('task');
        }
        
        $user_id = Request::getID();
        $task_id = $_POST['hidden_complete'];
        
        Task::complete($user_id, $task_id);
    }

    public function add(): void
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
        $task_collector = new TaskCollector($user_id);

        if (count($errors)) {
            $this->toView('task', [
                'errors' => $errors
            ]);
        }
    
        $title = Sanitizer::sanitize($_POST['title']);
        $description = Sanitizer::sanitize($_POST['description']);
        $date = date('Y-m-d');
        
        Task::add($title, $description, $date, $user_id);
    }
}
