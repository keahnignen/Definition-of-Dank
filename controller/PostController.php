<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14.09.2017
 * Time: 21:04
 */

require_once '../repository/PostRepository.php';

class PostController
{

    private $postrep;

    public function __construct()
    {
        $this->postrep = new PostRepository();
    }


    //Unfortuneatley it doesn't work
    public function createPost($userId, $picturePath, $catId)
    {
        if (!isset($_FILES['userfile']['name']) || empty($_FILES['userfile']['name']))
        {
            throw new Exception('Create Post File Error');
        }

        $fileName = htmlspecialchars($_FILES['userfile']['name']);

        $uploaddir = '/images';
        $uploadfile = $uploaddir . basename($fileName);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            throw new Exception('it works');
        } else {
            throw new Exception('it dont works');
        }


        $this->postrepo->createPost($postName, $picturePath, $userId);
    }
}