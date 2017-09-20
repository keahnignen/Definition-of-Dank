<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 18.09.2017
 * Time: 13:01
 */

require_once '../repository/PostRepository.php';

class FeedController
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function index()
    {
        $view = new View('feed');
        $view->title = 'Feed';
        $view->heading = 'Feed';
        $view->display();
    }

    public function getAllMemes()
    {
       $x = $this->postRepository->getAllPosts();
       return $x;
    }

}