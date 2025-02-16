<?php

namespace App\Controllers;

use App\Models\User\User;
use App\Utils\Http\JWTAuthenticator;
use App\Utils\Http\Request;
use App\Utils\Input\Sanitizer;
use App\Utils\Runescape\Accolades;
use App\Utils\Runescape\Skills;
use PDO;

class UsersController extends AbstractBaseController
{
    protected User $user_object;

    public function __construct($user_id = 0)
    {
        $this->user_object = new User($user_id);
    }

    public function canAccess(string $action, array $parameters = []): bool
    {
        $signed_in_user = getSignedInUser();
        $is_user_signed_in = $signed_in_user->getID() > 0;
        $same_user_as_requesting = $signed_in_user->getID() === Request::getID();

        return match ($action) {
            'members', 'logout' => $is_user_signed_in,
            'update', 'details' => $is_user_signed_in && $same_user_as_requesting,
            default => true,
        };
    }

    public function index(): void
    {
    }

    public function register(): void
    {
        $parameters = Request::getParameters();

        // Sanitizing our user input before validating
        $username = Sanitizer::sanitize($parameters['username']);
        $emailAddress = Sanitizer::sanitize($parameters['email']);
        $accountTypeId = Sanitizer::sanitize($parameters['accountType']);
        $password = Sanitizer::sanitize($parameters['password']);
        $errors = User::verifyUsername($username);

        $db = getDatabase();
        $sql = $db->prepare('SELECT email_address FROM user WHERE email_address =?');
        $sql->execute([$emailAddress]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($value) {
            $value = $value[0];
            $compare = $value['email_address'];

            if ($compare === $emailAddress) {
                $errors[] = 'That email is already taken';
            }
        }

        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }

        if (!$password) {
            $errors[] = 'Please enter a password';
        }

        // If we have found any errors, re-show the form with them
        if (count($errors)) {
            jsonResponse([
                'errors' => $errors
            ]);
        }

        // TODO move this to the user model
        $db = getDatabase();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $db->prepare('INSERT INTO user (username, password, email_address, account_type_id) VALUES (?, ?, ?, ?)');

        $values = [
            $username,
            $password,
            $emailAddress,
            $accountTypeId
        ];

        $sql->execute($values);
        $userId = $db->lastInsertId();
        setSignedInUser(new User($userId));

        $parameters['id'] = $userId;
        jsonResponse([
            'token' => JWTAuthenticator::generate($parameters)
        ]);
    }

    protected function toJson(string $view, array $parameters = []): void
    {
        $return_array = [];

        if ($this->getUser()->getID()) {
            $return_array['user'] = $this->getUser();

            // Load skills
            $skills = $this->getUser()->getSkills();
            $skills_array = [];
            foreach ($skills as $key => $row) {
                $skills_array[] = [
                    'src' => Skills::getSkillIconFromIndex($row['skill_index']),
                    'skill_name' => $row['skill_name'],
                    'exp' => $row['exp'],
                    'level' => $row['level'],
                    'rank' => $row['rank']
                ];
            }

            $return_array['skills'] = $skills_array;
            $return_array['show_skills'] = count($skills_array) > 0;

            // Load accolades
            $accolades = $this->getUser()->getAccolades();
            $accolades_array = [];
            foreach ($accolades as $key => $row) {
                $accolades_array[] = [
                    'src' => Accolades::getAccoladeIconFromIndex($row['accolade_index']),
                    'accolade_name' => $row['accolade_name'],
                    'score' => $row['score'],
                    'rank' => $row['rank']
                ];
            }

            $return_array['accolades'] = $accolades_array;
            $return_array['show_accolades'] = count($accolades_array) > 0;
        }

        $return_array = array_merge($parameters, $return_array);
    }

    protected function getUser(): User
    {
        return $this->user_object;
    }

    public function signIn(): void
    {
        $parameters = Request::getParameters();
        if (!count($parameters)) {
            jsonResponse([
                'errors' => ['Must provide an email and password']
            ]);
        }

        $emailAddress = Sanitizer::sanitize($parameters['email']);
        $password = Sanitizer::sanitize($parameters['password']);
        $errors = [];

        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }

        if (!$password) {
            $errors[] = 'Please enter a password';
        }

        if (count($errors)) {
            jsonResponse([
                'errors' => $errors
            ]);
        }

        $success = User::login($emailAddress, $password);

        if (!$success) {
            jsonResponse([
                'errors' => 'Your Email or Password is incorrect.'
            ]);
        }

        $user = getSignedInUser();
        $parameters = [
            'id' => $user->getID(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        ];

        jsonResponse([
            'token' => JWTAuthenticator::generate($parameters)
        ]);
    }

    public function details(): void
    {
        $this->toJson('profile');
    }

    public function update(): void
    {
        $post_values = Request::getPostValues();
        $user = $this->getUser();

        $new_username = $post_values['username'];
        $account_type_id = $post_values['account_type_id'];

        $errors = User::verifyUsername($new_username);
        if (count($errors)) {
            $this->toJson('profile', [
                'errors' => $errors
            ]);
        }

        $user->update(
            $new_username,
            $account_type_id
        );

        setSignedInUser($user);
    }

    public function account()
    {
        $user = getSignedInUser();
        jsonResponse([
            'username' => $user->getUsername(),
            'account_type_id' => $user->getAccountTypeID(),
            'account_type_text' => $user->getAccountTypeText(),
            'skills' => $user->getSkills(),
            'accolades' => $user->getAccolades()
        ]);
    }
}
