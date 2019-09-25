<?php

namespace App\Controllers;

use App\Http\Request;
use App\Utils\Database;

class UsersController extends AbstractBaseController
{
    public function canAccess($action, $parameters = []) {
       return true;
    }
    
    public function index()
    {
    
    }
    
    // TODO, insert a user in the DB when they register & redirect them home when it is done.
    // TODO (use the function 'redirect()' to do so, it's a helper function in helper.php
    // TODO also use 'password_hash' before inserting the password in the db
    // @see https://www.php.net/manual/en/function.password-hash.php
    public function register()
    {
        // use the following lines to print out everything in the request to help debug
        //$request = new Request();
        //$request->dump();
        //die;
        if(isset($_POST['save']))
        {
            $DB = Database::getInstance();
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = $DB->prepare("INSERT INTO user (username, password, email_address) VALUES (?,?,?)");
            $sql->execute([
                $_POST['username'],
                $_POST['password'],
                $_POST['email_address'],
            ]);
            redirect("");
        }
        view('register');
    }
    public function signin()
    {
        view('signin');
    }
}
