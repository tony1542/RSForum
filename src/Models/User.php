<?php

namespace App\Models;

use App\Utils\CrystalMathLabs\Api;
use App\Utils\Database\Connection;
use App\Utils\Http\Request;
use App\Utils\Runescape\Levels;
use PDO;
use App\Utils\Http\Session;

class User
{
    protected $username ='';
    protected $email_address = '';
    protected $first_name = '';
    protected $last_name = '';
    protected $password = '';
    protected $user_id = '';
    protected $logged_in = '';
    protected $skills = [];
    protected $total_level = 0;
    
    public function __construct($user_id = 0)
    {
        if (!$user_id) {
            return;
        }
        
        // Creating an instance of our db connection, then using a pdo to query our db for a user_id match
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT * FROM user WHERE user_id =?');
        $statement->execute([$user_id]);
        $values = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$values || !is_array($values)) {
            return;
        }
        
        $values = $values[0];
        $this->username = $values['username'];
        $this->email_address = $values['email_address'];
        $this->password = $values['password'];
        $this->user_id = $user_id;
        $this->logged_in = $values['logged_in'];
        
        $this->skills = Api::getStatsForPlayer($this->getUsername());
        $this->total_level = Levels::getTotalLevel($this->getSkills());
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getEmail()
    {
        return $this->email_address;
    }
    
    public function getTotalLevel()
    {
        return $this->total_level;
    }
    
    public function getSkills()
    {
        return $this->skills;
    }
    
    public function getID()
    {
        return $this->user_id;
    }
    
    public static function login($email_address, $password)
    {
        $data_error = [];
        $db = getDatabase();
        $sql = $db->prepare('SELECT * FROM user WHERE email_address =?');
        $sql->execute([$email_address]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        // If value isn't set or isn't an array, their credentials were wrong
        if (!$value || !is_array($value)) {
           $data_error[] = "Your Email or Password is incorrect";
        }
    
        // If $value has an array with stuff in that array, step in to grab them
        if ($value) {
            $value = $value[0];
            if (!password_verify($password, $value['password'])) {
                $data_error[] = 'Your Email or Password is incorrect.';
            }
        }
        
        if (count($data_error)) {
            view('signin', [
                'errors' => $data_error
            ]);
        }
        
        $user = new User($value['user_id']);
        setSignedInUser($user);
        
        $sql = $db->prepare("UPDATE user SET logged_in = 1 WHERE email_address = ?");
        $sql->execute([$_SESSION['email_address']]);
        
        redirect("User/Details/" . getSignedInUser()->getID());
    }
    
    public function logout()
    {
        $db = getDatabase();
        $sql = $db->prepare("UPDATE user SET logged_in = 0 WHERE email_address = ?");
        $sql->execute([$_SESSION['email_address']]);
        session_destroy();
    }
    
    /**
     * Function returns an active list of members
     * Note: will convert database records into User objects
     *
     * @return User[]
     */
    public static function getMembers()
    {
        $database = getDatabase();
        $sql = $database->query("SELECT user_id FROM user");
        $members = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $users = [];
        foreach ($members as $member) {
            $users[] = new self($member['user_id']);
        }
        
        return $users;
    }
    
    public function update($username)
    {
        $database = getDatabase();
        $sql = $database->prepare("UPDATE user SET username = ? WHERE user_id = ?");
        $sql->execute([$username, Request::getID()]);
    }
    
    /**
     * Verifies a username matches Runescape's restraints
     *
     * @param string $username
     *
     * @return array
     */
    public static function verifyUsername($username)
    {
        $errors = [];
        
        if (!$username) {
            $errors[] = 'Enter a username';
        }
        
        if (strlen($username) > 12) {
            $errors[] = 'Username cannot be longer than 12 characters';
        }
    
        if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9-_ ]*[a-zA-Z0-9]$/', $username)) {
            $errors[] = 'Username can only contain numbers, letters, or spaces';
        }
        
        return $errors;
    }
}
