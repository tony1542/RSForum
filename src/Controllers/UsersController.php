<?php

namespace App\Controllers;

use App\Utils\Database;
use App\Utils\Input;

class UsersController extends AbstractBaseController {
    public function canAccess($action, $parameters = [])
    {
        return true;
    }
    
    public function index()
    {
    
    }
    
    public function register()
    {
        // If nothing is in $_POST, just show the register form
        if (!count($_POST)) {
            view('register');
        }
        
        // Sanitizing our user input before validating
        $username = Input::sanitize($_POST["username"]);
        $email_address = Input::sanitize($_POST["email_address"]);
        $password = Input::sanitize($_POST["password"]);
        $password_confirm = Input::sanitize($_POST["password_confirm"]);
        $form_errors = [];
        
        if (!$username) {
            $form_errors[] = "Please enter a username";
        }
        
        if (strlen($username) < 5 || strlen($username) > 12) {
            $form_errors[] = 'Please enter a username between 5 and 12 characters long';
        }
        
        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $form_errors[] = 'Please enter a valid email address';
        }
        
        if (!$password) {
            $form_errors[] = 'Please enter a password';
        }
        
        if (!$password_confirm) {
            $form_errors[] = "Please fill out \"Confirm Password\"";
        }
        
        if ($password != $password_confirm) {
            $form_errors[] = "Your passwords do not match!";
        }
        
        // If we have found any errors, re-show the form with them
        if (count($form_errors)) {
            view('register', [
                'errors' => $form_errors
            ]);
        }
        
        // If we have gotten this far, it means there were no errors when validating. Insert the user into the database
        $db = Database::getInstance();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $db->prepare("INSERT INTO user (username, password, email_address) VALUES (?, ?, ?)");
        
        $values = [
            $username,
            $password,
            $email_address
        ];
        
        $sql->execute($values);
        $_SESSION['username'] = $username;
        redirect("");
    }
    
    // TODO implement validation
    public function signin()
    {
        if (count($_POST)) {
            $email_address = Input::sanitize($_POST["email_address"]);
            $password = Input::sanitize($_POST["password"]);
            
            if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                $form_error[] = 'Please enter a valid email address';
            }
            if (!$password) {
                $form_error[] = 'Please enter a password';
            }
            if (count($form_error)) {
                view('signin', [
                    'errors' => $form_error
                ]);
               //if the code gets this far, there are no errors.
                    //TODO login code, boyyyy

            }
        }
        view('signin');
    }
}
