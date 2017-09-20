<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 19.09.2017
 * Time: 10:18
 */

require_once '../lib/Repository.php';

class PostRepository extends Repository
{

    protected $tableName = 'post';

    /**
     * @param $postName is a string of the user
     * @param $picturePath is an string with extention
     * @param $userId is an integer of the user
     * @return bool if the insert was succefully
     * @throws Exception if an Querry Prepare or Exicution error occured
     */
    public function createPost($postName, $picturePath, $userId)
    {

        $attr = '(postName, picturePath, userId)';


        $query = "INSERT INTO {$this->tableName} {$attr} VALUES (?, ?, ?)";


        $stmt = ConnectionHandler::getConnection()->prepare($query);

        if ($stmt == false)
        {
            throw new Exception("Statement prepare Error");
        }
        else
        {
            $stmt->bind_param('sss', $postName,  $picturePath, $userId);

            if (!$stmt->execute())
            {
                throw new Exception("Exicution error");
            }

            return true;
        }

    }


    /**
     * @return array
     */
    public function getAllPosts()
    {
        $x = $this->select('postName, picturePath', $this->tableName, '1', '1', 2);
        return $x;
    }

}