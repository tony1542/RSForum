<?php



class User
{
    protected $username ='';
    protected $email_address = '';
    protected $first_name = '';
    protected $last_name = '';
    private $password = '';
    protected $user_id = '';

    public function __construct($username, $email_address, $first_name, $last_name, $password, $user_id)
    {
    $this->username = $username;
    $this->email = $email_address;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->password = $password;
    $this->user_id = $user_id;
    }
}