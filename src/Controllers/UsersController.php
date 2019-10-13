<?php

namespace App\Controllers;

use App\Utils\Database;

class UsersController extends AbstractBaseController
{
    public function canAccess($action, $parameters = [])
    {
       return true;
    }
    
    public function index()
    {
    
    }
    
    public function register()
    {
        if(count($_POST)) {
            $db = Database::getInstance();
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = $db->prepare("INSERT INTO user (username, password, email_address) VALUES (?,?,?)");

            $values = [
                $_POST['username'],
                $_POST['password'],
                $_POST['email_address']
            ];

            $sql->execute($values);


            $_SESSION['username'] = $_POST['username'];

            redirect("");
        }

        view('register');
    }
    
    public function signin()
    {
        view('signin');
    }
}
