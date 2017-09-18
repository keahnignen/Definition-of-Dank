<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{

    public function index()
    {
        $view = new View('user_index');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
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
        $usernameLentgh = 20,
        $passwordLentgh = 16,
        $emailLentgh = 46
    );



        if ($_POST['send']) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];



            $userRepository = new UserRepository();
            $userRepository->addUser($username, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
