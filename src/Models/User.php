<?php

namespace App\Models;

class User
{
    protected $username ='';
    protected $email_address = '';
    protected $first_name = '';
    protected $last_name = '';
    private $password = '';
    protected $user_id = '50';

    public function __construct($user_id)
    {
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT * FROM user WHERE user_id =?');
        $statement->bindParam(1, $username);
        $statement->execute([$user_id]);
        dump($statement->fetchAll(PDO::FETCH_ASSOC));
    }
}
