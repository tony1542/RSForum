<?php

namespace App\Models;
use PDO;

class User
{
    protected $username ='';
    protected $email_address = '';
    protected $first_name = '';
    protected $last_name = '';
    private $password = '';
    protected $user_id = '';

    public function __construct($user_id)
    {
        //Creating an instance of our db connection, then using a pdo to query our db for a user_id match
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT * FROM user WHERE user_id =?');
        $statement->execute([$user_id]);
        $values = $statement->fetchAll(PDO::FETCH_ASSOC);



        $values = ($values[0]);
        $username = $values['username'];
        $email_address = $values['email_address'];
        $password = $values['password'];
        $user_id = $values['user_id'];


        $this->username = $username;
        $this->email_address = $email_address;
        $this->password = $password;
        $this->user_id = $user_id;
        //$this->first_name = $first_name; if we ever use either of these variables, assign them above and uncomment to use them @ user obj
        // $this->last_name = $last_name;
    }
    public function login($email_address, $password)
    {

        $db = getDatabase();
        $sql = $db->prepare('SELECT * FROM user WHERE email_address =?');
        $sql->execute([$email_address]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);
        $value = ($value[0]);

        $sql->fetchAll(PDO::FETCH_ASSOC);

        if (password_verify($password, $value['password'])){//passwords are the same..
            //commence the log-in
            $user_id = $value['user_id'];

            $user = new User($user_id);

            $_SESSION['username'] = $user->username;
            redirect('');
        }
    }
}
