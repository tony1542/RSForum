<?php

namespace App\Controllers;

use App\Utils\CrystalMathLabs\Api;
use App\Utils\Http\Request;
use App\Models\User;
use App\Utils\Input\Sanitizer;
use App\Utils\Http\Session;
use App\Utils\Runescape\Levels;
use PDO;
class UsersController extends AbstractBaseController
{
    public function canAccess($action, $parameters = [])
    {
        $signed_in_user = getSignedInUser();
        $is_user_signed_in = $signed_in_user->getID() > 0;
        $same_user_as_requesting = $signed_in_user->getID() === Request::getID();
        
        switch ($action) {
            case 'members':
                return $is_user_signed_in;
            case 'logout':
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
    
    public function register()
    {
        // If nothing is in $_POST, just show the register form
        if (!count($_POST)) {
            view('register');
        }

        // Sanitizing our user input before validating
        $username = Sanitizer::sanitize($_POST['username']);
        $email_address = Sanitizer::sanitize($_POST['email_address']);
        $password = Sanitizer::sanitize($_POST['password']);
        $password_confirm = Sanitizer::sanitize($_POST['password_confirm']);
        $form_errors = [];
        
        if (!$username) {
            $form_errors[] = 'Please enter a username';
        }
        
        if (strlen($username) < 5 || strlen($username) > 12) {
            $form_errors[] = 'Please enter a username between 5 and 12 characters long';
        }

        $db = getDatabase();
        $sql = $db->prepare('SELECT email_address FROM user WHERE email_address =?');
        $sql->execute([$email_address]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        if ($value) {
            $value = $value[0];
            $compare_email = $value['email_address'];
        
            if ($compare_email === $email_address) {
                $form_errors[] = 'Sorry, that email has been taken by another user, please try again';
            }
        }

        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $form_errors[] = 'Please enter a valid email address';
        }
        
        if (!$password) {
            $form_errors[] = 'Please enter a password';
        }
        
        if (!$password_confirm) {
            $form_errors[] = 'Please fill out \'Confirm Password\'';
        }
        
        if ($password != $password_confirm) {
            $form_errors[] = 'Your passwords do not match';
        }
        
        // If we have found any errors, re-show the form with them
        if (count($form_errors)) {
            view('register', [
                'errors' => $form_errors
            ]);
        }
        
        // If we have gotten this far, it means there were no errors when validating. Insert the user into the database
        $db = getDatabase();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $db->prepare('INSERT INTO user (username, password, email_address) VALUES (?, ?, ?)');
        
        $values = [
            $username,
            $password,
            $email_address
        ];
        
        $sql->execute($values);
        $user_id = $db->lastInsertId();
        setSignedInUser(new User($user_id));
        
        redirect('');
    }

    public function signIn()
    {
        if (!count($_POST)) {
            view('signin');
        }
        
        $email_address = Sanitizer::sanitize($_POST['email_address']);
        $password = Sanitizer::sanitize($_POST['password']);
        $form_error = [];
    
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
        }
    
        // if the code gets this far, there are no errors.
        User::login($email_address, $password);
    
        redirect('');
    }
    
    public function details()
    {
        $user_id = Request::getID();
        $user = new User($user_id);
        view('profile', ['user' => $user]);
    }
    
    public function logout()
    {
        $user = new User(Request::getID());
        $user->logout();
        redirect('');
    }
    
    public function members()
    {
        view('members', [
            'members' => User::getMembers()
        ]);
    }
    
    public function update()
    {
        $post_values = Request::getPostValues();
        $new_username = $post_values['username'];
        
        $user_id = Request::getID();
        $user = new User($user_id);
        $user->update($new_username);
        
        redirect("User/Details/" . $user->getID());
    }
}
