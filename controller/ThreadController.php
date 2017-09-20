<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 18.09.2017
 * Time: 13:01
 */

require_once '../repository/ThreadRepository.php';

class ThreadController
{

    public $threadrepo;

    public function __construct()
    {
        $this->threadrepo = new ThreadRepository();
    }

    public function index()
    {
        $view = new View('thread');
        $view->title = 'Categorys';
        $view->heading = 'Catagroys';
        $view->display();
    }

    public function getAllCategorys()
    {
        return $this->threadrepo->getAllCategorys();
    }

}