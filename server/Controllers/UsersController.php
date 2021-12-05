<?php

namespace App\Controllers;

use App\Utils\Http\JWTAuthenticator;
use App\Utils\Http\Request;
use App\Models\User\User;
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
    
    protected function getUser(): User
    {
        return $this->user_object;
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
                    'src'        => Skills::getSkillIconFromIndex($row['skill_index']),
                    'skill_name' => $row['skill_name'],
                    'exp'        => $row['exp'],
                    'level'      => $row['level'],
                    'rank'       => $row['rank']
                ];
            }
    
            $return_array['skills'] = $skills_array;
            $return_array['show_skills'] = count($skills_array) > 0;
    
            // Load accolades
            $accolades = $this->getUser()->getAccolades();
            $accolades_array = [];
            foreach ($accolades as $key => $row) {
                $accolades_array[] = [
                    'src'           => Accolades::getAccoladeIconFromIndex($row['accolade_index']),
                    'accolade_name' => $row['accolade_name'],
                    'score'         => $row['score'],
                    'rank'          => $row['rank']
                ];
            }
    
            $return_array['accolades'] = $accolades_array;
            $return_array['show_accolades'] = count($accolades_array) > 0;
        }

        $return_array = array_merge($parameters, $return_array);
    }
    
    public function canAccess(string $action, array $parameters = []): bool
    {
        $signed_in_user = getSignedInUser();
        $is_user_signed_in = $signed_in_user->getID() > 0;
        $same_user_as_requesting = $signed_in_user->getID() === Request::getID();
        
        switch ($action) {
            case 'members':
            case 'logout':
                return $is_user_signed_in;
            case 'update':
            case 'details':
                return $is_user_signed_in && $same_user_as_requesting;
            default:
                return true;
        }
    }
    
    public function index(): void {}
    
    public function register(): void
    {
        $parameters = Request::getParameters();

        // If nothing is in $_POST, just show the register form
        if (!count($parameters)) {
            $this->toJson('register');
        }

        // Sanitizing our user input before validating
        $username = Sanitizer::sanitize($parameters['username']);
        $email_address = Sanitizer::sanitize($parameters['email']);
        $account_type_id = Sanitizer::sanitize($parameters['accountType']);
        $password = Sanitizer::sanitize($parameters['password']);
        $form_errors = User::verifyUsername($username);

        $db = getDatabase();
        $sql = $db->prepare('SELECT email_address FROM user WHERE email_address =?');
        $sql->execute([$email_address]);
        $value = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        if ($value) {
            $value = $value[0];
            $compare_email = $value['email_address'];
        
            if ($compare_email === $email_address) {
                $form_errors[] = 'Sorry, that email has been taken by another user, please try again';
            }
        }

        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $form_errors[] = 'Please enter a valid email address';
        }
        
        if (!$password) {
            $form_errors[] = 'Please enter a password';
        }

        // If we have found any errors, re-show the form with them
        if (count($form_errors)) {
            jsonResponse([
                'errors' => $form_errors
            ]);
        }

        // TODO move this to the user model
        // If we have gotten this far, it means there were no errors when validating. Insert the user into the database
        $db = getDatabase();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $db->prepare('INSERT INTO user (username, password, email_address, account_type_id) VALUES (?, ?, ?, ?)');
        
        $values = [
            $username,
            $password,
            $email_address,
            $account_type_id
        ];
        
        $sql->execute($values);
        $user_id = $db->lastInsertId();
        setSignedInUser(new User($user_id));

        $parameters['id'] = $user_id;
        jsonResponse([
            'token' => JWTAuthenticator::generate($parameters)
        ]);
    }

    public function signIn(): void
    {
        if (!count($_POST)) {
            $this->toJson('signin');
        }
        
        $email_address = Sanitizer::sanitize($_POST['email_address']);
        $password = Sanitizer::sanitize($_POST['password']);
        $form_error = [];
    
        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $form_error[] = 'Please enter a valid email address';
        }
    
        if (!$password) {
            $form_error[] = 'Please enter a password';
        }
    
        if (count($form_error)) {
            $this->toJson('signin', [
                'errors' => $form_error
            ]);
        }
    
        $errors = User::login($email_address, $password);
    
        if (count($errors)) {
            $this->toJson('signin', [
                'errors' => $errors
            ]);
        }
    }
    
    public function details(): void
    {
        $this->toJson('profile');
    }

    public function logout(): void
    {
        getSignedInUser()->logout();
    }
    
    public function members(): void
    {
        $this->toJson('members', [
            'members' => User::getMembers()
        ]);
    }

    public function update(): void
    {
        $post_values = Request::getPostValues();

        if (!$post_values) {
            //redirect('User/Details/' . Request::getID());
        }
        
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

    // TODO once this is done, move it to index.php in the $header() if statement
    public function testJWT(): void
    {
        $decoded = JWTAuthenticator::authenticate(
//            Server::getAuthHeader()
            Request::getParameters()['jwt']
        );

        if ($decoded instanceof \stdClass) {
            $user = new User($decoded->data->id);
            dd($user);
        }
    }
}
