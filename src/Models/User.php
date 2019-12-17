<?php

namespace App\Models;

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

    public function __construct($user_id)
    {
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
        //$this->first_name = $values['first_name']; Since these do not exist in db yet, they create an undefined index if left uncommented.
        //$this->last_name = $values['last_name'];
        $this->logged_in = $values['logged_in'];
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getEmail()
    {
        return $this->email_address;
    }
    
    public function getHashedPass()
    {
        return $this->password;
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
        $username = $value['username'];
        $_SESSION['user_id'] = $value['user_id'];
        Session::set('username', $username);
        Session::set('email_address', $email_address);

        $sql = $db->prepare("UPDATE user SET logged_in = 1 WHERE email_address = '{$_SESSION['email_address']}'");
        $sql->execute();
        redirect("User/details/{$_SESSION['user_id']}");
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
        $sql = $database->prepare('SELECT user_id FROM user');
        $sql->execute();
        $members = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $users = [];
        foreach ($members as $member) {
            $users[] = new self($member['user_id']);
        }
        
        return $users;
    }
}
