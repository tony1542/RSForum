<?php

namespace App\Models\User;

use App\Utils\Http\Request;
use Carbon\Carbon;
use PDO;
use App\Utils\Http\Session;

class User
{
    protected string $username = '';
    protected string $email_address = '';
    protected string $user_id = '';
    protected bool $logged_in = false;
    protected bool $admin = false;
    
    protected UserSkills $skills;
    protected UserAccolades $accolades;
    
    public function __construct($user_id = 0)
    {
        if ($user_id) {
            $this->load($user_id);
        }
    }
    
    public function load(int $user_id = 0): void
    {
        if (!$user_id) {
            $user_id = (int) $this->getID();
        }
        
        // Creating an instance of our db connection, then using a pdo to query our db for a user_id match
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT user_id, username, email_address, logged_in, admin
                                            FROM user
                                         WHERE user_id = ?');
        $statement->execute([$user_id]);
        $values = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$values || !is_array($values)) {
            return;
        }
        
        $this->username = $values['username'];
        $this->email_address = $values['email_address'];
        $this->user_id = $user_id;
        $this->logged_in = $values['logged_in'];
        $this->admin = $values['admin'];
    
        $this->skills = new UserSkills($this->getUsername());
        $this->accolades = new UserAccolades($this->getUsername());
    }
    
    public function getUsername(): string
    {
        return $this->username;
    }
    
    public function getEmail(): string
    {
        return $this->email_address;
    }
    
    public function getTotalLevel(): int
    {
        return $this->skills->getTotalLevel();
    }
    
    public function getID(): string
    {
        return $this->user_id;
    }
    
    public function getSkills(): array
    {
        return $this->skills->getSkills();
    }
    
    public function getAccolades(): array
    {
        return $this->accolades->getAccolades();
    }
    
    public function isAdmin(): bool
    {
        return $this->admin;
    }
    
    public static function login(string $email_address, string $password): void
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
    
    public function logout(): void
    {
        $db = getDatabase();
        $sql = $db->prepare("UPDATE user SET logged_in = 0 WHERE email_address = ?");
        $sql->execute([$_SESSION['email_address']]);
        Session::destroy();
    }
    
    /**
     * @return User[]
     */
    public static function getMembers(): array
    {
        $database = getDatabase();
        $sql = $database->query("SELECT user_id, u.username, us.date_added
                                FROM user u
                                LEFT JOIN user_skills us ON u.username = us.username AND us.skill_name = 'Overall'");
        $members = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $users = [];
        foreach ($members as $member) {
            $users[] = [
                'user_id'     => $member['user_id'],
                'username'    => $member['username'],
                'last_active' => $member['date_added'] ? Carbon::create($member['date_added'])->format('m/d/y') : 'N/A'
            ];
        }
        
        return $users;
    }
    
    public function update(string $username): bool
    {
        $database = getDatabase();
        
        // Check for existing usernames
        $sql = $database->prepare("SELECT COUNT(*) AS count FROM user WHERE username = ?");
        $sql->execute([$username]);
        $results = $sql->fetch(PDO::FETCH_ASSOC);

        if ((int) $results['count'] !== 0) {
            return false;
        }
        
        // If we are all good, update the database
        $sql = $database->prepare("UPDATE user SET username = ? WHERE user_id = ?");
        $sql->execute([$username, Request::getID()]);
        
        $this->load();
        
        return true;
    }

    public static function verifyUsername(string $username): array
    {
        $errors = [];
        
        if (!$username) {
            $errors[] = 'Enter a username';
        }
        
        if (strlen($username) > 12) {
            $errors[] = 'Username cannot be longer than 12 characters';
        }
    
        if (!preg_match('/^[-\w ]+$/', $username)) {
            $errors[] = 'Username can only contain numbers, letters, or spaces';
        }
        
        return $errors;
    }
}
