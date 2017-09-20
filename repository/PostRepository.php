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

    public function createPost($userId, $picturePath, $catId = 0)
    {
        $date = date('l jS \of F Y h:i:s A');
        $att = '(picturePath, date, rate, catId, isVerified, userId)';
        $value = "({$picturePath}, {$date})";

        $this->insert($this->tableName, $att, $value);

    }

    public function getAllPosts()
    {
        return $this->select('postnName, picturePath', $this->tableName, '1', '1', 2);
    }

}