<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 19.09.2017
 * Time: 09:16
 */

class UserAreaController
{
    public function index()
    {
        $view = new View('User_Area');
        $view->title = 'User Area';
        $view->heading = 'User Area';
        $view->display();
    }

    public function post()
    {
        $postcontroller = new PostController();
    }
}