<?php

namespace App\Controllers;

use App\Utils\Http\Request;
use App\Models\User\User;
use App\Utils\Input\Sanitizer;
use App\Utils\Http\Session;
use App\Utils\Runescape\Skills;
use PDO;

class UsersController extends AbstractBaseController
{
    protected function getIncludePrefix(): string
    {
        return 'user/';
    }
    
    public function canAccess(string $action, array $parameters = []): bool
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
    
    public function index(): void {}
    
    public function register(): void
    {
        // If nothing is in $_POST, just show the register form
        if (!count($_POST)) {
            view($this->getIncludePrefix() . 'register');
        }

        // Sanitizing our user input before validating
        $username = Sanitizer::sanitize($_POST['username']);
        $email_address = Sanitizer::sanitize($_POST['email_address']);
        $password = Sanitizer::sanitize($_POST['password']);
        $password_confirm = Sanitizer::sanitize($_POST['password_confirm']);
        
        $form_errors = User::verifyUsername($username);

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
        
        if ($password !== $password_confirm) {
            $form_errors[] = 'Your passwords do not match';
        }
        
        // If we have found any errors, re-show the form with them
        if (count($form_errors)) {
            view($this->getIncludePrefix() . 'register', [
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

    public function signIn(): void
    {
        if (!count($_POST)) {
            view($this->getIncludePrefix() . 'signin');
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
            view($this->getIncludePrefix() . 'signin', [
                'errors' => $form_error
            ]);
        }
    
        // if the code gets this far, there are no errors.
        User::login($email_address, $password);
    
        redirect('');
    }
    
    public function details(): void
    {
        view($this->getIncludePrefix() . 'profile', $this->getDetails());
    }
    
    protected function getDetails(): array
    {
        $user_id = Request::getID();
        $user = new User($user_id);
    
        $skills = $user->getSkills();
        $skills_array = [];
        foreach ($skills as $key => $row) {
            $skills_array[] = [
                'src'        => Skills::getSkillIconFromIndex($row['skill_index']),
                'skill_name' => $row['skill_name'],
                'exp'        => $row['exp'],
                'level'      => $row['level'],
                'rank'       => $row['rank']
            ];
        }
    
        return [
            'user'        => $user,
            'skills'      => $skills_array,
            'show_skills' => count($skills_array) > 0
        ];
    }
    
    public function logout(): void
    {
        getSignedInUser()->logout();
        redirect('');
    }
    
    public function members(): void
    {
        view($this->getIncludePrefix() . 'members', [
            'members' => User::getMembers()
        ]);
    }
    
    public function update(): void
    {
        $post_values = Request::getPostValues();

        if (!$post_values) {
            redirect("User/Details/" . Request::getID());
        }
        
        $details = $this->getDetails();
        
        $user_id = Request::getID();
        $user = new User($user_id);
    
        $new_username = $post_values['username'];
        $errors = User::verifyUsername($new_username);
        if (count($errors)) {
            view($this->getIncludePrefix() . 'profile', array_merge(['errors' => $errors], $details));
        }
        
        $success = $user->update($new_username);
        
        if (!$success) {
            view($this->getIncludePrefix() . 'profile', array_merge(['errors' => ['The username ' . $new_username . ' is already taken']], $details));
        }
        
        redirect("User/Details/" . $user->getID());
    }
}
