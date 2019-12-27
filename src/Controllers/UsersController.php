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
        
            if ($compare_email == $email_address) {
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
        Session::set('username',$username);
        $_SESSION['name'] = $username; //Setting name for our homepage welcome message.
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
        if (count($_POST)) {
            return;
        }
        
        $user_id = Request::getID();
        $login_error = [];
        
        if (empty($_SESSION['username']) || empty($_SESSION['email_address'])) {
            $login_error[] = 'Please Sign-In to see this page.';
        } elseif ($user_id != $_SESSION['user_id']) {
            $login_error[] = 'That page is not for you to see';
        }
        
        if (count($login_error)) {
            view('home_page', [
                'errors' => $login_error
            ]);
        }
        
        view('profile', ['user' => new User($user_id)]);
    
    }
    
    public function logout()
    {
        $user = new User(Request::getID());
        redirect('');
    }
    
    public function members()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('');
        }
        
        view('members', [
            'members' => User::getMembers()
        ]);
    }
    
    public function update()
    {
    
    }
}
