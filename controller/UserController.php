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

        $lentgh = Array(
            $username = 20,
            $email = 46,
            $password = 16
        );

        if ($_POST['submit']) {
            $posts = Array(
                $username = $_POST['username'],
                $email = $_POST['email'],
                $password = $_POST['password']
            );


            foreach ($posts as $key => $value)
            {
                if (strlen($value) > $lentgh[$key])
                {
                    echo "The Input {$key} is too long";
                    return null;
                }
            }
            $this->userRepository->addUser($username, $email, $password);
            header('Location: /userArea');
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userRepository->login($username, $password))
            {
               $this->setSessionId();
            }
        }
        else
        {
            echo 'penis';
        }
    }


    private function setSessionId($username)
    {
        $_SESSION['userId'] = $this->userRepository->getUserIdByUsername($username);
    }
}
