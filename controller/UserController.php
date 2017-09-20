<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */


class UserController
{

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        if (isset($_SESSION['userId']))
        {
            $this->user_area();
        }
        else
        {
            $this->register_login();
        }
    }

    public function register_login()
    {
        $view = new View('user_index');
        $view->title = 'Register and Login';
        $view->heading = 'Register and Login';
        $view->display();
    }


    public function user_area()
    {
        $view = new View('User_Area');
        $view->title = 'User Area';
        $view->heading = 'User Area';
        $view->display();
    }

    /*

    public function index()
    {
        var_dump('daggisad');
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        //$view->users = $userRepository->readAll();
        $view->display();
    }

    */


    public function create()
    {
        $userKey = 'username';
        $passwordKey = 'password';
        $emailKey = 'email';

        if (isset($_POST[$userKey]) && isset($_POST[$passwordKey]) && isset($_POST[$emailKey])) {
            $username = $_POST[$userKey];
            $password = $_POST[$passwordKey];
            $email = $_POST[$emailKey];

            $postList = array(
                $userKey => $username,
                $passwordKey => $password,
                $emailKey => $email,
            );


            if (!$this->arePostValid($postList)) {
                return;
            }

            //Validate E-Mail
            if ($this->userRepository->isUsernameTaken($username)) {

                $this->goToLoginWithError('Username is Taken');
                return;
            }

            //Validate Username
            if ($this->userRepository->isEmailTaken($email)) {
                $this->goToLoginWithError('Email is Taken');
                return;
            }

            if ($this->userRepository->addUser($postList[$userKey], $postList[$emailKey], $postList[$passwordKey])) {
                $GLOBALS['error'] = 'accout was succesfully created';
                $this->setSessionId($username);
                $this->index();
            } else {
                $this->goToLoginWithError('Cant create a Accout');
            }

        } else {
            $this->goToLoginWithError('post variables does not exist');
        }

    }

    public function login()
    {

        $userKey = 'username';
        $passwordKey = 'password';

        if (isset($_POST[$userKey]) && isset($_POST[$passwordKey]))
        {

            $username = $_POST[$userKey];
            $password = $_POST[$passwordKey];

            $postList = array (
                $userKey => $username,
                $passwordKey => $password
            );

            var_dump($postList[$userKey]);
            var_dump($postList[$passwordKey]);

            if (!$this->arePostValid($postList)) return;


            if ($this->userRepository->loginSuccesfully($postList[$userKey], $postList[$passwordKey]))
            {
                $this->setSessionId();
                $this->index();
            }
            else
            {
                $this->goToLoginWithError('The password or the username was wrong');
            }

        }
        else
        {
            $this->goToLoginWithError('post variables does not exist');
        }
    }



    private function goToLoginWithError($error)
    {
        $GLOBALS['error'] = $error;
        $this->register_login();
    }

    public function isValid($string)
    {
        $length = 50;
        return  (!empty($string) && strlen($string) < $length) ? true : false;
    }


    private function setSessionId($username)
    {
        $_SESSION['userId'] = $this->userRepository->getUserIdByUsername($username);
    }

    private function arePostValid($posts)
    {


        foreach ($posts as $key => $value)
        {
            if (!$this->isValid($value))
            {
                $GLOBALS['error'] = "It occurred an error with the Field {$key}";
                $this->register_login();
                return false;
            }
        }
        return true;

    }


}
