<?php

namespace App\Controllers;

use App\Utils\Http\Request;
use App\Models\Todo\Todo;
use App\Utils\Input\Sanitizer;
use App\Utils\Http\Session;
use PDO;

class TodosController extends AbstractBaseController
{
    protected function getIncludePrefix()
    {
        return 'todo/';
    }

    public function canAccess($action, $parameters = [])
    {
        return true;
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
            view($this->getIncludePrefix() . 'profile');
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

        //if any errors come up, show the form with them.
        if (count($errors)) {
            view($this->getIncludePrefix() . 'profile', [
                'errors' => $errors
            ]);
        }
    }
    public function show()
    {

    }
}