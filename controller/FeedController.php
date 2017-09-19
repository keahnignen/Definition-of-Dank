<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 18.09.2017
 * Time: 13:01
 */

class FeedController
{
    public function index()
    {
        $view = new View('feed');
        $view->title = 'Feed';
        $view->heading = 'Feed';
        $view->display();
    }

}