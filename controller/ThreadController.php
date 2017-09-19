<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 18.09.2017
 * Time: 13:01
 */

class ThreadController
{

    public function index()
    {
        $view = new View('thread');
        $view->title = 'Categorys';
        $view->heading = 'Catagroys';
        $view->display();
    }

}