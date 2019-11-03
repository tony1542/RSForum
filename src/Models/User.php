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

    public function __construct($user_id)
    {
        //Creating an instance of our db connection, then using a pdo to query our db for a user_id match
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT * FROM user WHERE user_id =?');
        $statement->execute([$user_id]);
        $values = $statement->fetchAll(PDO::FETCH_ASSOC);

        $values = ($values[0]);//step into the array to get to the values we want
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
    public static function login($email_address, $password)
    {
        $data_error = [];
        $db = getDatabase();
        $sql = $db->prepare('SELECT * FROM user WHERE email_address =?');
        $sql->execute([$email_address]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($value) {//If $value has an array with stuff in that array, step in to grab them
            $value = ($value[0]);
            //Nested password verify into $value otherwise undefined index occurs since $password doesnt exist unless $value is correct.
            // if I use (!password_verify) it enters if statement, without the ! it skips this entirely

            if (!password_verify($password, $value['password'])){
                //if $password is false, they're too tall to ride.
                $data_error[] = 'Your password is incorrect.';
            }
        } else {
            // else if value is an empty array, echo an error which means they failed to login
            $data_error[] = 'Your email or password is incorrect';
        }
        if (count($data_error)) {
            //send them back to signin with some helpful error messages.
            view('signin', [
                'errors' => $data_error
            ]);
        }
        $username = $value['username'];
        // $_SESSION['username'] = $username; different way to do this found below
        Session::set('username',$username);
        redirect('');
    }
}
