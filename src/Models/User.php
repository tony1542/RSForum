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
    private $password = '';
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
        $this->first_name = $values['first_name'];
        $this->last_name = $values['last_name'];
        $this->logged_in = $values['logged_in'];
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
            view('signin', [
                'errors' => 'Your email or password is incorrect'
            ]);
        }
    
        // If $value has an array with stuff in that array, step in to grab them
        $value = $value[0];
        
        // Nested password verify into $value otherwise undefined index occurs since $password doesnt exist unless $value is correct
        if (!password_verify($password, $value['password'])) {
            $data_error[] = 'Your password is incorrect.';
        }
        $username = $value['username'];
        $_SESSION['user_id'] = $value['user_id'];
        Session::set('username', $username);
        Session::set('email_address', $email_address);
        Session::set('password', $password);

        $sql = $db->prepare("UPDATE user SET logged_in = 1 WHERE email_address = '{$_SESSION['email_address']}'");
        $sql->execute();
        redirect("User/details/{$_SESSION['user_id']}");
    }
}
