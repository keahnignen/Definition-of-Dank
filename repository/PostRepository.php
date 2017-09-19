<?php
/**
 * Created by PhpStorm.
 * User: btabik
 * Date: 19.09.2017
 * Time: 10:18
 */

class PostRepository extends Repository
{

    protected $tableName = 'post';

    public function createPost($userId, $picturePath, $catId)
    {
        $date = date('l jS \of F Y h:i:s A');
        $att = '(picturePath, date, rate, catId, isVerified, userId)';
        $value = "({$picturePath}, {$date})";

        $this->insert($this->tableName, $att, $value);

    }

}