<?php

namespace App\Controllers;

use App\Models\Todo\TodoCollector;
use App\Models\User\User;
use App\Utils\Http\Request;
use App\Models\Todo\Todo;
use App\Utils\Input\Sanitizer;
use App\Utils\Http\Session;
use PDO;

class TodosController extends AbstractBaseController
{
    protected function getIncludePrefix()
    {
        return 'user/';
    }

    public function canAccess($action, $parameters = [])
    {
        $signed_in_user = getSignedInUser();
        $is_user_signed_in = $signed_in_user->getID() > 0;
        $same_user_as_requesting = $signed_in_user->getID() === Request::getID();

        switch ($action) {
            case 'members':
            case 'logout':
                return $is_user_signed_in;
            case 'update':
            case 'details':
                return $is_user_signed_in && $same_user_as_requesting;
            default:
                return true;
        }
    }
    public function index()
    {

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

    public function update()
    {

    }
    public function delete()
    {
    }
    public function add()
    {
        if(!count($_POST)) {
            view($this->getIncludePrefix() . 'task');
        }
        //Sanatize user input
        $title = Sanitizer::sanitize($_POST['title']);
        $description = Sanitizer::sanitize($_POST['description']);
        $is_completed= false;
        $errors = [];
        if(!$title) {
            $errors[] = 'Please enter a title';
        }
        if(!$description) {
            $errors[] = 'Please enter a description';
        }
        $user_id = Request::getID();
        $user = new User($user_id);
        $todo = new TodoCollector($user_id);

        if (count($errors)) {
            view($this->getIncludePrefix() . 'task', [
                'errors' => $errors,
                'user' => $user,
                'todo' => $todo->getTasks()
            ]);
        }
        Todo::add($title, $description, $user_id);
    }

    public function getData()
    {
        $user_id = Request::getID();
        $user = new User($user_id);
        $todo = new TodoCollector($user_id);

        return [
            'user' => $user,
            'todo' => $todo->getTasks()
        ];
        //If I wanted to call this function but perhaps add to do it, like say our error function, it would look like this.
       // $return_array = $this->getData();
       // $return_array[] = $errors;
    }
}