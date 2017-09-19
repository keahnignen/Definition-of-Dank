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
        $view = new View('user_index');
        $view->title = 'Register and Login';
        $view->heading = 'Register and Login';
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

        if ($_POST['send']) {
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
        if ($_POST['send']) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userRepository->login($username, $password))
            {

            }
        }
    }
}
