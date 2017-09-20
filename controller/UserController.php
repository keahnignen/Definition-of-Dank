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



    public function logout()
    {
        if(isset($_SESSION['id']))
        {
            unset($_SESSION['id']);
        }
        session_destroy();
        $this->register_login();
    }

    public function user_area()
    {
        $view = new View('User_Area');
        $view->title = 'User Area';
        $view->heading = 'User Area';
        $view->display();
    }

    public function create()
    {
        $userKey = 'username';
        $passwordKey = 'password';
        $emailKey = 'email';

        if (isset($_POST[$userKey]) && isset($_POST[$passwordKey]) && isset($_POST[$emailKey])) {



            //For anti Xss
            $username = htmlspecialchars($_POST[$userKey]);
            $password = htmlspecialchars($_POST[$passwordKey]);
            $email = htmlspecialchars($_POST[$emailKey]);

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
            if ($this->isEmaiValid($email)) {
                $this->goToLoginWithError('Email is invalid');
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


    private function isEmaiValid($email)
    {
        if ($this->userRepository->isEmailTaken($email)) {
            $this->goToLoginWithError('Email is Taken');
            return false;
        }

        $pattern = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

        if (preg_match($pattern, $email) === 1)
        {
            $this->goToLoginWithError('Email is not a Email');
            return false;
        }
        return true;
    }

    public function login()
    {

        $userKey = 'username';
        $passwordKey = 'password';

        if (isset($_POST[$userKey]) && isset($_POST[$passwordKey]))
        {

            $username = htmlspecialchars($_POST[$userKey]);
            $password = htmlspecialchars($_POST[$passwordKey]);

            $postList = array (
                $userKey => $username,
                $passwordKey => $password
            );

            if (!$this->arePostValid($postList)) return;


            if ($this->userRepository->loginSuccesfully($postList[$userKey], $postList[$passwordKey]))
            {
                $this->setSessionId($username);
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
