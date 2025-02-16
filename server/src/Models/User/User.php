<?php

namespace App\Models\User;

use App\Utils\Http\Request;
use App\Utils\Http\Session;
use App\Utils\Runescape\AccountType;
use Carbon\Carbon;
use PDO;

class User
{
    protected string $username = '';
    protected string $email_address = '';
    protected string $user_id = '';
    protected int $account_type_id = 0;
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
            $user_id = (int)$this->getID();
        }

        $values = $this->getUserFromDB($user_id);

        if (!$values || !is_array($values)) {
            return;
        }

        $this->username = $values['username'];
        $this->email_address = $values['email_address'];
        $this->user_id = $user_id;
        $this->account_type_id = (int)$values['account_type_id'];
        $this->logged_in = $values['logged_in'];
        $this->admin = $values['admin'];

        $this->skills = new UserSkills($this->getUsername(), $this->account_type_id);
        $this->accolades = new UserAccolades($this->getUsername(), $this->account_type_id);
    }

    public function getUserFromDB($user_id): array
    {
        $instance = getDatabase();
        $statement = $instance->prepare('SELECT user_id, username, email_address, logged_in, admin, account_type_id
                                            FROM user
                                         WHERE user_id = ?');
        $statement->execute([$user_id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getID(): string
    {
        return $this->user_id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $email_address
     * @param string $password
     *
     * @return bool
     */
    public static function login(string $email_address, string $password): bool
    {
        $db = getDatabase();
        $sql = $db->prepare('SELECT * FROM user WHERE email_address =?');
        $sql->execute([$email_address]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (!count($value)) {
            return false;
        }

        if ($value) {
            $value = $value[0];
            if (!password_verify($password, $value['password'])) {
                return false;
            }
        }

        $user = new User($value['user_id']);
        setSignedInUser($user);

        $sql = $db->prepare("UPDATE user SET logged_in = 1 WHERE email_address =?");
        $email = getSignedInUser()->email_address;
        $sql->execute([$email]);

        return true;
    }

    public static function getMembers(): array
    {
        $database = getDatabase();
        $sql = $database->query("SELECT u.username,
                                (SELECT us.date_added
                                FROM user_skills us
                                WHERE username = u.username
                                  AND us.skill_name = 'Overall'
                                ORDER BY us.date_added DESC
                                LIMIT 1) AS date_added
                                FROM user u");
        $members = $sql->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($members as $member) {
            $users[] = [
                'username' => $member['username'],
                'last_active' => $member['date_added'] ? Carbon::create($member['date_added'])->format('m/d/y') : 'N/A'
            ];
        }

        return $users;
    }

    public function verifyUsername(string $username): array
    {
        $errors = [];

        if ($username === getSignedInUser()->getUsername()) {
            return [];
        }

        if (!$username) {
            $errors[] = 'Enter a username';
        }

        if (strlen($username) > 12) {
            $errors[] = 'Username cannot be longer than 12 characters';
        }

        if (!preg_match('/^[-\w ]+$/', $username)) {
            $errors[] = 'Username can only contain numbers, letters, or spaces';
        }

        if ($this->getUsernameCount($username) !== 0) {
            $errors[] = 'Username already exists';
        }

        return $errors;
    }

    public function getUsernameCount($username): int
    {
        $database = getDatabase();
        $sql = $database->prepare("SELECT COUNT(*) AS count FROM user WHERE username = ?");
        $sql->execute([$username]);

        return (int) $sql->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function getEmail(): string
    {
        return $this->email_address;
    }

    public function getTotalLevel(): int
    {
        return $this->skills->getTotalLevel();
    }

    public function getAccountTypeText(): string
    {
        return AccountType::PLAYER_TYPE_TEXT[$this->getAccountTypeID()];
    }

    public function getAccountTypeID(): int
    {
        return $this->account_type_id;
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

    public function logout(): void
    {
        $email = getSignedInUser()->email_address;
        $db = getDatabase();
        $sql = $db->prepare("UPDATE user SET logged_in = 0 WHERE email_address =?");
        $sql->execute([$email]);
        Session::destroy();
    }

    public function update(string $username, int $account_type_id): bool
    {
        $database = getDatabase();

        $sql = $database->prepare("UPDATE user SET username = ?, account_type_id = ? WHERE user_id = ?");
        $sql->execute([$username, $account_type_id, Request::getID()]);

        $this->load();

        return true;
    }
}
