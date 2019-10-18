<?php

namespace App\Controllers;

use App\Utils\Database;
use App\Models\formValid;

class UsersController extends AbstractBaseController
{
    public function canAccess($action, $parameters = [])
    {
        return true;
    }

    public function index()
    {

    }

    public function register()
    {
        if (count($_POST)) {

            $username = $email_address = $password = $password_confirm = "";

            $checkData = new formValid();
            $username = $checkData->test_input($_POST["username"]);
            $checkData->test_input($_POST["email_address"]);
            $email_address = $checkData->test_input($_POST["email_address"]);
            $checkData->test_input($_POST["password"]);
            $password = $checkData->test_input($_POST["password"]);
            $checkData->test_input($_POST["password_confirm"]);
            $password_confirm = $checkData->test_input($_POST["password_confirm"]);


            if (!$username) {
                $form_error[] = "Please enter a username";
            }
            if (strlen($username) < 5 || strlen($username) > 12) {
                $form_error[] = 'Please enter a username between 5 and 12 characters long';
            }
            if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                $form_error[] = 'Please enter a valid email address';
            }
            if (!$password) {
                $form_error[] = 'Please enter a password';
            }
            if (!$password_confirm) {
                $form_error[] = "Please fill out \"Confirm Password\"";
            }
            if ($password != $password_confirm) {
                $form_error[] = "Your passwords do not match!";
            }
            if (count($form_error)){
                    view('register',
                        ['errors' => $form_error]);
                }
                if (!$form_error) {
                    $db = Database::getInstance();
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $sql = $db->prepare("INSERT INTO user (username, password, email_address) VALUES (?,?,?)");

                    $values = [
                        $_POST['username'],
                        $_POST['password'],
                        $_POST['email_address']
                    ];

                    $sql->execute($values);
                    $_SESSION['username'] = $_POST['username'];
                    redirect("");
                }
            }
            view('register');
        }
        public function signin()
        {
            if(count($_POST)) {

                $email_address = $password = "";

                $checkData = new formValid();
                $checkData->test_input($_POST["email_address"]);
                $email_address = $checkData->test_input($_POST["email_address"]);
                $checkData->test_input($_POST["password"]);
                $password = $checkData->test_input($_POST["password"]);

                if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                    $form_error[] = 'Please enter a valid email address';
                }
                if (!$password) {
                    $form_error[] = 'Please enter a password';
                }
                if (count($form_error)){
                    view('signin',
                        ['errors' => $form_error]);
                    if (!$form_error) {
                        //TODO login code, boyyyy
                    }
                }
            }
            view('signin');
        }
    }


